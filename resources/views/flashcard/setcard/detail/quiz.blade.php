@extends('flashcard.data')

@section('css')
    <style>
        /* Custom CSS */
        .quiz-container {
            display: flex;
            justify-content: space-between;
            gap: 30px;
        }
        .question-card {
            flex: 0 0 70%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 8px;
        }
        .quiz-sidebar {
            flex: 0 0 28%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 8px;
        }
        .quiz-sidebar h5 {
            margin-bottom: 15px;
        }
        .question-btn {
            margin-bottom: 10px;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
        }
        .question-btn:hover {
            background-color: #0056b3;
        }
        .progress-bar {
            height: 20px;
        }
    </style>
@stop

@section('homebody')
    <body class="bg-light">
        <main class="container py-5">
            <div class="quiz-container">
                <!-- Main Quiz Section -->
                <div class="question-card">
                    <div class="progress-container mb-4">
                        <h5>Study Progress</h5>
                        <div class="progress">
                            <div id="progress-bar" class="progress-bar bg-primary" style="width: 0%"></div>
                        </div>
                    </div>
                    <!-- Display Question and Answer Choices -->
                    @if($setcard->cards->count() > 0)
                        <div class="card shadow-sm mb-4">
                            <div class="card-body">
                                {{-- <h5 class="card-title">Question: {{ $cards->questions->first()->cards->question }}</h5>
                                
                                <form method="POST" action="{{ route('quiz.check', $setcard->id) }}">
                                    @csrf
                                    @foreach($questions as $question)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="answer" id="answer{{ $loop->index }}" value="{{ $question->answer }}">
                                            <label class="form-check-label" for="answer{{ $loop->index }}">
                                                {{ $question->answer }}
                                            </label>
                                        </div>
                                    @endforeach

                                    <button type="submit" class="question-btn mt-3">Submit Answer</button>
                                </form> --}}
                            </div>
                        </div>
                    @else
                        <p class="text-muted">Not enough questions available for this set. Please add more questions.</p>
                    @endif
                </div>

                <!-- Sidebar Section -->
                <div class="quiz-sidebar">
                    <h5>Chế độ học</h5>
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                            <span class="badge bg-primary rounded-circle me-3">F</span> Chế độ lật thẻ
                        </a>
                        <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                            <span class="badge bg-secondary rounded-circle me-3">Q</span> Chế độ trắc nghiệm
                        </a>
                    </div>
                </div>
            </div>
        </main>
    </body>
@stop
