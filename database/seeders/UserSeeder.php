<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'first_name' => 'manager',
                'last_name' => '1',
                'email' => 'manager1@test.com',
                'phone' => '01142297280',
                'password' => Hash::make('Aa$123456'),
                'is_manager' => 1,
                'department_id' => 1,
                'salary' => 20000,
            ],
            [
                'first_name' => 'manager',
                'last_name' => '2',
                'email' => 'manager2@test.com',
                'phone' => '01100000000',
                'password' => Hash::make('Aa$123456'),
                'is_manager' => 1,
                'department_id' => 1,
                'salary' => 20000,
            ],
            [
                'first_name' => 'test',
                'last_name' => '101',
                'email' => 'test101@test101.com',
                'phone' => '01100000001',
                'password' => Hash::make('Aa$123456'),
                'is_manager' => 0,
                'manager_id' => 1,
                'department_id' => 1,
                'salary' => 5000,
            ],
            [
                'first_name' => 'test',
                'last_name' => '102',
                'email' => 'test102@test102.com',
                'phone' => '01100000002',
                'password' => Hash::make('Aa$123456'),
                'is_manager' => 0,
                'manager_id' => 1,
                'department_id' => 2,
                'salary' => 6000,
            ],
            [
                'first_name' => 'test',
                'last_name' => '103',
                'email' => 'test103@test103.com',
                'phone' => '01100000003',
                'password' => Hash::make('Aa$123456'),
                'is_manager' => 0,
                'manager_id' => 1,
                'department_id' => 3,
                'salary' => 7000,
            ],
            [
                'first_name' => 'test',
                'last_name' => '104',
                'email' => 'test104@test104.com',
                'phone' => '0110000004',
                'password' => Hash::make('Aa$123456'),
                'is_manager' => 0,
                'manager_id' => 1,
                'department_id' => 3,
                'salary' => 7000,
            ],
            [
                'first_name' => 'test',
                'last_name' => '105',
                'email' => 'test105@test105.com',
                'phone' => '0110000005',
                'password' => Hash::make('Aa$123456'),
                'is_manager' => 0,
                'manager_id' => 1,
                'department_id' => 3,
                'salary' => 7000,
            ],
            [
                'first_name' => 'test',
                'last_name' => '201',
                'email' => 'test201@test201.com',
                'phone' => '01100000004',
                'password' => Hash::make('Aa$123456'),
                'is_manager' => 0,
                'manager_id' => 2,
                'department_id' => 1,
                'salary' => 5000,
            ],
            [
                'first_name' => 'test',
                'last_name' => '202',
                'email' => 'test202@test202.com',
                'phone' => '01100000005',
                'password' => Hash::make('Aa$123456'),
                'is_manager' => 0,
                'manager_id' => 2,
                'department_id' => 2,
                'salary' => 6000,
            ],
            [
                'first_name' => 'test',
                'last_name' => '203',
                'email' => 'test203@test203.com',
                'phone' => '01100000006',
                'password' => Hash::make('Aa$123456'),
                'is_manager' => 0,
                'manager_id' => 2,
                'department_id' => 3,
                'salary' => 7000,
            ],
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }
    }
}
