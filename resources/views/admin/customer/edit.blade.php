@extends('admin.data')

@section('homebody')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Cập nhật người dùng</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('customer.update',$customer->id)}}" method="POST">
                @csrf @method('PUT')
                <!-- Username Input -->
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="form-control" value="{{$customer->username}}">
                    @error('username')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror

                </div>
                <!-- Email Input -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value = "{{$customer->email}}">
                    @error('email')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Cập nhật người dùng</button>
            </form>
        </div>
    </div>
</div>
@stop