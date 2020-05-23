<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (!$request->filled('email') || !$request->filled('password'))
            return ['error' => 'INVALID_REQUEST'];

        $user = User::where('email', $request->email && Hash::check('password', $request->password))->first();
        $api_token = $this->random(80);
        if ($user) {
            $user->api_token = $api_token;
            $user->save();
            return ['exist' => true, 'user' => $user,'api_token' => $api_token];
        }

        return ['user' => null, 'exist' => false];
    }

    public function verify(Request $request)
    {
        if(!$request->filled('email', 'password'))
            return ['error' => 'INVALID_REQUEST'];

        $user = User::where('email', $request->email && Hash::check('password', $request->password))->first();

        if($user) {
            $user->api_token = \Str::random(80);
            $user->save();
            return [ 'user' => $user, 'api_token' => $user->api_token, 'success' => 1 ];
        }

        return ['error' => 'invalid_email or password'];
    }


    public function register(Request $request)
    {
        $required = ['name', 'email', 'password'];


//		return ['error' => json_encode($request->all())];
        if ($request->filled($required)) {
            $user = User::where('email', $request->email)
                ->first();

            if (!$user) {
                if (User::where('email', $request->email)->exists())
                    return ['error' => 'email_already_exists'];

                $newUser = new User($request->only($required));
                $newUser->api_token = $this->random(80);
                $newUser->password = bcrypt($request->password);
                $newUser->save();

                return ['user' => $newUser, 'api_token' => $newUser->api_token, 'success' => 1];
            } else {
                return ['error' => 'already_exists'];
            }
        } else {
            return ['error' => 'required fields must be present in the request ' . implode(', ', $required)];
        }
    }

    private function random($length = 4)
    {
        $string='';
        $characters = "0123456789";
        for ($p = 0; $p < $length ; $p++) {
            $string .= $characters[mt_rand(0, strlen($characters) - 1)];
        }

        return $string;
    }
}
