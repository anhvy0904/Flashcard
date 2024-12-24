@extends('admin.data')
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
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div class="card-title">Danh sách thông báo</div>
                <div class="ms-md-auto py-2 py-md-0">
                    <a href="{{ route('notifications.create') }}" class="btn btn-label-info btn-round">Tạo thông báo mới</a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tiêu đề</th>
                        <th scope="col">Người nhận</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Ngày gửi</th>
                        <th scope="col">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($notifications as $notification)
                        <tr>
                            <td>{{ $notification->id }}</td>
                            <td>{{ $notification->title }}</td>
                            <td>{{ $notification->user->username }}</td>
                            <td>
                                @if ($notification->is_read)
                                    <span class="badge bg-success">Đã đọc</span>
                                @else
                                    <span class="badge bg-warning">Chưa đọc</span>
                                @endif
                            </td>
                            <td>{{ $notification->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="{{ route('notifications.show', $notification->id) }}" class="btn btn-info btn-sm">Xem</a>
                                <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <hr />
            {{ $notifications->links() }}
        </div>
    </div>
@stop()
