<?php
use Illuminate\Support\Facades\Redis;

function translate($string = ''){
	
	$transVal = "";
	$returnVal = $string; 

	$langId = isset(Auth::user()->language_id)?Auth::user()->language_id:0;

	$moduleId = (Session::has('module_id'))?Session::get('module_id'):0;
	$response = Redis::get('translate');

	
	if($response!=''){
		$langData = json_decode($response, true);
		if(isset($langData) && !empty($langData)){


			/* Check Module base language translation */
			if($langId == 0){

				if(isset($langData[$moduleId][1]) && array_key_exists($string,$langData[$moduleId][1])){
					$transVal = $string;
				}

			}else{
				$transVal = (isset($langData[$moduleId][$langId][$string]))?$langData[$moduleId][$langId][$string]:"";
			}

			/* IF Module have no value found then check the value from General Module */

			if($transVal == ""){

				if($langId == 0){
					if(isset($langData['General'][1]) && array_key_exists($string,$langData['General'][1])){
						$returnVal = $string;
					}
				}else{

					$returnVal = (isset($langData['General'][$langId][$string]))?$langData['General'][$langId][$string]:$string;
				}
			}else{
				$returnVal = $transVal;
			}
		}
	}

	return $returnVal;
	//Redis::del('translate');
	
}

function settingParam($string = ''){

	$returnVal = "";
	$response = Redis::get('settingParams');
	if($response!=''){
		$settingsData = json_decode($response, true);

		if(isset($settingsData) && !empty($settingsData)){
			if(isset($settingsData[$string]) && $settingsData[$string]!=''){
				$returnVal = $settingsData[$string];
			}

		}
		

	}
	return $returnVal;
}

function currentLanguage(){
	$langId = isset(Auth::user()->language_id)?Auth::user()->language_id:0;
	return $langId;
}



