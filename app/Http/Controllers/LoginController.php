<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class LoginController extends Controller
{
    public function index()
    {
        return view('login.index', [
            'title' => 'Login',
        ]);
    }

    // public function authenticate(Request $request)
    // {
    //     $credentials = $request->validate([
    //         'username' => 'required',
    //         'password' => 'required',
    //     ]);

    //     if (Auth::attempt($credentials)) {
    //         $request->session()->regenerate();
    //         return redirect()
    //             ->intended('/dashboard')
    //             ->with('success', 'Welcome ' . auth()->user()->name);
    //     }

    //     return back()->with('loginError', 'Login failed');
    // }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username', $credentials['username'])->first();

        if (!$user) {
            return back()->with('loginError', 'Login failed');
        }

        if ($user->status == 3) {
            return back()->with('loginError', 'Your account has been inactive');
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()
                ->intended('/dashboard')
                ->with('success', 'Welcome ' . auth()->user()->name);
        }

        return back()->with('loginError', 'Login failed');
    }

    public function logout()
    {
        Auth::logout();

        request()
            ->session()
            ->invalidate();

        request()
            ->session()
            ->regenerateToken();

        return redirect('/');
    }
}
