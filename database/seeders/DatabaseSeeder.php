<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleTableSeeder::class,
            PermissionBaseSeeder::class,
            UserTableSeeder::class,
            DailyLogTableSeeder::class,
            DynamicFormSeeder::class,
            ProvinceSeeder::class,
        ]);
    }
}
