<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard.dashboard');
    }

    public function login()
    {
        return view('admin.login');
    }

    public function post_login(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string|min:6',
        ]);
        $loginType = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $data = [
            $loginType => $request->input('login'),
            'password' => $request->input('password'),
        ];

        $remember = $request->filled('remember');
        if (Auth::guard('admin')->attempt($data, $remember))
        {
            $request->session()->regenerate();
            return redirect()->intended('admin/dashboard');
        } else {
            return back();
        }
    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

}