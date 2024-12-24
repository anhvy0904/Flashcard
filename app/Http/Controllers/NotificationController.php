<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\UserNotification;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notifications = Notification::where('admin_id', auth('admin')->id())->latest()->paginate(10);
        return view('admin.notifications.index', compact('notifications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('admin.notifications.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'recipient' => 'required|int',
        ]);

        $adminId = auth('admin')->id();


        $user = User::find($request->recipient);

        // Lưu thông báo vào DB
        $notification = Notification::create([
            'user_id' => $user->id,
            'admin_id' => $adminId,
            'title' => $request->title,
            'content' => $request->content,
        ]);

        // Gửi email thông báo
        $user->notify(new UserNotification($request->title, $request->content));


        return redirect()->route('admin.notifications.index')->with('success', 'Thông báo đã được gửi!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Notification $notification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notification $notification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Notification $notification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notification $notification)
    {
        //
    }
    public function userIndex()
    {
        $notifications = Notification::where('user_id', auth('web')->id())->latest()->paginate(10);
        return view('flashcard.notifications', compact('notifications'));
    }

    // Đánh dấu đã đọc
    public function markAsRead($id)
    {
        $notification = Notification::findOrFail($id);

        if ($notification->user_id == auth('web')->id()) {
            $notification->update(['is_read' => true]);
        }

        return redirect()->back();
    }
}
