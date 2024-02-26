<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tasks = [
            [
                'title' => 'first task',
                'description' => 'first task description',
                'user_id' => 4,
                'status' => 'new',
            ],
            [
                'title' => 'second task',
                'description' => 'second task description',
                'user_id' => 7,
                'status' => 'new',
            ],
            [
                'title' => 'second task',
                'description' => 'second task description',
                'user_id' => 5,
                'status' => 'pending',
            ],
        ];

        foreach ($tasks as $taskData) {
            Task::create($taskData);
        }
    }
}
