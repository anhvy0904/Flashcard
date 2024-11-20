<?php

namespace App\Http\Controllers;

use App\Models\SetCard;
use Illuminate\Http\Request;
use App\Models\Card;

class SetCardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('flashcard.setcard.set');
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

        // Xử lý hình ảnh nếu có
        if ($request->hasFile('setImage')) {
            $imagePath = $request->file('setImage')->store('set_images', 'public');
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

        return redirect()->route('setcards.index')->with('success', 'Set flashcard đã được thêm thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(SetCard $setCard)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SetCard $setCard)
    {
        //
    }
}
