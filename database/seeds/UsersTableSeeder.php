<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
    	DB::table('users')->insert([
    		'first_name' => 'Eliran',
    		'last_name' => 'Shachar',
    		'email' =>'eliran@rclick.co.il',
    		'password' =>'$2y$10$5ksmBW2xdbEgvn7SfQCIWuyHoZZQfYoY0kpfjxz5tQ4JS76d3EUk6',
    		'is_superadmin' =>'1',
    		'language_id' =>'0',
    	]);
    }
}
