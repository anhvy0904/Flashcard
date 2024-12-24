@extends('flashcard.data')
@section('css')
<style>
    .card {
        height: 90%;
        display: flex;
        flex-direction: column;
    }

    .card-title {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        font-size: 1.25rem;
        font-weight: bold;
    }

    .card-text {
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        flex-grow: 1;
    }

    .card-img-top {
        height: 180px;
        object-fit: cover;
    }
    .data{
        margin-top: auto;
    }
</style>
@stop()
@section('search')
    <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
        <form action="{{ route('customer.index') }}" method="GET">
        <div class="input-group">
            <div class="input-group-prepend">
                <button type="submit" class="btn btn-search pe-1">
                    <i class="fa fa-search search-icon"></i>
                </button>
            </div>
            <input type="text" placeholder="Tìm kiếm ..." class="form-control" name='search' />
        </div>
        </form>
    </nav>
@stop()
@section('homebody')
<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Gần đây</h3>
        </div>
    </div>
    <div class="row">
        @foreach ($recentCards as $card)
            <div class="col-sm-6 col-md-4">
                <div class="card">
                    <img src="{{ asset('storage/' . $card->image) }}" class="card-img-top" alt="{{ $card->title }}">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $card->title }}</h5>
                        <p class="card-text">{{ $card->description }}</p>
                        <a href="{{ route('setcard.show', $card->id) }}" class="btn btn-primary">Xem chi tiết</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Nổi bật</h3>
        </div>
    </div>
    <div class="row">
        @foreach ($featuredCards as $card)
            <div class="col-sm-6 col-md-4">
                <div class="card">
                    <img src="{{ asset('storage/' . $card->image) }}" class="card-img-top" alt="{{ $card->title }}">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $card->title }}</h5>
                        <p class="card-text">{{ $card->description }}</p>
                        <a href="{{ route('setcard.show', $card->id) }}" class="btn btn-primary">Xem chi tiết</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>  
@stop()