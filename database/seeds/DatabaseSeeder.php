<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$this->call(UserSeeder::class);
		$this->call(RoleSeeder::class);
		$this->call(PermissionSeeder::class);
		$this->call(AttributegroupSeeder::class);
		$this->call(AttributevalueSeeder::class);
		//数据较大比较慢
		$this->call(DistrictSeeder::class);
		
    }
}
