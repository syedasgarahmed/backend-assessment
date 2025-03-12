<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run()
    {
        $project = Project::create(['name' => 'Project A', 'status' => 'Active']);

        $users = User::take(3)->get();
        $project->users()->attach($users);
    }
}
