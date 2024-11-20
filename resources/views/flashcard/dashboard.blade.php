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
        <div class="ms-md-auto py-2 py-md-0">
            <a href="#" class="btn btn-label-info btn-round me-2">Manage</a>
            <a href="#" class="btn btn-primary btn-round">Thêm thẻ</a>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-4">
            <div class="card">
                <img src="https://via.placeholder.com/300x180" class="card-img-top" alt="Course Image">
                <div class="card-body  text-center">
                    <h5 class="card-title">Học lập trình Web Frontend với HTML, CSS, và JavaScript</h5>
                    <p class="card-text">
                        Đây là khóa học giúp bạn nắm vững kiến thức cơ bản về phát triển giao diện web, từ cấu trúc HTML, CSS cho tới JavaScript hiện đại.
                    </p>
                    <a href="#" class="btn btn-primary data">Xem chi tiết</a>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="card">
                <img src="https://via.placeholder.com/300x180" class="card-img-top" alt="Course Image">
                <div class="card-body text-center">
                    <h5 class="card-title">Học lập trình Web Frontend với HTML, CSS, và JavaScript</h5>
                    <p class="card-text">
                        ới JavaScript hiện đại.
                    </p>
                    <a href="#" class="btn btn-primary data">Xem chi tiết</a>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="card">
                <img src="https://via.placeholder.com/300x180" class="card-img-top" alt="Course Image">
                <div class="card-body text-center">
                    <h5 class="card-title">Học lập trình Web Frontend với HTML, CSS, và JavaScript</h5>
                    <p class="card-text">
                        về phát triển giao diện web, từ cấu trúc HTML, CSS cho tới JavaScript hiện đại.
                    </p>
                    <a href="#" class="btn btn-primary data">Xem chi tiết</a>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Nổi bật</h3>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="#" class="btn btn-label-info btn-round me-2">Manage</a>
            <a href="#" class="btn btn-primary btn-round">Thêm thẻ</a>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-4">
            <div class="card">
                <img src="https://via.placeholder.com/300x180" class="card-img-top" alt="Course Image">
                <div class="card-body  text-center">
                    <h5 class="card-title">Học lập trình Web Frontend với HTML, CSS, và JavaScript</h5>
                    <p class="card-text">
                        Đây là khóa học giúp bạn nắm vững kiến thức cơ bản về phát triển giao diện web, từ cấu trúc HTML, CSS cho tới JavaScript hiện đại.
                    </p>
                    <a href="#" class="btn btn-primary data">Xem chi tiết</a>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="card">
                <img src="https://via.placeholder.com/300x180" class="card-img-top" alt="Course Image">
                <div class="card-body text-center">
                    <h5 class="card-title">Học lập trình Web Frontend với HTML, CSS, và JavaScript</h5>
                    <p class="card-text">
                        ới JavaScript hiện đại.
                    </p>
                    <a href="#" class="btn btn-primary data">Xem chi tiết</a>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="card">
                <img src="https://via.placeholder.com/300x180" class="card-img-top" alt="Course Image">
                <div class="card-body text-center">
                    <h5 class="card-title">Học lập trình Web Frontend với HTML, CSS, và JavaScript</h5>
                    <p class="card-text">
                        về phát triển giao diện web, từ cấu trúc HTML, CSS cho tới JavaScript hiện đại.
                    </p>
                    <a href="#" class="btn btn-primary data">Xem chi tiết</a>
                </div>
            </div>
        </div>
    </div>
</div>  
@stop()