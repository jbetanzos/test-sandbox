<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function index()
    {
        $tasks = Task::where('status', Task::PENDING)->get();

        return response()->json($tasks, 200);
    }

    public function done(Request $request, $id)
    {
	    $task = Task::find($id);

	    if (!$task) {
		    return response()->json(['error', 'Task not found'], 404);
	    }

	    $task->status = Task::DONE;

	    if ($task->save()) {
		    return response()->json($task, 200);
	    }

	    return response()->json(['error', 'Operation failed'], 400);
    }

    public function delete(Request $request, $id)
    {
	    $task = Task::find($id);

	    if (!$task) {
		    return response()->json(['error', 'Task not found'], 404);
	    }

	    $task->status = Task::DELETED;

	    if ($task->save()) {
		    return response()->json($task, 200);
	    }

	    return response()->json(['error', 'Operation failed'], 400);
    }

    public function create(Request $request)
    {
	    $description = $request->get('description');

    	$newTask = new Task();
    	$newTask->description = $description;
    	$newTask->status = Task::PENDING;

    	if ($newTask->save()) {
		    return response()->json($newTask, 200);
	    }

	    return response()->json(['error', 'Operation failed'], 400);
    }

    public function tasks(Request $request, string $type)
    {
    	$types = [Task::DONE, Task::DELETED, Task::PENDING];

    	if (in_array(strtoupper($type), $types)) {
		    $tasks = Task::where('status', $type)->get();

		    return response()->json($tasks, 200);
	    }

	    return response()->json(['error', 'Operation not supported'], 400);
    }
}
