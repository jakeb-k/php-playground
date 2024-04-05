<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tasks')->insert([
            'task' => 'Go buy groceries',
            'priority'=> 1, 
            'due_date' => Carbon::now()->addDays(1), 
        ]);
        DB::table('tasks')->insert([
            'task' => 'Clean your room',
            'priority'=> 2, 
            'due_date' => Carbon::now()->addDays(2), 
        ]);
        DB::table('tasks')->insert([
            'task' => 'Watch new podcast',
            'priority'=> 3, 
            'due_date' => Carbon::now()->addDays(3), 
        ]);
        
    }
}
