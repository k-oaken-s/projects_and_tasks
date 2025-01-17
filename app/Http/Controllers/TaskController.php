<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with(['project', 'assignedUser'])
            ->whereHas('project', function ($query) {
                $query->where('user_id', auth()->id);
            })
            ->latest()
            ->get();
        
        return view('tasks.index', compact('tasks'));
    }

    public function create(Project $project)
    {
        $users = \App\Models\User::all(); // タスクの割り当て可能なユーザー一覧
        return view('tasks.create', compact('project', 'users'));
    }

    public function store(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'status' => 'required|in:not_started,in_progress,completed',
            'priority' => 'required|in:low,medium,high',
            'due_date' => 'required|date',
            'assigned_to' => 'required|exists:users,id'
        ]);

        $task = $project->tasks()->create($validated);
        return redirect()->route('projects.show', $project)
            ->with('success', 'Task created successfully.');
    }

    public function edit(Task $task)
    {
        $users = \App\Models\User::all();
        return view('tasks.edit', compact('task', 'users'));
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'status' => 'required|in:not_started,in_progress,completed',
            'priority' => 'required|in:low,medium,high',
            'due_date' => 'required|date',
            'assigned_to' => 'required|exists:users,id'
        ]);

        $task->update($validated);
        return redirect()->route('projects.show', $task->project)
            ->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        $project = $task->project;
        $task->delete();
        return redirect()->route('projects.show', $project)
            ->with('success', 'Task deleted successfully.');
    }
}
