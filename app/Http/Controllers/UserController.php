<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\SetCard;
use App\Models\Card;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function register()
    {
        if (Auth::guard('web')->check()) {
            return redirect()->route('dashboard')->with('error', 'Bạn đã đăng nhập. Vui lòng đăng xuất trước.');
        }
        return view('flashcard.register');
    }
    public function post_register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users|min:6',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'confirm_password' => 'required|same:password',
        ]);
        $user = new User();
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password= $request->input('password');
        $user->save();
        Auth::login($user);
        return redirect()->route('dashboard')->with('success', 'Đăng ký thành công!');
    }
    public function login()
    {
        if (Auth::guard('web')->check()) {
            return redirect()->route('dashboard')->with('error', 'Bạn đã đăng nhập. Vui lòng đăng xuất trước.');
        }
        return view('flashcard.login');
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
        if (auth('web')->attempt($data, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        } else {
            return back()->with('error', 'Tài khoản hoặc mật khẩu không đúng!');
        }
    }
    public function logout()
    {   
        Auth::logout();
        return redirect()->route('login');
    }
    public function dashboard()
    {
        $recentCards = SetCard::orderBy('created_at', 'desc')->take(3)->get();
        $featuredCards = SetCard::orderBy('views', 'desc')->take(3)->get();

        return view('flashcard.dashboard',compact('recentCards', 'featuredCards'));
    }
    public function ForgotPassword()
    {
        return view('flashcard.password.index');
    }
    public function sendMail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        // Gửi mã số về email của người dùng
        $token = Password::getRepository()->createNewToken();
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => now(),
        ]);

        Mail::send('flashcard.password.password', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Password Reset Code');
        });

        return response()->json(['success' => 'Reset code sent to your email.']);
    }
    
    public function resetPassword( Request $request)
    {
        $token = $request->verification_code;
        $passwordReset = DB::table('password_resets')->where('token', $token)->first();

        if (!$passwordReset) {
            return redirect()->route('user.forgotPassword')->with('error', 'Token không hợp lệ hoặc đã hết hạn!');
        }

        return view('flashcard.password.reset', ['token' => $token, 'email' => $passwordReset->email]);
    
    }
    public function updatePassword(Request $request)
    {   
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
            'password_confirmation' => 'required|same:password',
        ]);
        $passwordReset = DB::table('password_resets')->where('email', $request->email)->first();
        if (!$passwordReset) {
            return redirect()->route('user.forgotPassword')->with('error', 'Token không hợp lệ hoặc đã hết hạn!');
        }

        $user = User::where('email', $request->email)->first();
        $user->password = $request->password;
        $user->save();

        DB::table('password_resets')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('success', 'Mật khẩu đã được cập nhật!');
    }
}
