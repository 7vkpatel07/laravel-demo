<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Settings;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Redis;
use JsValidator;
use Validator;

class AdminSettingsController extends Controller
{

	public $moduleName = 'settings';
    //
	public function __construct()
	{
        //$this->middleware('auth');
	}

	public function index(Request $request)
	{
		$dataQuery = Settings::sortable();

		if ($request->has('search_by_field') && $request->search_by_field != '') {

			$dataQuery->where('field','like','%'.$request->search_by_field.'%');
		}

		//dd($dataQuery->toSql()); exit;

		$listing = $dataQuery->paginate(settingParam('record-per-page'));

		return view('admin.settings_list',compact('listing','request'));
	}

	public function add()
	{
		$validator = [
			'field' => 'required|unique:settings',
			'value' => 'required',
		];

		$jsValidator = JsValidator::make($validator);
		return view('admin.settings_add',compact('jsValidator'));
	}

	public function store(Request $request){

		$validator = Validator::make($request->all(), [
			'field' => 'required|unique:settings',
			'value' => 'required',
		]);

		if ($validator->fails()) {
			return redirect(backUrl($this->moduleName.'/add'))
			->withErrors($validator)
			->withInput();
		}else{

			$settings = new Settings;
			$settings->field = $request->field;
			$settings->slug = $request->slug;
			$settings->value = $request->value;
			
			if($settings->save()){
				$this->settingsDataRedis();
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

		$data = Settings::find($id);

		$validator = [
			'field' => 'required|unique:settings,field,'.$id,
			'value' => 'required',
		];

		$jsValidator = JsValidator::make($validator);
		return view('admin.settings_edit',compact('jsValidator','data'));
	}


	public function update(Request $request){

		$validator = Validator::make($request->all(), [
			'field' => 'required|unique:settings,field,'.$request->id,
			'value' => 'required',
		]);

		if ($validator->fails()) {
			return redirect(backUrl($this->moduleName.'/edit/'.$request->id))
			->withErrors($validator)
			->withInput();
		}else{

			$settings = Settings::find($request->id);
			$settings->field = $request->field;
			$settings->slug = $request->slug;
			$settings->value = $request->value;
			
			if($settings->save()){
				$this->settingsDataRedis();
				toastr()->success('Data has been saved successfully!');
				return redirect(backUrl($this->moduleName));
			}else{
				toastr()->error('Technical Issue!');
				return redirect(backUrl($this->moduleName.'/edit/'.$request->id))->withInput();
			}
		}


	}

	public function delete($id){
		$data = Settings::find($id);
		if($data->delete()){
			$this->settingsDataRedis();
			toastr()->success('Data has been deleted successfully!');
			return redirect(backUrl($this->moduleName));
		}else{
			toastr()->error('Technical Issue!');
			return redirect(backUrl($this->moduleName));
		}
	}

	public function checkSlug(Request $request)
	{
		$slug = str_slug($request->fieldTitle);

		$slug = SlugService::createSlug(Settings::class, 'slug', $request->fieldTitle);

		return response()->json(['slug' => $slug]);
	}

	/* Store Data in Redis For SettingParams */

	public function settingsDataRedis(){

		$data = Settings::get()->toArray();

		if(!empty($data)){
			foreach($data as $dataval){
				$setting[$dataval['slug']] = $dataval['value'];
			}
			Redis::set('settingParams', json_encode($setting));
		}
		return true;
		
		
	}
}
