@extends('admin.data')
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

        .position-relative {
            position: relative;
        }

        .position-absolute {
            position: absolute;
        }

        .top-0 {
            top: 0;
        }

        .end-0 {
            right: 0;
        }

        .m-2 {
            margin: 0.5rem;
        }

        .btn-outline-custom {

            border-color: black;
        }
    </style>
@stop()
@section('homebody')

    <body>
        <div class="container py-5">
            <h1 class="text-center mb-4">Danh sách FlashCard của {{$user->username}}</h1>

            <!-- Danh sách Set -->
            <div id="setList" class="row g-4">
                @forelse ($setCards as $setCard)
                    <div class="col-md-4">
                        <div class="card set-card">
                            <img src="{{ asset('storage/' . $setCard->image) }}" class="card-img-top"
                                alt="{{ $setCard->title }}">
                            <div class="card-body">
                                <h5 class="card-title text-center">{{ $setCard->title }}</h5>
                                <p class="card-text">{{ $setCard->description }}</p>
                                <a href="{{ route('customer.setCardDetail', [$user->id , $setCard->id]) }}" class="btn btn-primary">Xem chi tiết</a>
                            </div>
                            <form action="{{ route('setcard.destroy', $setCard->id) }}" method="POST" onsubmit="return confirmDelete()" class="position-absolute top-0 end-0 m-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-custom btn-sm">X</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="no-set">Chưa có set flashcard nào.</p>
                    </div>
                @endforelse
            </div>

            <script>
                function confirmDelete() {
                    return confirm('Bạn có chắc chắn muốn xóa không?');
                }
            </script>
        </div>
    </body>
@stop()
