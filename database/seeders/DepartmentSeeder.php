<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            'Accounting',
            'Sales',
            'Purchase',
            'Development',
            'Hr',
        ];

        foreach ($departments as $departmentName) {
            Department::create([
                'name' => $departmentName,
            ]);
        }
    }
}
