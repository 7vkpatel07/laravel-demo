<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Skills;
use JsValidator;
use Validator;
use Session;
use Carbon\Carbon;

class AdminSkillsController extends Controller
{
	public $moduleName = "skills";

	public function __construct()
	{
        //$this->middleware('auth');
	}

	/* Listing View */
	public function index(Request $request)
	{
		$dataQuery = skills::sortable();

		if ($request->has('search_by_skill_name') && $request->search_by_skill_name != '') {
			
			$dataQuery->where('skill_name','like','%'.$request->search_by_skill_name.'%');
			$dataQuery->orWhere('skill_name_en','like','%'.$request->search_by_skill_name.'%');
			
		}

		$listing = $dataQuery->paginate(settingParam('record-per-page'));
		return view('admin.skills_list',compact('listing','request'));
	}

	/* Common Validation Rules */
	function validationRules(){
		$validator = [
			'skill_name' => 'required',
			'skill_name_en' => 'required',
			'skill_access_level' => 'required',
			'skill_status' => 'required',
		];

		return $validator;
	}

	/* Add View */
	public function add()
	{
		
		$validator = $this->validationRules();
		$jsValidator = JsValidator::make($validator);
		return view('admin.skills_add',compact('jsValidator'));
	}


	/* Store Function for Save values */
	public function store(Request $request){

		$validator = Validator::make($request->all(), $this->validationRules()
	);

		if ($validator->fails()) {
			return redirect(backUrl($this->moduleName.'/add'))
			->withErrors($validator)
			->withInput();
		}else{

			$skills = new Skills;
			$skills->skill_name = $request->skill_name;
			$skills->skill_name_en = $request->skill_name_en;
			$skills->skill_access_level = $request->skill_access_level;
			$skills->skill_status = $request->skill_status;
			$skills->created_at = Carbon::now();
			
			if($skills->save()){

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

		$data = Skills::find($id);

		$validator = $this->validationRules();

		$jsValidator = JsValidator::make($validator);
		return view('admin.skills_edit',compact('jsValidator','data'));
	}


	/* Update Function for Update values */
	public function update(Request $request){

		$validator = Validator::make($request->all(), $this->validationRules()
	);

		if ($validator->fails()) {
			return redirect(backUrl($this->moduleName.'/edit/'.$request->id))
			->withErrors($validator)
			->withInput();
		}else{

			$skills = Skills::find($request->id);
			$skills->skill_name = $request->skill_name;
			$skills->skill_name_en = $request->skill_name_en;
			$skills->skill_access_level = $request->skill_access_level;
			$skills->skill_status = $request->skill_status;
			$skills->updated_at = Carbon::now();
			
			if($skills->save()){
				toastr()->success('Data has been saved successfully!');
				return redirect(backUrl($this->moduleName));
			}else{
				toastr()->error('Technical Issue!');
				return redirect(backUrl($this->moduleName.'/edit/'.$request->id))->withInput();
			}
		}


	}


	/* Soft Delete */
	public function delete($id){
		$data = Skills::find($id);
		if($data->delete()){
			
			toastr()->success('Data has been deleted successfully!');
			return redirect(backUrl($this->moduleName));
		}else{
			toastr()->error('Technical Issue!');
			return redirect(backUrl($this->moduleName));
		}
	}
}
