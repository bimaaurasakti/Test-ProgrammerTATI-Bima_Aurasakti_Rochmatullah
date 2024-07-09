<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\User;
use App\Models\Customer;
use App\Models\District;
use App\Models\Province;
use App\Models\Subdistrict;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $usersData = [
            [
                'first_name' => 'Super',
                'last_name' => 'Admin',
                'username' => 'super_admin',
                'email' => 'superadmin@tati.com',
                'password' => 'superadmin2001',
                'phone_number' => '+12398190255',
                'email_verified_at' => now(),
                'user_type' => 'super_admin',
                'is_active' => 1,
            ],
            [
                'first_name' => 'Department',
                'last_name' => 'Head',
                'username' => 'department_head',
                'email' => 'departmenthead@tati.com',
                'password' => 'departmenthead2001',
                'phone_number' => '+12398190255',
                'email_verified_at' => now(),
                'user_type' => 'department_head',
                'is_active' => 1,
            ],
            [
                'first_name' => 'Division',
                'last_name' => 'Head',
                'username' => 'division_head',
                'email' => 'divisionhead@tati.com',
                'password' => 'divisionhead2001',
                'phone_number' => '+12398190255',
                'email_verified_at' => now(),
                'user_type' => 'division_head',
                'is_active' => 1,
            ],
            [
                'first_name' => 'Staff',
                'last_name' => '1',
                'username' => 'staff',
                'email' => 'staff@tati.com',
                'password' => 'staff2001',
                'phone_number' => '+12398190255',
                'email_verified_at' => now(),
                'user_type' => 'staff',
                'is_active' => 1,
            ],
        ];

        foreach ($usersData as $userData) {
            $this->createUserWithRole($userData);
        }
    }

    private function createUserWithRole(array $userData)
    {
        $user = User::create($userData);
        $user->assignRole($userData['user_type']);
    }
}
