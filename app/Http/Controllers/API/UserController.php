<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Http\Controllers\Controller;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use AuthenticatesUsers;

    public function index()
    {
        return User::all();
    }

    public function checkLogin(Request $request)
    {
        $postData = $this->validate($request, [
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
        $user = User::where('email', $postData['email'])->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'Invalid credentials']);
        }
        return response()->json([
            'success' => true,
            'user' => $user

        ]);
    }
    public function createUser(Request $request)
    {
        $user = new User;
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->dob = $request->dob;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return response()->json([
            'success' => "user created successfuly"
        ], 201);
    }
}
