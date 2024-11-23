@extends('flashcard.data')
@section('css')
    <style>
        /* Thiết kế Set Flashcard */
        .set-card {
            border: 1px solid #ccc;
            border-radius: 8px;
            overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .set-card:hover {
            transform: scale(1.02);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .set-card img {
            height: 150px;
            object-fit: cover;
        }

        .set-card .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }

        .no-set {
            color: #888;
            text-align: center;
            font-size: 1.2rem;
            margin-top: 2rem;
        }
    </style>
@stop()
@section('homebody')

    <body>
        <div class="container py-5">
            <h1 class="text-center mb-4">Danh sách FlashCard của bạn</h1>

            <!-- Nút tạo mới -->
            <div class="text-center mb-4">
                <a href="{{route('setcard.create')}}" class="btn btn-primary rounded">+ Tạo</a>
            </div>
            <!-- Danh sách Set -->
            <div id="setList" class="row g-4">
                @forelse ($setCards as $setCard)
                <div class="col-md-4">
                    <div class="card set-card">
                        <img src="{{ asset('storage/' . $setCard->image) }}" class="card-img-top" alt="{{ $setCard->title }}">
                        <div class="card-body">
                            <h5 class="card-title text-center">{{ $setCard->title }}</h5>
                            <p class="card-text">{{ $setCard->description }}</p>
                            <a href="{{ route('setcard.show', $setCard->id) }}" class="btn btn-primary">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="no-set">Chưa có set flashcard nào.</p>
                </div>
            @endforelse
            </div>
        </div>
    </body>
@stop()
