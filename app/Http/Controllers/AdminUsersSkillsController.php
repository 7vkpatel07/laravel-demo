<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Skills;
use App\UsersSkills;
use App\User;

class AdminUsersSkillsController extends Controller
{
	public $moduleName = "users-skills";

	/* Add View */
	public function assign(Request $request)
	{
		
		$skills = skills::all();
		$userId = $request->id;
		$userSkills = UsersSkills::select('skill_id')->where('user_id',$userId)->pluck('skill_id')->toArray();
		$userDetail = User::select("email")->find($userId);

		return view('admin.users_skills_add',compact('skills','userId','userSkills','userDetail'));
	}

	/* Store Function for Save values */
	public function store(Request $request){

		//echo "<pre>"; print_r($request->all());exit;
		$skills = [];
		$skills = $request->skill_id;
		if(isset($skills) && !empty($skills))
		{

			$this->delete($request->userId);

			foreach($skills as $skillsId){
				$users_skills = new UsersSkills;
				$users_skills->user_id = $request->userId;
				$users_skills->skill_id = $skillsId;
				$users_skills->save();
			}
			
			toastr()->success('Skill assigned successfully!');
			return redirect(backUrl('user'));
			
		}else{
			toastr()->error('Technical Issue!');
			return redirect(backUrl($this->moduleName.'/assign/'.$request->userId))->withInput();
		}


	}

	public function delete($user_id){
		$data = UsersSkills::where('user_id',$user_id)->delete();

		return true;
	}
}
