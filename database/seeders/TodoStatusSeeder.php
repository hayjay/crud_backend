<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TodoStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('todo_statuses')->insert([
            'name' => 'Todo',
        ]);
        DB::table('todo_statuses')->insert([
            'name' => 'In Progress',
        ]);
        DB::table('todo_statuses')->insert([
            'name' => 'Done',
        ]);
    }
}