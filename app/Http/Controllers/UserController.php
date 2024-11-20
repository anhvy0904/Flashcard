<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\SetCard;
use App\Models\Card;

class UserController extends Controller
{
    public function register()
    {
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
        return redirect()->route('flashcard.dashboard')->with('success', 'Đăng ký thành công!');
    }
    public function login()
    {
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
            return redirect()->intended('flashcard/dashboard');
        } else {
            return back();
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('flashcard.login');
    }
    public function dashboard()
    {
        return view('flashcard.dashboard');
    }
    public function addcard()
    {
        return view('flashcard.add');
    }
    public function setcard()
    {
        return view('flashcard.setcard.set');
    }
    public function post_addcard(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);
        $setcard = new SetCard();
        $setcard->title = $request->input('title');
        $setcard->description = $request->input('description');
        $setcard->user_id = Auth::id();
        $setcard->image = $request->input('image');
        $setcard->save();
        $card = new Card();
        $card->question = $request->input('question');
        $card->answer = $request->input('answer');
        $card->image = $request->input('image');
        $card->set_card_id = $setcard->id;
        $card->user_id = Auth::id();
        $card->save();
        return redirect()->route('flashcard.dashboard')->with('success', 'Flashcard đã được thêm thành công!');
    }
    // public function editcard($id)
    // {
    //     $card = Card::find($id);
    //     return view('flashcard.edit', compact('card'));
    // }
    // public function post_editcard(Request $request, $id)
    // {
    //     $request->validate([
    //         'question' => 'required',
    //         'answer' => 'required',
    //     ]);
    //     $card = Card::find($id);
    //     $card->question = $request->input('question');
    //     $card->answer = $request->input('answer');
    //     $card->image = $request->input('image');
    //     $card->save();
    //     return redirect()->route('flashcard.dashboard')->with('success', 'Flashcard đã được cập nhật thành công!');
    // }
    // public function deletecard($id)
    // {
    //     $card = Card::find($id);
    //     $card->delete();
    //     return redirect()->route('flashcard.dashboard')->with('success', 'Flashcard đã được xóa thành công!');
    // }
    public function deletesetcard($id)
    {
        $setcard = SetCard::find($id);
        $setcard->delete();
        return redirect()->route('flashcard.dashboard')->with('success', 'Setcard đã được xóa thành công!');
    }
    public function detail()
    {
        return view('flashcard.detailcard');
    }
}
