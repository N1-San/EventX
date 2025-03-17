<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return Task::with('event', 'user')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'user_id' => 'nullable|exists:users,id',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in_progress,completed',
            'deadline' => 'nullable|date',
        ]);

        return Task::create($validated);
    }

    public function show(Task $task)
    {
        return $task->load('event', 'user');
    }

    public function update(Request $request, Task $task)
    {
        $task->update($request->all());
        return response()->json(['message' => 'Task updated successfully', 'task' => $task]);
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(['message' => 'Task deleted successfully']);
    }

    public function getTasksByEvent($event_id)
    {
        return Task::where('event_id', $event_id)->get();
    }
}
