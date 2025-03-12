<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Timesheet;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getProjects(Request $request)
    {
        if ($request->ajax()) {
            $user = Auth::user();
            if ($user) {
                $projects = $user->projects;
                return DataTables::of($projects)
                    ->addIndexColumn()
                    ->editColumn('created_at', function ($project) {
                        return $project->created_at ? $project->created_at->format('d/m/y h:i A') : '';
                    })
                    ->editColumn('updated_at', function ($project) {
                        return $project->updated_at ? $project->updated_at->format('d/m/y h:i A') : '';
                    })
                    ->make(true);
            }
        }
    }

    public function getMyProjects()
    {
        return view('user.projects');
    }

    public function getMyTimeSheet()
    {
        return view('user.timesheet');
    }

    public function getTimesheets(Request $request)
    {
        if ($request->ajax()) {
            $user = Auth::user();
            if ($user) {
                $timesheets = Timesheet::where('user_id', $user->id)->get();
                return DataTables::of($timesheets)
                    ->addIndexColumn()
                    ->editColumn('created_at', function ($timesheet) {
                        return $timesheet->created_at ? $timesheet->created_at->format('d/m/y h:i A') : '';
                    })
                    ->editColumn('status', function ($timesheet) {
                        return $timesheet->status;
                    })
                    ->make(true);
            }
        }
    }

    public function updateTimesheetStatus(Request $request)
    {
        $request->validate([
            'task_id' => 'required|exists:timesheets,id',
            'status' => 'required|string|in:Pending,In Progress,Completed'
        ]);

        $timesheet = Timesheet::findOrFail($request->task_id);
        $timesheet->status = $request->status;
        $timesheet->save();

        return response()->json(['message' => 'Status updated successfully.']);
    }

    public function index()
    {
        return view('user.dashboard');
    }
}
