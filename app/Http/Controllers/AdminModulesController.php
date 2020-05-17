<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modules;
use JsValidator;
use Validator;
use Session;
use Carbon\Carbon;



class AdminModulesController extends Controller
{

	public $moduleName = 'module';

	public function __construct()
	{
        //$this->middleware('auth');
	}

	public function index()
	{
		$listing = Modules::sortable()->paginate(settingParam('record-per-page'));
		return view('admin.module_list',compact('listing'));
	}

	public function add()
	{
		$validator = [
			'name' => 'required|unique:modules',
		];

		$jsValidator = JsValidator::make($validator);
		return view('admin.module_add',compact('jsValidator'));
	}

	public function store(Request $request){

		$validator = Validator::make($request->all(), [
			'name' => 'required|unique:modules',
		]);

		if ($validator->fails()) {
			return redirect(backUrl($this->moduleName.'/add'))
			->withErrors($validator)
			->withInput();
		}else{

			$modules = new Modules;
			$modules->name = $request->name;
			$modules->created_at = Carbon::now();
			
			if($modules->save()){

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

		$data = Modules::find($id);

		$validator = [
			'name' => 'required|unique:modules,name,'.$id,
		];

		$jsValidator = JsValidator::make($validator);
		return view('admin.module_edit',compact('jsValidator','data'));
	}

	public function update(Request $request){

		$validator = Validator::make($request->all(), [
			'name' => 'required|unique:modules,name,'.$request->id,
		]);

		if ($validator->fails()) {
			return redirect(backUrl($this->moduleName.'/edit/'.$request->id))
			->withErrors($validator)
			->withInput();
		}else{

			$modules = Modules::find($request->id);
			$modules->name = $request->name;
			$modules->updated_at = Carbon::now();
			
			if($modules->save()){
				toastr()->success('Data has been saved successfully!');
				return redirect(backUrl($this->moduleName));
			}else{
				toastr()->error('Technical Issue!');
				return redirect(backUrl($this->moduleName.'/edit/'.$request->id))->withInput();
			}
		}


	}

	public function delete($id){
		$data = Modules::find($id);
		if($data->delete()){
			
			toastr()->success('Data has been deleted successfully!');
			return redirect(backUrl($this->moduleName));
		}else{
			toastr()->error('Technical Issue!');
			return redirect(backUrl($this->moduleName));
		}
	}
}
