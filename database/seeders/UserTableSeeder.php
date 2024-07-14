<?php

namespace Database\Seeders;

use App\Models\User;
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

            // Department 1
            [
                'first_name' => 'Department',
                'last_name' => 'Head 1',
                'username' => 'department_head1',
                'email' => 'departmenthead1@gmail.com',
                'password' => 'departmenthead12001',
                'phone_number' => '+12398190255',
                'email_verified_at' => now(),
                'user_type' => 'department_head',
                'is_active' => 1,
            ],
            [
                'manager' => 'department_head1',
                'first_name' => 'Division',
                'last_name' => 'Head 1',
                'username' => 'division_head1',
                'email' => 'divisionhead1@gmail.com',
                'password' => 'divisionhead12001',
                'phone_number' => '+12398190255',
                'email_verified_at' => now(),
                'user_type' => 'division_head',
                'is_active' => 1,
            ],
            [
                'manager' => 'division_head1',
                'first_name' => 'Staff',
                'last_name' => '1',
                'username' => 'staff1',
                'email' => 'staff1@gmail.com',
                'password' => 'staff12001',
                'phone_number' => '+12398190255',
                'email_verified_at' => now(),
                'user_type' => 'staff',
                'is_active' => 1,
            ],

            // Department 2
            [
                'first_name' => 'Department',
                'last_name' => 'Head 2',
                'username' => 'department_head2',
                'email' => 'departmenthead2@gmail.com',
                'password' => 'departmenthead22001',
                'phone_number' => '+12398190255',
                'email_verified_at' => now(),
                'user_type' => 'department_head',
                'is_active' => 1,
            ],
            [
                'manager' => 'department_head2',
                'first_name' => 'Division',
                'last_name' => 'Head 2',
                'username' => 'division_head2',
                'email' => 'divisionhead2@gmail.com',
                'password' => 'divisionhead22001',
                'phone_number' => '+12398190255',
                'email_verified_at' => now(),
                'user_type' => 'division_head',
                'is_active' => 1,
            ],
            [
                'manager' => 'division_head2',
                'first_name' => 'Staff',
                'last_name' => '2',
                'username' => 'staff2',
                'email' => 'staff2@gmail.com',
                'password' => 'staff22001',
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
        if (isset($userData['manager'])) {
            $userData['manager_id'] = User::where('username', $userData['manager'])->first()->id;
            unset($userData['manager']);
        }
        $user = User::create($userData);
        $user->assignRole($userData['user_type']);
    }
}
