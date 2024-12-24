@extends('flashcard.data')

@section('search')
    <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
        <form action="{{ route('history.test') }}" method="GET">
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
                <div class="card-title">Lịch sử làm bài</div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tên bài kiểm tra</th>
                        <th scope="col">Ngày làm bài</th>
                        <th scope="col">Chi tiết</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tests as $testResult)
                        <tr>
                            <td>{{ $testResult->id }}</td>
                            <td>{{ $testResult->test->setcard->title }}</td>
                            <td>{{ $testResult->created_at->timezone("Asia/Ho_Chi_Minh")->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="{{ route('result.test', $testResult->id) }}" class="btn btn-primary btn-sm">Xem chi tiết</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <hr />
            {{ $tests->links() }}
        </div>
    </div>
@stop()