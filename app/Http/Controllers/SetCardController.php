<?php

namespace App\Http\Controllers;

use App\Models\SetCard;
use Illuminate\Http\Request;
use App\Models\Card;
use Illuminate\Support\Facades\Log;
use App\Models\Comment;
use App\Models\Test;
use App\Models\TestDetail;
use App\Models\TestResult;

class SetCardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setCards = SetCard::where('user_id', auth('web')->id())->get();
        return view('flashcard.setcard.set', compact('setCards'));
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

        if ($request->hasFile('setImage')) {
            $data = $request->file('setImage');
            $imageName = $setCard->id . "_" . str_replace(' ', '', $setCard->title) . '.' . $data->getClientOriginalExtension();
            $imagePath = $data->storeAs('images', $imageName, 'public');
            $setCard->image = $imagePath;
        }



        $setCard->save();

        // Lưu các câu hỏi
        foreach ($request->input('questions') as $questionData) {
            $card = new Card();
            $card->question = $questionData['question'];
            $card->answer = $questionData['answer'];
            $card->setcard_id = $setCard->id;
            $card->save();
        }

        return redirect()->route('setcard.index')->with('success', 'Set flashcard đã được thêm thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(SetCard $setcard)
    {
        $setcard->load(['cards']);
        $comments = Comment::with('user')
            ->where('setcard_id', $setcard->id)
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        $checkmode = request('checkmode');
        if ($checkmode == 'quiz') {
            return view('flashcard.setcard.detail.quiz', compact('setcard', 'comments'));
        } else {
            return view('flashcard.setcard.detail.flip', compact('setcard', 'comments'));
        }
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
            $imageName = $setCard->id . "_" . $setCard->title . '_' . $file->getClientOriginalExtension();
            $imagePath = $file->storeAs('images', $imageName, 'public');
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
            $card->setcard_id = $setCard->id;
            $card->save();
        }

        return redirect()->route('setcard.index')->with('success', 'Set flashcard đã được cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $setcard = SetCard::find($id);

        if (!$setcard) {
            return redirect()->route('setcard.index')->with('error', 'SetCard không tồn tại.');
        }

        // Xóa tất cả các card liên quan
        $setcard->cards()->delete();

        // Xóa setcard  
        $setcard->delete();

        return redirect()->route('setcard.index')->with('success', 'SetCard đã được xóa thành công.');
    }
    public function comment(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string|min:5',
        ]);

        $comment = new Comment();
        $comment->content = $request->input('comment');
        $comment->user_id = auth('web')->id();
        $comment->setcard_id = $id;
        $comment->save();

        return redirect()->back()->with('success', 'Bình luận của bạn đã được gửi thành công!');
    }
    public function submitTest(Request $request, $setcardId)
    {
        // Lấy thông tin từ request
        $setCard = SetCard::findOrFail($setcardId);
        $userAnswers = json_decode($request->input('userAnswers'), true);
        $correctAnswers = $request->input('correctAnswers');
        $cards = $setCard->cards;
        $totalquestions = count($cards);
        $setCard->increment('views');
        // Tạo bài kiểm tra
        $test = Test::create(attributes: [
            'setcard_id' => $setcardId,
            'created_at' => now(),
        ]);

        // Lưu chi tiết bài kiểm tra
        $index = 0;
        foreach ($cards as $card) {
            $userAnswer = $userAnswers[$index] ?? ''; // Nếu không có câu trả lời, đặt rỗng
            TestDetail::create([
                'test_id' => $test->id,
                'card_id' => $card->id,
                'user_answer' => $userAnswer,
                'correct_answer' => $card->answer,
            ]);
            $index++;
        }

        // Tính điểm
        $score = ($correctAnswers / $totalquestions) * 100;

        // Lưu kết quả bài kiểm tra
        TestResult::create([
            'test_id' => $test->id,
            'user_id' => auth('web')->id(),
            'score' => $score,
        ]);

        // Trả về kết quả
        return redirect()->route('result.test', ['test' => $test->id]);
    }
    public function showResultTest(Test $test)
    {
        $test->load(['testdetails', 'testresults']);

        return view('flashcard.setcard.test.result', compact('test'));

    }
    public function history()
    {
        
        $tests = auth('web')->user()->testResults()->with(['test.testdetails'])->latest()->paginate(10);
        return view('flashcard.setcard.test.history', compact('tests'));
    }
}
