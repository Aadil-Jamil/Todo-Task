<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{

    public function index()
    {
        return view('tasks.index')->with('tasks', Todo::with('user')->get());
    }
}
