<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Country;
use App\Skills;
use App\UsersSkills;
use App\Roles;
use Carbon\Carbon;
use Auth;
use App;
use JsValidator;
use Validator;
use Hash;
use Image;
use File;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class AdminUserController extends Controller
{
	public $moduleName = 'user';
    //
	public function __construct()
	{
        //$this->middleware('auth');
	}


	/* Listing View */
	public function index(Request $request)
	{

		$skills = Skills::all();

		
		$dataQuery = User::with('country','userSkills');

		$dataQuery = $this->search($request,$dataQuery);

		$listing = $dataQuery->sortable()->paginate(settingParam('record-per-page'));

		return view('admin.user_list',compact('listing','skills','request'));
	}

	/* Search data */
	public function search($request,$dataQuery){


		if ($request->has('search_by_first') && $request->search_by_first != '') {
			if(currentLanguage()==1){
				$dataQuery->where('first_name','like','%'.$request->search_by_first.'%');
			}else{
				$dataQuery->where('first_name_en','like','%'.$request->search_by_first.'%');
			}
		}

		if ($request->has('search_by_last') && $request->search_by_last != '') {
			if(currentLanguage()==1){
				$dataQuery->where('last_name','like','%'.$request->search_by_last.'%');
			}else{
				$dataQuery->where('last_name_en','like','%'.$request->search_by_last.'%');
			}
		}

		if ($request->has('search_by_email') && $request->search_by_email != '') {

			$dataQuery->where('email','like','%'.$request->search_by_email.'%');
		}

		if ($request->has('search_by_mobile') && $request->search_by_mobile != '') {

			$dataQuery->where('mobile_phone','like','%'.$request->search_by_mobile.'%');
		}

		if ($request->has('search_by_city') && $request->search_by_city != '') {
			if(currentLanguage()==1){
				$dataQuery->where('address_city','like','%'.$request->search_by_city.'%');
			}else{
				$dataQuery->where('address_city_en','like','%'.$request->search_by_city.'%');
			}
		}

		if ($request->has('search_by_skills') && $request->search_by_skills != '') {

			$search_by_skills = $request->search_by_skills;
			$dataQuery->orWhereHas('skills', function($skills) use ($search_by_skills){
				$skills->whereIn('skill_id',$search_by_skills);
			});
		}

		if ($request->has('search_by_status') && $request->search_by_status != '') {

			$dataQuery->where('status',$request->search_by_status);
		}

		return $dataQuery;
	}


	/* Add View */
	public function add()
	{
		$roles = Roles::all();
		$countryList = [];
		$validator = [
			'first_name' => 'required',
			'last_name' => 'required',
			'first_name_en' => 'required',
			'last_name_en' => 'required',
			'email' => 'required|email|unique:users',
			'mobile_phone' => 'required|unique:users',
			'password' => 'required|min:6',
			'confirmed' => 'required|same:password',
			'address_street_number' => 'required',
			'address_street' => 'required',
			'address_city' => 'required',
			'address_city_en' => 'required',
			'address_zip' => 'required',
			'birth_date' => 'required',
			'profile_photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
			'country_id' => 'required',
			'role_id' => 'required',

		];

		$customMessages = [
			'required' => 'The :attribute field can not be blank1111.'
		];

		$jsValidator = JsValidator::make($validator);

		$countryList = $this->getCountry();

		$skills = Skills::all();

		return view('admin.user_add',compact('jsValidator','countryList','skills','roles'));
	}


	/* Store Function for Save values */
	public function store(Request $request){

		$validationArrayPassport = $skills = [];

		
		
		$validationArray = [
			'first_name' => 'required',
			'last_name' => 'required',
			'first_name_en' => 'required',
			'last_name_en' => 'required',
			'email' => 'required|email|unique:users',
			'mobile_phone' => 'required|unique:users',
			'password' => 'required|min:6',
			'confirmed' => 'required|same:password',
			'address_street_number' => 'required',
			'address_street' => 'required',
			'address_city' => 'required',
			'address_city_en' => 'required',
			'address_zip' => 'required',
			'birth_date' => 'required',
			'profile_photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
			'country_id' => 'required',
			'role_id' => 'required',
			'country_code' => 'required',
		];

		if($request->country_id && $request->country_id == 1){
			$validationArrayPassport = [
				'passport_id' => 'required',
			];
		}

		$validationArrayMerge = array_merge($validationArray,$validationArrayPassport);


		$validator = Validator::make($request->all(),$validationArrayMerge);
		$validator->getTranslator()->setLocale('ro');
		if ($validator->fails()) {
			return redirect(backUrl($this->moduleName.'/add'))
			->withErrors($validator)
			->withInput();
		}else{

			$skills = (isset($request->skill_id) && !empty($request->skill_id))?$request->skill_id:'';

			$user = new User;
			$user->first_name = $request->first_name;
			$user->last_name = $request->last_name;
			$user->first_name_en = $request->first_name_en;
			$user->last_name_en = $request->last_name_en;
			$user->email = $request->email;
			$user->mobile_phone = $request->mobile_phone;
			$user->phone = $request->phone;
			$user->password = Hash::make($request->password);
			$user->address_city = $request->address_city;
			$user->address_city_en = $request->address_city_en;
			$user->address_street_number = $request->address_street_number;
			$user->address_street = $request->address_street;
			$user->address_zip = $request->address_zip;
			$user->fax = $request->fax;
			$user->social_id_number = $request->social_id_number;
			$user->birth_date = convertDateInYMD($request->birth_date);
			$user->country_id = $request->country_id;
			$user->country_code = $request->country_code;
			$user->passport_id = $request->passport_id;
			$user->role_id = $request->role_id;
			$user->created_at = Carbon::now();

			if($request->profile_photo && !empty($request->profile_photo)){

				$profileImage = $request->profile_photo;
				$imageName = time().'.'.$profileImage->getClientOriginalExtension();
				//$destinationPath = storage_path('users');
				$destinationPath = storage_path().'/app/public/users';
				if(!File::exists($destinationPath)) {
					File::makeDirectory($destinationPath, $mode = 0777, true, true);
				}
				$img = Image::make($profileImage->getRealPath());

				$img->fit(100, 100, function ($constraint) {
					$constraint->aspectRatio();
				})->save($destinationPath.'/thumb_'.$imageName);

				$profileImage->move($destinationPath,$imageName);

				$user->profile_photo = $imageName;

			}

			if($user->save()){

				/* Assing users skills*/
				$this->assignSkills($skills,$user->id);

				toastr()->success('Data has been saved successfully!');
				return redirect(backUrl($this->moduleName));
			}else{
				toastr()->error('Technical Issue!');
				return redirect(backUrl($this->moduleName.'/add'))->withInput();
			}
		}


	}

	


	/* Edit View */
	public function edit($id)
	{

		$roles = Roles::all();
		$data = User::find($id);

		$validator = [
			'first_name' => 'required',
			'last_name' => 'required',
			'first_name_en' => 'required',
			'last_name_en' => 'required',
			'email' => 'required|email|unique:users,email,'.$id,
			'mobile_phone' => 'required|unique:users,mobile_phone,'.$id,
			'address_street_number' => 'required',
			'address_street' => 'required',
			'address_city' => 'required',
			'address_city_en' => 'required',
			'address_zip' => 'required',
			'birth_date' => 'required',
			'profile_photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
			'country_id' => 'required',
			'role_id' => 'required',
		];

		$jsValidator = JsValidator::make($validator);

		$countryList = $this->getCountry();

		$skills = Skills::all();

		$userSkills = UsersSkills::select('skill_id')->where('user_id',$id)->pluck('skill_id')->toArray();

		
		
		return view('admin.user_edit',compact('jsValidator','data','countryList','skills','roles','userSkills'));
	}


	/* Update Function for Update values */
	public function update(Request $request){
		$validationArrayPass = $validationArrayPassport = $skills = [];
		$validationArray = [
			'first_name' => 'required',
			'last_name' => 'required',
			'first_name_en' => 'required',
			'last_name_en' => 'required',
			'email' => 'required|email|unique:users,email,'.$request->id,
			'mobile_phone' => 'required|unique:users,mobile_phone,'.$request->id,
			'address_street_number' => 'required',
			'address_street' => 'required',
			'address_city' => 'required',
			'address_city_en' => 'required',
			'address_zip' => 'required',
			'birth_date' => 'required',
			'profile_photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
			'country_id' => 'required',
			'country_code' => 'required',
			'role_id' => 'required',
		];

		if($request->password && $request->password!=''){
			$validationArrayPass = [
				'password' => 'required|min:6',
				'confirmed' => 'required|same:password',
			];
		}

		if($request->country_id && $request->country_id == 1){
			$validationArrayPassport = [
				'passport_id' => 'required',
			];
		}

		$validationArrayMerge = array_merge($validationArray,$validationArrayPass,$validationArrayPassport);

		$validator = Validator::make($request->all(), $validationArrayMerge);



		if ($validator->fails()) {
			return redirect(backUrl($this->moduleName.'/edit/'.$request->id))
			->withErrors($validator)
			->withInput();
		}else{

			$skills = (isset($request->skill_id) && !empty($request->skill_id))?$request->skill_id:'';

			$user = User::find($request->id);
			$user->first_name = $request->first_name;
			$user->last_name = $request->last_name;
			$user->first_name_en = $request->first_name_en;
			$user->last_name_en = $request->last_name_en;
			$user->email = $request->email;
			$user->mobile_phone = $request->mobile_phone;
			$user->phone = $request->phone;
			$user->address_city = $request->address_city;
			$user->address_city_en = $request->address_city_en;
			$user->address_street_number = $request->address_street_number;
			$user->address_street = $request->address_street;
			$user->address_zip = $request->address_zip;
			$user->fax = $request->fax;
			$user->social_id_number = $request->social_id_number;
			$user->birth_date = convertDateInYMD($request->birth_date);
			$user->country_id = $request->country_id;
			$user->country_code = $request->country_code;
			$user->passport_id = $request->passport_id;
			$user->role_id = $request->role_id;
			$user->updated_at = Carbon::now();

			if($request->password && $request->password!=''){
				$user->password = Hash::make($request->password);
			}

			if($request->profile_photo && !empty($request->profile_photo)){

				$profileImage = $request->profile_photo;
				$imageName = time().'.'.$profileImage->getClientOriginalExtension();
				//$destinationPath = storage_path('users');
				$destinationPath = storage_path().'/app/public/users';
				if(!File::exists($destinationPath)) {
					File::makeDirectory($destinationPath, $mode = 0777, true, true);
				}
				$img = Image::make($profileImage->getRealPath());

				$img->fit(100, 100, function ($constraint) {
					$constraint->aspectRatio();
				})->save($destinationPath.'/thumb_'.$imageName);

				$profileImage->move($destinationPath,$imageName);

				$user->profile_photo = $imageName;

			}

			if($user->save()){

				/* Assing users skills*/
				$this->assignSkills($skills,$request->id);

				toastr()->success('Data has been saved successfully!');
				return redirect(backUrl($this->moduleName));
			}else{
				toastr()->error('Technical Issue!');
				return redirect(backUrl($this->moduleName.'/add'))->withInput();
			}
		}


	}


	/* Soft Delete */
	public function delete($id){
		$data = User::find($id);
		if($data->delete()){
			
			toastr()->success('Data has been deleted successfully!');
			return redirect(backUrl($this->moduleName));
		}else{
			toastr()->error('Technical Issue!');
			return redirect(backUrl($this->moduleName));
		}
	}

	/* Detail View */
	public function detail($id)
	{

		$data = User::find($id);
		return view('admin.user_detail',compact('data'));
	}


	/* Change User Language from TopBar*/
	public function changeLanguage(Request $request){
		
		$userId = Auth::id();
		$userData = User::find($userId);

		$userData->language_id = $request->language_id;
		if($userData->save())
		{
			
			$this->reply['status'] = true;
			$this->reply['msg'] = 'Language updated successfully';
		}else{
			$this->reply['status'] = false;
			$this->reply['msg'] = 'Technical issue';
		}
		
		return response()->json($this->reply);
	}



	/* Multi Delete with checkbox */
	public function multiDelete(Request $request){

		if($request->user_ids && !empty($request->user_ids)){
			User::destroy($request->user_ids);
			$this->reply['status'] = true;
			$this->reply['msg'] = 'Record deleted successfully';
		}else{
			$this->reply['status'] = false;
			$this->reply['msg'] = 'Technical issue';
		}
		return response()->json($this->reply);
		
	}

	/* Multi Active with checkbox */
	public function multiActive(Request $request){

		if($request->user_ids && !empty($request->user_ids)){

			User::whereIn('id', $request->user_ids)
			->update(['status' => 1 ]);

			$this->reply['status'] = true;
			$this->reply['msg'] = 'Record activated successfully';
		}else{
			$this->reply['status'] = false;
			$this->reply['msg'] = 'Technical issue';
		}
		return response()->json($this->reply);
		
	}

	/* Multi DeActive with checkbox */
	public function multiInActive(Request $request){

		if($request->user_ids && !empty($request->user_ids)){

			User::whereIn('id', $request->user_ids)
			->update(['status' => 0 ]);

			$this->reply['status'] = true;
			$this->reply['msg'] = 'Record inactivated successfully';
		}else{
			$this->reply['status'] = false;
			$this->reply['msg'] = 'Technical issue';
		}
		return response()->json($this->reply);
		
	}

	/* Get Country Dropdown */
	public function getCountry(){

		$countryList = Country::all();

		return $countryList;
		
	}

	/* Get Country code from Country */
	public function getCountryCode(Request $request){
		
		$country = Country::find($request->country_id);

		if($country && $country->country_code!=''){

			$this->reply['status'] = true;
			$this->reply['country_code'] = $country->country_code;
		}else{
			$this->reply['status'] = true;
			$this->reply['country_code'] = "";
		}
		return response()->json($this->reply);
	}


	/* Assign User Skills */
	public function assignSkills($skills,$userId){
		if(isset($skills) && !empty($skills)){
			$this->deleteSkills($userId);
			foreach($skills as $skillsId){
				$users_skills = new UsersSkills;
				$users_skills->user_id = $userId;
				$users_skills->skill_id = $skillsId;
				$users_skills->save();
			}
		}
		return true;
	}

	/* Delete old users skills*/
	public function deleteSkills($user_id){
		$data = UsersSkills::where('user_id',$user_id)->delete();

		return true;
	}

	public function exportUsers(Request $request){

		return Excel::download(new UsersExport, 'users.xlsx');
		//(new UsersExport)->download('users.pdf',\Maatwebsite\Excel\Excel::DOMPDF);
	}
	
	
}
