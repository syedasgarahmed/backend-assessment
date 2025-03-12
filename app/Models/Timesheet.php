<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timesheet extends Model
{
    use HasFactory;

    protected $fillable = ['task_name', 'date', 'hours', 'user_id', 'project_id'];

    /**
     * Get the user that owns the timesheet.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the project that this timesheet belongs to.
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
