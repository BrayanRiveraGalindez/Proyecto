<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{

	public function run()
	{
		$user = new User([
			'number_id' => '1093221111',
			'name' => 'Brayan',
			'last_name' => 'Rivera',
			'email' => 'riveragalindez636@gmail.com',
			'password' => '123456789',
			'remember_token' => Str::random(10),
		]);
		$user ->save();
		$user ->assignRole('admin');
	}
}
