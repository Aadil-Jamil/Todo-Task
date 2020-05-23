<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Todo;
use App\User;
use Illuminate\Http\Request;

class TodoController extends Controller
{

    public function index(Request $request)
    {
        $user = $request->user_id;
        $todos = Todo::where('user_id',  $user)->get();

        return response()->json(['data' => $todos], 200);
    }

    public function store(Request $request)
    {
        return $request;
        $this->validate(request(), [
            'taskText' => 'required:string',
            'user_id' => 'required:integer'
        ]);

        $data = request()->all();

        $todo = new Todo;
        $todo->taskText = $data['taskText'];
        $todo->user_id = $data['user_id'];

        $todo->save();

        return response()->json(['data' => $todo], 200);
    }

    public function show($id)
    {
        $todo = Todo::findOrFail($id);

        return response()->json(['data' => $todo],200);
    }

    public function update($id)
    {
        $this->validate(request(), [
            'taskText' => 'required:string',
            'isDone' => 'required',
            'user_id' => 'required'
        ]);

        $data = request()->all();

        $todo = Todo::find($id);

        $todo->taskText = $data['taskText'];
        $todo->isDone = $data['isDone'];
        $todo->user_id = $data['user_id'];

        $todo->save();

        return response()->json(['message' => 'Task Updated!', 'data' => $todo],200);

    }

    public function destroy($id)
    {
        $task = Todo::findOrFail($id);

        $task->delete();

        return response()->json(['message' => 'Task Deleted Successfully'],200);
    }
}
