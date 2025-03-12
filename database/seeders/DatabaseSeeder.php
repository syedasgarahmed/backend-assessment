<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Project;
use Illuminate\Database\Seeder;
use App\Models\Attribute;
use App\Models\Timesheet;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->count(5)->create();

        $projects = Project::factory()->count(3)->create();

        foreach ($projects as $project) {
            Timesheet::factory()->count(5)->create(['project_id' => $project->id]);
        }

        Attribute::create(['name' => 'department', 'type' => 'text']);
        Attribute::create(['name' => 'start_date', 'type' => 'date']);
        Attribute::create(['name' => 'end_date', 'type' => 'date']);
    }
}