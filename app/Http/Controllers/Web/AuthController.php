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

        // dd($request->all());

        $user = User::create([
            'first_name' => $request->firstname,
            'last_name' => $request->lastname,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => $request->password,
            'role' => $request->role,
            'guardian_name' => $request->guardian_name,
            'guardian_phone' => $request->guardian_phone,
            'institute_name' => $request->institute_name
        ]);

        Auth::login($user);

        if (auth()->user()->role == 'candidate') {
            return redirect()->route('candidate.dashboard');
        }
        return redirect()->route('examiner.index');
    }
    public function login_view()
    {
        return view("auth.login");
    }
    public function login(LoginRequest $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if (auth()->user()->role == 'candidate') {
                return redirect()->route('candidate.dashboard');
            } else {
                return redirect()->route('examiner.index');
            }
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records'
        ])->onlyInput('email');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
