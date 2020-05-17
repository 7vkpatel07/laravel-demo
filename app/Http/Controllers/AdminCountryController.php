<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use JsValidator;
use Validator;
use Session;
use Carbon\Carbon;

class AdminCountryController extends Controller
{

	public $moduleName = "country";

	public function __construct()
	{
        //$this->middleware('auth');
	}


	/* Listing View */
	public function index(Request $request)
	{
		$dataQuery = Country::sortable();

		if ($request->has('search_by_country_name') && $request->search_by_country_name != '') {
			
			$dataQuery->where('country_name','like','%'.$request->search_by_country_name.'%');
			$dataQuery->orWhere('country_name_en','like','%'.$request->search_by_country_name.'%');
			
		}
		if ($request->has('search_by_country_code') && $request->search_by_country_code != '') {
			
			$dataQuery->where('country_code',$request->search_by_country_code);
			
		}


		$listing = $dataQuery->paginate(settingParam('record-per-page'));
		return view('admin.country_list',compact('listing','request'));
	}

	/* Common Validation Rules */
	function validationRules(){
		$validator = [
			'country_name' => 'required',
			'country_name_en' => 'required',
			'country_code' => 'required',
		];

		return $validator;
	}

	/* Add View */
	public function add()
	{
		
		$validator = $this->validationRules();
		$jsValidator = JsValidator::make($validator);
		return view('admin.country_add',compact('jsValidator'));
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

			$country = new Country;
			$country->country_name = $request->country_name;
			$country->country_name_en = $request->country_name_en;
			$country->country_code = $request->country_code;
			$country->created_at = Carbon::now();
			
			if($country->save()){

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

		$data = Country::find($id);

		$validator = $this->validationRules();

		$jsValidator = JsValidator::make($validator);
		return view('admin.country_edit',compact('jsValidator','data'));
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

			$country = Country::find($request->id);
			$country->country_name = $request->country_name;
			$country->country_name_en = $request->country_name_en;
			$country->country_code = $request->country_code;
			$country->updated_at = Carbon::now();
			
			if($country->save()){
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
		$data = Country::find($id);
		if($data->delete()){
			
			toastr()->success('Data has been deleted successfully!');
			return redirect(backUrl($this->moduleName));
		}else{
			toastr()->error('Technical Issue!');
			return redirect(backUrl($this->moduleName));
		}
	}
}
