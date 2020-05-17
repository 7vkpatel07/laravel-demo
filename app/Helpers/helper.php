<?php

use App\Language;
/* Dynamimc admin URL */
function backUrl($url = '')
{

	$url = ($url!='')?'/'.$url:'';
	return url(config('constant.backend').$url);
}

function convertDateInYMD($date){

	$date = strtotime($date);

	return date("Y-m-d",$date);
}

function convertDate($date){

	$date = strtotime($date);

	return date(settingParam('date-format'),$date);
}

function displayName(){
	$langId = isset(Auth::user()->language_id)?Auth::user()->language_id:0;
	$name = isset(Auth::user()->first_name_en)?Auth::user()->first_name_en:'';
	if($langId == 1){
		$name = isset(Auth::user()->first_name)?Auth::user()->first_name:'';
	}

	return $name;
}

function displayProfile(){
	$profilePicture = "";
	if(isset(Auth::user()->profile_photo) && Auth::user()->profile_photo!='' && file_exists(storage_path('app\public\users\thumb_'.Auth::user()->profile_photo))){

		$profilePicture = url('storage/users/thumb_'.Auth::user()->profile_photo);
	}
	
	return $profilePicture;
}

function getLanguages(){
	return Language::all();
}


