@extends('admin.data')
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
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div class="card-title">Người dùng</div>
                <div class="ms-md-auto py-2 py-md-0">
                    <a href="{{ route('customer.create') }}" class="btn btn-label-info btn-round ">Thêm người dùng</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">username</th>
                            <th scope="col">email</th>
                            <th scope="col">ngày tham gia</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->username }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <a href="{{ route('customer.edit', $item->id) }}"class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('customer.destroy', $item->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <hr />
                {{ $users->links() }}
            </div>
        </div>
    @stop()
