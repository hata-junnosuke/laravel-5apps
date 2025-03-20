<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tasks = [
            ['task_name' => 'Task 1', 'due_date' => '2025-03-20'],
            ['task_name' => 'Task 2', 'due_date' => '2025-03-21'],
            ['task_name' => 'Task 3', 'due_date' => '2025-03-22'],
        ];

        foreach ($tasks as $task) {
            Task::create([
                'task_name' => $task['task_name'],
                'due_date' => $task['due_date'],
                'is_deleted' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }   
}
