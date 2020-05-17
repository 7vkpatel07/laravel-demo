<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Translation;
use App\Modules;
use App\Language;
use JsValidator;
use Session;
use Validator;
use Illuminate\Support\Facades\Redis;
use Auth;
use Carbon\Carbon;

class AdminTranslationController extends Controller
{

	public $moduleName = 'translation';
    //
	public function __construct()
	{
        //$this->middleware('auth');
	}


	

	

	/* Listing Page */
	public function index(Request $request)
	{
		
		
		$dataQuery = Translation::with('modules');

		if ($request->has('search_by_module') && $request->search_by_module != '') {

			$dataQuery->where('module_id',$request->search_by_module);
		}
		if ($request->has('search_by_english_text') && $request->search_by_english_text != '') {

			$dataQuery->where('english_text','like','%'.$request->search_by_english_text.'%');
		}
		if ($request->has('search_by_translated_text') && $request->search_by_translated_text != '') {

			$dataQuery->where('translated_text','like','%'.$request->search_by_translated_text.'%');
		}
		

		$listing = $dataQuery->sortable()->paginate(config('constant.adminPerPage'));


		$modules = $this->getModules();


		return view('admin.translation_list',compact('listing','modules','request'));
	}

	/* Add Page */
	public function add()
	{
		$validator = [
			'module_id' => 'required',
			'lang_id' => 'required',
			'english_text' => 'required|unique:translation',
			'translated_text' => 'required',
		];

		$jsValidator = JsValidator::make($validator);

		$modules = $this->getModules();

		$languages = $this->getLanguages();

		return view('admin.translation_add',compact('jsValidator','modules','languages'));
	}

	/* Insertion */
	public function store(Request $request){

		$validator = Validator::make($request->all(), [
			'module_id' => 'required',
			'lang_id' => 'required',
			'english_text' => 'required|unique:translation',
			'translated_text' => 'required',
		]);

		if ($validator->fails()) {
			return redirect(backUrl($this->moduleName.'/add'))
			->withErrors($validator)
			->withInput();
		}else{

			$translation = new Translation;
			$translation->lang_id = $request->lang_id;
			$translation->module_id = $request->module_id;
			$translation->english_text = $request->english_text;
			$translation->translated_text = $request->translated_text;
			$translation->created_at = Carbon::now();

			if($translation->save()){
				$this->languageDataRedis();
				toastr()->success('Data has been saved successfully!');
				return redirect(backUrl($this->moduleName));
			}else{
				toastr()->error('Technical Issue!');
				return redirect(backUrl($this->moduleName.'/add'))->withInput();
			}
		}


	}

	/* Edit Page */
	public function edit($id)
	{

		$data = Translation::with('modules')->find($id);
		$validator = [
			'module_id' => 'required',
			'lang_id' => 'required',
			'english_text' => 'required|unique:translation,english_text,'.$id,
			'translated_text' => 'required',
		];

		$jsValidator = JsValidator::make($validator);

		$modules = $this->getModules();

		$languages = $this->getLanguages();

		return view('admin.translation_edit',compact('jsValidator','data','modules','languages'));
	}

	/* Update */
	public function update(Request $request){

		$validator = Validator::make($request->all(), [
			'module_id' => 'required',
			'lang_id' => 'required',
			'english_text' => 'required|unique:translation,english_text,'.$request->id,
			'translated_text' => 'required',
		]);

		if ($validator->fails()) {
			return redirect(backUrl($this->moduleName.'/edit'))
			->withErrors($validator)
			->withInput();
		}else{

			$translation = Translation::find($request->id);
			$translation->lang_id = $request->lang_id;
			$translation->module_id = $request->module_id;
			$translation->english_text = $request->english_text;
			$translation->translated_text = $request->translated_text;
			$translation->updated_at = Carbon::now();

			if($translation->save()){
				$this->languageDataRedis();
				toastr()->success('Data has been saved successfully!');
				return redirect(backUrl($this->moduleName));
			}else{
				toastr()->error('Technical Issue!');
				return redirect(backUrl($this->moduleName.'/edit'))->withInput();
			}
		}


	}

	/* Delete */
	public function delete($id){
		$data = Translation::find($id);
		if($data->delete()){
			$this->languageDataRedis();
			toastr()->success('Data has been deleted successfully!');
			return redirect(backUrl($this->moduleName));
		}else{
			toastr()->error('Technical Issue!');
			return redirect(backUrl($this->moduleName));
		}
	}

	/* Get Modules Data */
	public function getModules(){
		return Modules::all();
	}

	/* Get Modules Data */
	public function getLanguages(){
		return Language::all();
	}



	public function molduleIndex(Request $request)
	{


		$dataQuery = Translation::with('modules');

		/*if ($request->has('search_by_module') && $request->search_by_module != '') {

			$dataQuery->where('module_id',$request->search_by_module);
		}*/

		$dataQuery->where('module_id',$request->module_id);
		$listing = $dataQuery->sortable()->paginate(config('constant.adminPerPage'));
		

		$modules = $this->getModules();

		$languages = $this->getLanguages();


		$moduleName = $this->getModuleName($request->module_id);


		return view('admin.translation_module_list',compact('listing','modules','request','languages'))->with('moduleName',$moduleName);
	}

	/* Add Page */
	public function moduleAdd(Request $request)
	{
		$validator = [
			'module_id' => 'required',
			'lang_id' => 'required',
			'english_text' => 'required|unique:translation',
			'translated_text' => 'required',
		];

		$jsValidator = JsValidator::make($validator);

		$moduleName = $this->getModuleName($request->module_id);

		$languages = $this->getLanguages();

		return view('admin.translation_module_add',compact('jsValidator','request','languages'))->with('moduleName',$moduleName);
	}

	/* Insertion */
	public function moduleStore(Request $request){

		$validator = Validator::make($request->all(), [
			'module_id' => 'required',
			'lang_id' => 'required',
			'english_text' => 'required|unique:translation',
			'translated_text' => 'required',
		]);

		if ($validator->fails()) {
			return redirect(backUrl('translation/module/add/'.$request->module_id))
			->withErrors($validator)
			->withInput();
		}else{

			$translation = new Translation;
			$translation->lang_id = $request->lang_id;
			$translation->module_id = $request->module_id;
			$translation->english_text = $request->english_text;
			$translation->translated_text = $request->translated_text;
			$translation->created_at = Carbon::now();
			
			if($translation->save()){
				$this->languageDataRedis();
				toastr()->success('Data has been saved successfully!');
				return redirect(backUrl('translation/module/'.$request->module_id));
			}else{
				toastr()->error('Technical Issue!');
				return redirect(backUrl('translation/module/add/'.$request->module_id))->withInput();
			}
		}


	}

	/* Edit Page */
	public function moduleEdit(Request $request)
	{
		$id = $request->id;

		$data = Translation::with('modules')->find($id);
		$validator = [
			'module_id' => 'required',
			'lang_id' => 'required',
			'english_text' => 'required|unique:translation,english_text,'.$request->id,
			'translated_text' => 'required',
		];

		$jsValidator = JsValidator::make($validator);

		$moduleName = $this->getModuleName($request->module_id);

		$languages = $this->getLanguages();




		return view('admin.translation_module_edit',compact('jsValidator','data','request','languages'))->with('moduleName',$moduleName);
	}

	/* Update */
	public function moduleUpdate(Request $request){

		$validator = Validator::make($request->all(), [
			'module_id' => 'required',
			'lang_id' => 'required',
			'english_text' => 'required|unique:translation,english_text,'.$request->id,
			'translated_text' => 'required',
		]);

		if ($validator->fails()) {
			return redirect(backUrl('translation/edit'.$request->module_id.'/'.$request->id))
			->withErrors($validator)
			->withInput();
		}else{

			$translation = Translation::find($request->id);
			$translation->lang_id = $request->lang_id;
			$translation->module_id = $request->module_id;
			$translation->english_text = $request->english_text;
			$translation->translated_text = $request->translated_text;
			$translation->updated_at = Carbon::now();
			
			if($translation->save()){
				$this->languageDataRedis();
				toastr()->success('Data has been saved successfully!');
				return redirect(backUrl('translation/module/'.$request->module_id));
			}else{
				toastr()->error('Technical Issue!');
				return redirect(backUrl('translation/module/edit'.$request->module_id.'/'.$request->id))->withInput();
			}
		}


	}

	/* Delete */
	public function moduleDelete(Request $request){
		$id = $request->id;
		$data = Translation::find($id);
		if($data->delete()){
			$this->languageDataRedis();
			toastr()->success('Data has been deleted successfully!');
			return redirect(backUrl('translation/module/'.$request->module_id));
		}else{
			toastr()->error('Technical Issue!');
			return redirect(backUrl('translation/module/'.$request->module_id));
		}
	}

	public function getModuleName($id){
		$data = Modules::find($id);
		return $data->name;
		
	}


	/* Store Data in Redis */

	public function languageDataRedis(){

		$data = Translation::with('modules')->get()->toArray();
		if(!empty($data)){
			foreach($data as $dataval){
				if($dataval['modules']['name']!='General'){
					$lang[$dataval['module_id']][$dataval['lang_id']][$dataval['english_text']] = $dataval['translated_text'];
				}else{
					$lang['General'][$dataval['lang_id']][$dataval['english_text']] = $dataval['translated_text'];
				}
			}
			Redis::set('translate', json_encode($lang));
		}
		return true;
		
		
	}
	

}
