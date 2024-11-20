@extends('admin.data')

@section('homebody')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Thêm người dùng</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('customer.store') }}" method="POST">
                @csrf
                <!-- Username Input -->
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="form-control">
                    @error('username')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror

                </div>
                <!-- Email Input -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control">
                    @error('email')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Password Input -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                    @error('password')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Confirm Password Input -->
                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control">
                    @error('confirm_password')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Thêm người dùng</button>
            </form>
        </div>
    </div>
</div>
@stop