<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleAndPermissionSeeder;
use Database\Seeders\UserSeeder;

class DatabaseSeeder extends Seeder
{
	public function run()
	{
		$this->call([
			RoleAndPermissionSeeder::class,
			UserSeeder::class,
			CategorySeeder::class,
		]);
		User::factory(8)->create();
		Product::factory(10)->create();
	}
}
