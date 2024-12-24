@extends('admin.data')

@section('homebody')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Gửi Thông Báo</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('notifications.store') }}" method="POST">
                @csrf
                <!-- Notification Title -->
                <div class="form-group">
                    <label for="title">Tiêu đề</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Nhập tiêu đề thông báo">
                    @error('title')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Notification Content -->
                <div class="form-group mt-3">
                    <label for="content">Nội dung</label>
                    <textarea name="content" id="content" class="form-control" rows="5" placeholder="Nhập nội dung thông báo"></textarea>
                    @error('content')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Recipient Selection -->
                <div class="form-group mt-3">
                    <label for="recipient">Người nhận</label>
                    <select name="recipient" id="recipient" class="form-control">
                        @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->username }} - {{ $user->email }}</option>
                        @endforeach
                    </select>
                    @error('recipient')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary mt-4">Gửi Thông Báo</button>
            </form>
        </div>
    </div>
</div>
<script>
    tinymce.init({
        selector: '#content',
        entity_encoding: 'raw',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
        plugins: 'lists link image code table',
        toolbar: 'undo redo | bold italic underline | alignleft aligncenter alignright | bullist numlist outdent indent | link image',
        menubar: false,
        branding: false,
    });
</script>

@stop
