<?php

namespace App\Http\Controllers;

use App\Models\SetCard;
use Illuminate\Http\Request;
use App\Models\Card;
use Illuminate\Support\Facades\Log;

class SetCardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setCards = SetCard::where('user_id', auth('web')->id())->get();
        return view('flashcard.setcard.set',compact('setCards'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('flashcard.setcard.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'setTitle' => 'required|string|max:255',
            'setDescription' => 'nullable|string',
            'setImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'questions.*.question' => 'required|string',
            'questions.*.answer' => 'required|string',
        ]);

        // Lưu set flashcard
        $setCard = new SetCard();
        $setCard->title = $request->input('setTitle');
        $setCard->description = $request->input('setDescription');
        $setCard->user_id = auth('web')->id();
        $setCard->save();
        // Xử lý hình ảnh nếu có
        // if ($request->hasFile('setImage')) {
        //     $imagePath = $request->file('setImage')->store('images', 'public');
        //     $setCard->image = $imagePath;
        // }
        if ($request->hasFile('setImage')) {
            $data = $request->file('setImage');
            $imageName = $setCard->id . "_" .  str_replace(' ', '', $setCard->title) . '.' . $data->getClientOriginalExtension();
            $imagePath = $data->storeAs('images', $imageName,'public');
            $setCard->image = $imagePath;
        }

        

        $setCard->save();

        // Lưu các câu hỏi
        foreach ($request->input('questions') as $questionData) {
            $card = new Card();
            $card->question = $questionData['question'];
            $card->answer = $questionData['answer'];
            $card->set_card_id = $setCard->id;
            $card->save();
        }

        return redirect()->route('setcard.index')->with('success', 'Set flashcard đã được thêm thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(SetCard $setCard)
    {
        $setCard->load('cards');
        return view('flashcard.setcard.detail', compact('setCard'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SetCard $setCard)
    {
        $questions = $setCard->cards; // Lấy các câu hỏi liên quan đến set flashcard
        return view('flashcard.edit', compact('setCard', 'questions'));
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SetCard $setCard)
    {
          // Xác thực dữ liệu từ form
    $request->validate([
        'setTitle' => 'required|string|max:255',
        'setDescription' => 'nullable|string',
        'setImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'questions.*.question' => 'required|string',
        'questions.*.answer' => 'required|string',
    ]);

    // Cập nhật set flashcard
    $setCard->title = $request->input('setTitle');
    $setCard->description = $request->input('setDescription');

    // Xử lý hình ảnh nếu có
    if ($request->hasFile('setImage')) {
        $file = $request->file('setImage');
        $imageName = $setCard->id . "_" .  $setCard->title . '_' . $file->getClientOriginalExtension();
        $imagePath = $file->storeAs('images', $imageName,'public');
        $setCard->image = $imagePath;
    }

    $setCard->save();

    // Xóa các câu hỏi cũ
    $setCard->cards()->delete();

    // Lưu các câu hỏi mới
    foreach ($request->input('questions') as $questionData) {
        $card = new Card();
        $card->question = $questionData['question'];
        $card->answer = $questionData['answer'];
        $card->set_card_id = $setCard->id;
        $card->save();
    }

    return redirect()->route('setcard.index')->with('success', 'Set flashcard đã được cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SetCard $setCard)
    {
        $setCard->cards()->delete();

        // Xóa set flashcard
        $setCard->delete();
    
        return redirect()->route('setcard.index')->with('success', 'Set flashcard đã được xóa thành công!');
    
    }
}
