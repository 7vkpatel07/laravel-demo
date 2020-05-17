<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Roles;
use JsValidator;
use Validator;
use Carbon\Carbon;

class AdminRolesController extends Controller
{
    public $moduleName = 'roles';

	public function __construct()
	{
        //$this->middleware('auth');
	}

	public function index()
	{
		$listing = Roles::sortable()->paginate(settingParam('record-per-page'));

		return view('admin.roles_list',compact('listing'));
	}

	public function add()
	{
		$validator = [
			'role_name' => 'required|unique:roles',
		];

		$jsValidator = JsValidator::make($validator);
		return view('admin.roles_add',compact('jsValidator'));
	}

	public function store(Request $request){

		$validator = Validator::make($request->all(), [
			'role_name' => 'required|unique:roles',
		]);

		if ($validator->fails()) {
			return redirect(backUrl($this->moduleName.'/add'))
			->withErrors($validator)
			->withInput();
		}else{

			$roles = new Roles;
			$roles->role_name = $request->role_name;
			$roles->role_name_en = $request->role_name_en;
			$roles->created_at = Carbon::now();
			
			if($roles->save()){

				toastr()->success('Data has been saved successfully!');
				return redirect(backUrl($this->moduleName));
			}else{
				toastr()->error('Technical Issue!');
				return redirect(backUrl($this->moduleName.'/add'))->withInput();
			}
		}


	}

	public function edit($id)
	{

		$data = Roles::find($id);

		$validator = [
			'role_name' => 'required|unique:roles,role_name,'.$id,
		];

		$jsValidator = JsValidator::make($validator);
		return view('admin.roles_edit',compact('jsValidator','data'));
	}

	public function update(Request $request){

		$validator = Validator::make($request->all(), [
			'role_name' => 'required|unique:roles,role_name,'.$request->id,
		]);

		if ($validator->fails()) {
			return redirect(backUrl($this->moduleName.'/edit/'.$request->id))
			->withErrors($validator)
			->withInput();
		}else{

			$roles = Roles::find($request->id);
			$roles->role_name = $request->role_name;
			$roles->role_name_en = $request->role_name_en;
			$roles->updated_at = Carbon::now();
			
			if($roles->save()){
				toastr()->success('Data has been saved successfully!');
				return redirect(backUrl($this->moduleName));
			}else{
				toastr()->error('Technical Issue!');
				return redirect(backUrl($this->moduleName.'/edit/'.$request->id))->withInput();
			}
		}


	}


	public function delete($id){
		$data = Roles::find($id);
		if($data->delete()){
			
			toastr()->success('Data has been deleted successfully!');
			return redirect(backUrl($this->moduleName));
		}else{
			toastr()->error('Technical Issue!');
			return redirect(backUrl($this->moduleName));
		}
	}
}
