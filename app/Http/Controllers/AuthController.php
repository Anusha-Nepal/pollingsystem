<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\VerifyEmailMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|min:6',
        ]);
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);
        $token  = Str::random(32);

      
        $user->verifyemail()->create([
            'user_id'=>$user->id,
            'token' => $token,
        ]);
        
        Mail::to($user->email)->send(new VerifyEmailMail($user, $token));
       return redirect()->back()->with('message', 'Successfully Registered');

        // $adminRole = Roles::where('name', 'admin')->first();

        // if ($adminRole) {
        //     $user->roles()->sync([$adminRole->id]);
        //     // You can also sync multiple roles if needed
        //     // $user->roles()->sync([$adminRole->id, $otherRole->id]);
        // }

     
   
}

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Check the user's role and redirect accordingly
            if (Auth::check()) {
                $user = Auth::user();

                if ($user->hasRole('admin')) {
                    return redirect()->route('admin.dashboard');
                } else {
                    return redirect()->route('dashboard');
                }
            }
        }

        return redirect()->route('login')->with('error', 'Invalid credentials');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
