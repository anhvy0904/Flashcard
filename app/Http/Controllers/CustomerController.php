<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Comment;
class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('username', 'LIKE', "%{$search}%")
            ->orWhere('email', 'LIKE', "%{$search}%")->orWhere('id', 'LIKE', "%{$search}%")->orWhereRaw("DATE_FORMAT(created_at, '%d/%m/%Y') LIKE ?", ["%{$search}%"]);
        }
    
        $users = $query->orderBy('id', 'desc')->paginate(10);
    
        return view('admin.customer.customer', compact('users'));}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'username' => 'required|unique:users|min:6',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'confirm_password' => 'required|same:password',
        ];
        $mess = [
            'username.required' => 'Username không được để trống',
            'username.unique' => 'Username của bạn đã tồn tại',
            'username.min' => 'Username phải có ít nhất 6 ký tự',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không hợp lệ',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Password không được để trống',
            'password.min' => 'Password phải có ít nhất 6 ký tự',
            'confirm_password.required' => 'Hãy xác nhận mật khẩu',
            'confirm_password.same' => 'Mật khẩu không khớp',
        ];
        $request->validate($rules,$mess);
        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = $request->password; // Mã hóa mật khẩu
        $user->save();
        return redirect()->route('customer.index')->with('success', 'Người dùng đã được thêm thành công');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(User $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $customer)

    {
        return view('admin.customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $customer)
    {
        $rules = [
            'username' => 'required|min:6|unique:users,username,' . $customer->id,
            'email' => 'required|email|unique:users,email,' . $customer->id,
        ];
        $messages = [
            'username.required' => 'Username không được để trống',
            'username.unique' => 'Username của bạn đã tồn tại',
            'username.min' => 'Username phải có ít nhất 6 ký tự',
            'email.required' => 'Hãy điền email của bạn',
            'email.email' => 'Email không hợp lệ',
            'email.unique' => 'Email đã tồn tại',
        ];
        $request->validate($rules, $messages);
    
        $customer->username = $request->username;
        $customer->email = $request->email;
        $customer->save();
    
        return redirect()->route('customer.index')->with('success', 'Người dùng đã được cập nhật thành công');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $customer)
    {
        $customer->delete();
        return redirect()->route('customer.index')->with('success', 'Người dùng đã được xóa thành công');
    }
    public function userListSetCard($id){
        $user = User::findOrFail($id);
        $setCards = $user->setcards()->latest()->get();

        // Trả về view hiển thị danh sách bộ thẻ
        return view('admin.customer.set', compact('user', 'setCards'));
    }
    public function userListSetCardDetail($id, $setcard){
        $user = User::findOrFail($id);
        $setcard = $user->setcards()->findOrFail($setcard);
        $cards = $setcard->cards;
        $comments = Comment::with('user')
        ->where('setcard_id', $setcard->id)
        ->orderBy('created_at', 'desc')
        ->paginate(5);

        return view('admin.customer.flip', compact('user', 'setcard', 'cards','comments'));
    }
}
