<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $projectId = $request->get('project_id');
        $projects = Project::all();
        $tasks = Task::when($projectId, fn($q) => $q->where('project_id', $projectId))
                     ->orderBy('priority')->get();

        return view('tasks.index', compact('tasks', 'projects', 'projectId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'project_id' => 'nullable|exists:projects,id'
        ]);

        $priority = Task::where('project_id', $request->project_id)->max('priority') + 1;

        Task::create([
            'name' => $request->name,
            'priority' => $priority,
            'project_id' => $request->project_id
        ]);

        return redirect()->back();
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        $task->update(['name' => $request->name]);

        return redirect()->back();
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->back();
    }

    public function reorder(Request $request)
    {
        foreach ($request->order as $index => $taskId) {
            Task::where('id', $taskId)->update(['priority' => $index + 1]);
        }

        return response()->json(['status' => 'success']);
    }
}
