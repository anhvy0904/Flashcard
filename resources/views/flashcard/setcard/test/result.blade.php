@extends('flashcard.data')

@section('homebody')
<div class="container">
    <div class="card-header">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div class="card-title">Kết quả bài kiểm tra</div>
        </div>
    </div>

    <!-- Thông tin bài kiểm tra -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Bài kiểm tra: {{ $test->id }}</h5>
            <p>Thời gian thực hiện: {{ $test->created_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <!-- Điểm và tổng quan -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Kết quả</h5>
            @if(!is_null($test->testresults))
                @php
                    $result = $test->testresults->first();
                @endphp
                <p>Người dùng: {{ $result->user->username }}</p>
                <p>Điểm: {{ $result->score }} / 100</p>
            @else
                <p>Chưa có kết quả cho bài kiểm tra này.</p>
            @endif
        </div>
    </div>

    <!-- Chi tiết câu hỏi -->
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Chi tiết câu hỏi</h5>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Câu hỏi</th>
                        <th>Đáp án của bạn</th>
                        <th>Kết quả</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($test->testdetails as $detail)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $detail->card->question }}</td>
                            <td>{{ $detail->user_answer ?: 'Chưa trả lời' }}</td>
                            <td>
                                @if($detail->user_answer === $detail->card->answer)
                                    <span class="badge bg-success">Đúng</span>
                                @else
                                    <span class="badge bg-danger">Sai</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
