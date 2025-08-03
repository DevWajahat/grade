<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register_view()
    {
        return view("auth.register");
    }
    public function register(RegisterRequest $request)
    {

        dd($request->all());

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role,
            'guardian_name' => $request->guardian_name,
            'guardian_phone' => $request->guardian_phone,
            'institute_name' => $request->institute_name
        ]);


        return redirect()->route("");
    }
    public function login_view()
    {
        return view("auth.login");
    }
    public function login(LoginRequest $request)
    {
        return redirect()->route("");
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
