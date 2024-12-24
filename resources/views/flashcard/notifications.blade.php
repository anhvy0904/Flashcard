@extends('flashcard.data')

@section('search')
<nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
    <form action="{{ route('notifications.index') }}" method="GET">
        <div class="input-group">
            <div class="input-group-prepend">
                <button type="submit" class="btn btn-search pe-1">
                    <i class="fa fa-search search-icon"></i>
                </button>
            </div>
            <input type="text" placeholder="Tìm kiếm thông báo..." class="form-control" name='search' />
        </div>
    </form>
</nav>
@stop()

@section('homebody')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Notifications') }}</div>

                <div class="card-body">
                    @if ($notifications->isEmpty())
                        <p>{{ __('You have no notifications.') }}</p>
                    @else
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tiêu đề</th>
                                <th scope="col">Nội dung</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Ngày gửi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($notifications as $notification)
                                <tr>
                                    <td>{{ $notification->id }}</td>
                                    <td>{{ $notification->title }}</td>
                                    <td>{{ $notification->content }}</td>
                                    <td>
                                        @if ($notification->is_read)
                                            <span class="badge bg-success">Đã đọc</span>
                                        @else
                                            <span class="badge bg-warning">Chưa đọc</span>
                                        @endif
                                    </td>
                                    <td>{{ $notification->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@stop()

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@stop()