<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use JsValidator;
use Validator;
use Auth;
use Session;

class LoginController extends Controller
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


    public function showLoginForm(){
        if (Auth::check()){
            return redirect(backUrl());
        }
        $validator = [
            'email' => 'required|email',
            'password' => 'required',
        ];

        $jsValidator = JsValidator::make($validator);

        return view('admin.login',compact('jsValidator'));
    }

    /* Login */
    public function doLogin(Request $request){


        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(backUrl('login'))
            ->withErrors($validator)
            ->withInput();
        }else{

            $remember = ($request->remember) ? true : false;

            $credentials = [ 'email' => $request->email , 'password' => $request->password,'is_superadmin' => 1 ];
            if(Auth::attempt($credentials,$remember)){
                return redirect(backUrl('/'));
            }else{
                Session::flash('msg-class', 'alert-danger'); 
                Session::flash('message', 'Invalid credentials!'); 
                return redirect(backUrl('login'))->withInput();
            }
        }


    }

    public function logOut(Request $request){
        Auth::logout();
        return redirect(backUrl('login'));
    }




}
