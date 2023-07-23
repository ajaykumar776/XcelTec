@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-2"></div>
    <div class="col-md-8" style="margin-top: 100px;">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">{{ $title }} Form</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('usersave') }}">
                    @csrf
                    <div class="row">
                        <input type="text" name="user_id" hidden value="{{$data['id'] ?? ''}}">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" id="name" class="form-control" name="name" value="{{ old('name', $data['name'] ?? '') }}">
                                @error('name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $data['email'] ?? '') }}">
                                @error('email')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>


                        </div>
                        <div class="col-md-6">

                            <div class="mb-3">
                                <label for="contact" class="form-label">Contact</label>
                                <input type="contact" id="contact" name="phone" class="form-control" value="{{ old('phone', $data['phone'] ?? '') }}">
                                @error('phone')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            @if($col_pass)
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="text" id="password" class="form-control" name="password" value="{{ old('password', $data['password'] ?? '') }}">
                                @error('password')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            @endif
                            <div class="mb-3">
                                <label>User Type:</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="userTypeUser" name="user_type" value="User" {{ (old('user_type', $data['user_type'] ?? '') === 'User') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="userTypeUser">User</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="userTypeAdmin" name="user_type" value="Admin" {{ (old('user_type', $data['user_type'] ?? '') === 'Admin') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="userTypeAdmin">Admin</label>
                                </div>
                            </div>
                            @error('user_type')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">{{$title}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection