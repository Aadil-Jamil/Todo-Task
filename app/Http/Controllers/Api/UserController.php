<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();

        return response()->json(['data' => $users ],200);
    }

    public function show($id)
    {
        $user = User::find($id);

        return response()->json(['data' => $user],200);
    }

}
