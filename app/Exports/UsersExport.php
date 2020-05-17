<?php

namespace App\Exports;

use App\User;
use App\Country;
use App\Skills;
use App\UsersSkills;
use App\Roles;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UsersExport implements FromView
{
    
    public function view(): View
    {
    	$dataQuery = User::with('country','userSkills');

    	$listing = $dataQuery->get();

        return view('export.export_user', [
            'listing' => $listing
        ]);
    }
}
