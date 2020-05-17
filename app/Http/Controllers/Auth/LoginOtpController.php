<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use App\Country;
use JsValidator;
use Validator;
use Auth;
use Session;
use Twilio\Rest\Client;

class LoginOtpController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest')->except('admin/logout');
        //$this->middleware('guest', ['except' => 'logout']);
    }


    public function showOtpLoginForm(){
        $countries = [];
        if (Auth::check()){
            return redirect(backUrl());
        }

        $countries = Country::all();

        return view('admin.login_otp',compact('countries'));
    }

    public function sendOTP(Request $request)
    {

        $userId = $this->checkMobileNumber($request->mobile_phone,$request->country_code);

        if($userId == 0){
            return response()->json(['success' => false,'msg' => 'Mobile number invalid!']);
        }


        $otp = $this->generateOTP($request->mobile_phone,$request->country_code);

        if(!empty($otp)){
            if(isset($otp['code']) && $otp['code'] != ""){

                $userData = User::find($userId);
                $userData->otp = $otp;
                $userData->save();

                return response()->json(['success' => true,'msg' => 'OTP Successfully sent!']);
            }else{
                return response()->json(['success' => false,'msg' => $otp['msg']]);
            }
        }else{
            return response()->json(['success' => false,'msg' => 'Technical issue!']);
        }

    }

    public function checkMobileNumber($mobileNumber = "", $countryCode = ""){

        $userId = 0;
        $userMobile = User::where(['mobile_phone'=>$mobileNumber, 'country_code' => $countryCode])->first();

        if($userMobile){
            $userId =  $userMobile->id;
        }

        return $userId;

    }

    public function generateOTP($mobileNumber = "", $countryCode = "")
    {
        $code = $msg = "";
        $mobileNumberWithCode = $countryCode.$mobileNumber;
        //$mobileNumber = '+919998842601';
        //$code = random_int(100000, 999999);
        if($mobileNumberWithCode!=''){


            $client = new Client(settingParam('twillio-sid'), settingParam('twillio-token'));
            try {
                $code = random_int(100000, 999999);
                $msg = "";
                $client->messages->create(
                 $mobileNumberWithCode,
                 [
                     'from' => settingParam('twillio-registred-mobile'),
                     'body' => $code,
                 ]
             );
            } catch (\Exception $e) {
                $msg = $e->getMessage();
                $code = "";
            }
            
        }

        return ['code'=>$code,'msg'=>$msg];
    }


    /* OTP Login */
    public function otpLogin(Request $request){


        $validator = Validator::make($request->all(), [
            'mobile_phone' => 'required',
            'otp' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false,'msg'=>$validator->errors()]);
        }else{

            $user = User::where([ 'mobile_phone' => $request->mobile_phone , 'otp' => $request->otp,'is_superadmin' => 1 ])->first();

            if($user){
             Auth::login($user);
             $user->otp = null;
             $user->save();
             return response()->json(['success' => true,'msg'=>'Login Successfully.']);
         }else{
            return response()->json(['success' => false,'msg'=>'invalid OTP!']);
        }



    }


}




}
