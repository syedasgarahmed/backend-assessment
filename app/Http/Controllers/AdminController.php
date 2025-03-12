<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use App\Models\Attribute;
use App\Models\Timesheet;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{

    public function index()
    {
        return view('admin.dashboard');
    }

    public function viewProjects()
    {
        return view('admin.projects');  // Create this Blade file
    }

    public function viewUsers()
    {
        return view('admin.users');  // Create this Blade file
    }

    public function viewAttributes()
    {
        return view('admin.attributes');  // Create this Blade file
    }

    public function getProjects(Request $request)
    {
        if ($request->ajax()) {
            $projects = Project::select(['id', 'name', 'status', 'department', 'created_at', 'updated_at']);

            return DataTables::of($projects)
                ->addIndexColumn()
                ->editColumn('created_at', function ($project) {
                    return $project->created_at ? $project->created_at->format('d/m/y h:i A') : '';
                })
                ->editColumn('updated_at', function ($project) {
                    return $project->updated_at ? $project->updated_at->format('d/m/y h:i A') : '';
                })
                ->editColumn('name', function ($project) {
                    return '<span class="view-users" data-id="' . $project->id . '" style="color: blue; cursor: pointer;">' . $project->name . '</span>';
                })
                ->addColumn('action', function ($project) {
                    return '<button class="edit-project bg-yellow-500 text-white py-1 px-2 rounded" data-id="' . $project->id . '" data-name="' . $project->name . '" data-status="' . $project->status . '">Edit</button>';
                })
                ->rawColumns(['name', 'action'])
                ->make(true);
        }
    }

    public function getProjectUsersTable(Request $request)
    {
        $project = Project::findOrFail($request->project_id);
        $users = $project->users()->select(['first_name', 'email', 'created_at'])->get();

        $formattedUsers = $users->map(function ($user) {
            return [
                'first_name' => $user->first_name,
                'email' => $user->email,
                'created_at' => $user->created_at ? $user->created_at->format('d/m/y h:i A') : '',
            ];
        });

        return response()->json(['users' => $formattedUsers]);
    }



    public function updateProject(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:projects,id',
            'status' => 'required|string|in:New,Ongoing,Active,Pending,Completed',
            'department' => 'required|string',
            'users' => 'nullable|array',
            'users.*' => 'exists:users,id',
        ]);

        $project = Project::find($request->id);
        $project->status = $request->status;
        $project->department = $request->department;
        $project->save();

        // Sync Users (0 or more)
        $project->users()->sync($request->users ?? []);

        return response()->json(['success' => true]);
    }

    public function getUsersList()
    {
        return User::select(['id', 'first_name'])->get();
    }

    public function getProjectUsers(Request $request)
    {
        $project = Project::find($request->project_id);
        return $project->users()->pluck('id');
    }


    // Fetch User for Editing
    public function getUser(Request $request)
    {
        $user = User::findOrFail($request->id);
        return response()->json([
            'id' => $user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
        ]);
    }

    // Update User Data
    public function updateUser(Request $request)
    {
        $user = User::findOrFail($request->id);

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;

        $user->save();

        return response()->json(['success' => true]);
    }

    public function createProject(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|string|in:New,Ongoing,Active,Pending,Completed',
            'department' => 'required|string|max:255',
        ]);

        Project::create([
            'name' => $request->name,
            'status' => $request->status,
            'department' => $request->department,

        ]);

        return response()->json(['success' => true]);
    }


    public function getUsers()
    {
        $users = User::all();
        return DataTables::of($users)
            ->addIndexColumn()
            ->editColumn('full_name', function ($user) {
                $fullName = $user->first_name . ' ' . $user->last_name;
                return '<a href="#" class="text-blue-500 user-link" data-id="' . $user->id . '">' . $fullName . '</a>';
            })
            ->addColumn('actions', function ($user) {
                return '
                    <button class="text-blue-600 hover:underline edit-user" data-id="' . $user->id . '">Edit</button> | 
                    <button class="text-red-600 hover:underline delete-user" data-id="' . $user->id . '">Delete</button>
                ';
            })
            ->rawColumns(['full_name', 'actions'])
            ->editColumn('created_at', function ($user) {
                return $user->created_at ? $user->created_at->format('d/m/y h:i A') : '';
            })
            ->editColumn('updated_at', function ($user) {
                return $user->updated_at ? $user->updated_at->format('d/m/y h:i A') : '';
            })
            ->make(true);
    }

    public function deleteUser(Request $request)
    {
        $user = User::find($request->user_id);

        if ($user) {
            $user->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }


    public function getUserProjects(Request $request)
    {
        $userId = $request->input('user_id');

        $projects = Project::whereHas('users', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->get(['name', 'status', 'created_at']);

        return response()->json(['projects' => $projects]);
    }




    public function getAttributes()
    {
        $attributes = Attribute::all();
        return DataTables::of($attributes)
            ->addIndexColumn()
            ->editColumn('created_at', function ($attribute) {
                return $attribute->created_at ? $attribute->created_at->format('d/m/y h:i A') : '';
            })
            ->editColumn('updated_at', function ($attribute) {
                return $attribute->updated_at ? $attribute->updated_at->format('d/m/y h:i A') : '';
            })
            ->make(true);
    }

    public function showTimesheets()
    {
        $projects = Project::all(); // Make sure your Project model is properly imported and configured
        $users = User::select(['id', 'first_name'])->get();
        return view('admin.timesheets', compact('projects', 'users'));
    }

    public function getTimesheet(Request $request)
    {
        if ($request->ajax()) {
            $timesheets = Timesheet::with(['user', 'project'])
                ->select('*')
                ->get();

            return DataTables::of($timesheets)
                ->addIndexColumn()
                ->editColumn('user.first_name', function ($timesheet) {
                    return '<a href="javascript:void(0);" class="user-link text-blue-500" data-user-id="' . $timesheet->user->id . '">' . $timesheet->user->first_name . '</a>';
                })
                ->editColumn('created_at', function ($timesheet) {
                    return $timesheet->created_at ? $timesheet->created_at->format('d/m/y h:i A') : '';
                })
                ->addColumn('id', function ($timesheet) {
                    return $timesheet->id;
                })
                ->rawColumns(['user.first_name'])
                ->make(true);
        }
    }
    public function update_TimesheetStatus(Request $request)
    {
        $timesheet = Timesheet::find($request->id);
        if ($timesheet) {
            $timesheet->status = $request->status;
            $timesheet->save();

            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }

    public function createTimesheet(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id',
            'task_name' => 'required|string|max:255',
            'date' => 'required|date',
            'hour' => 'required|numeric|min:0',
        ]);

        $success = true;

        foreach ($request->user_ids as $userId) {
            $timesheet = Timesheet::create([
                'project_id' => $request->project_id,
                'user_id' => $userId,
                'task_name' => $request->task_name,
                'date' => $request->date,
                'hours' => $request->hour,
                'status' => 'Pending',
            ]);

            if (!$timesheet) {
                $success = false;
                break;
            }
        }

        return response()->json(['success' => $success]);
    }



    public function getUserTimesheets($Id)
    {
        $timesheets = Timesheet::where('user_id', $Id)->with('project')->get();

        $html = '';
        foreach ($timesheets as $timesheet) {
            $html .= '<tr>
                        <td>' . $timesheet->project->name . '</td>
                        <td>' . $timesheet->task_name . '</td>
                        <td>' . $timesheet->date . '</td>
                        <td>' . $timesheet->hours . '</td>
                        <td>' . $timesheet->created_at->format('d/m/y h:i A') . '</td>
                      </tr>';
        }

        return $html;
    }
}
