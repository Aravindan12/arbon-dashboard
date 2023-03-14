<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{


     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
    }
    
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function dashBoard()
    {
        return view('welcome');
    }

    public function registerUser(Request $request)
    {
        $user = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        $user['password'] = Hash::make($user['password']);
        $user = User::create($user);
        Auth::login($user);
        return redirect('dashboard')->with('success', 'Register Successfully');
    }

    public function loginUser(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect('dashboard')->with('success', 'Login Successfully');
        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('login');
    }

    public function showAdminLoginForm()
    {
        return view('auth.login', ['url' => route('admin.login-view'), 'title'=>'Admin']);
    }

    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('admin')->attempt($request->only(['email','password']), $request->get('remember'))){
            return redirect()->intended('/admin/dashboard');
        }

        return back()->withInput($request->only('email', 'remember'));
    }
}
