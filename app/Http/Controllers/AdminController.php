<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use App\Models\SetCard;
use App\Models\User;
use App\Models\TestResult;
class AdminController extends Controller
{
    public function dashboard()
    {
        $totalSetCards = SetCard::count();
            $totalUsers = User::count();
            $totalTestResults = TestResult::count();
            $monthlyRegistrations = User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                ->groupBy('month')
                ->orderBy('month')
                ->pluck('count', 'month')
                ->toArray();
        return view('admin.dashboard.dashboard')->with(
            [
                'totalSetCards' => $totalSetCards,
                'totalUsers' => $totalUsers,
                'totalTestResults' => $totalTestResults,
                'monthlyRegistrations' => $monthlyRegistrations,
            ]
        );
    }

    public function login()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard')->with('error', 'Bạn đã đăng nhập. Vui lòng đăng xuất trước.');
        }
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
            ;

            return redirect()->route('admin.dashboard');
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