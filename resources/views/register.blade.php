@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-4"></div>
    <!-- admin_form.blade.php -->

    <div class="col-4">
        <div class="register">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" class="form-control" value="<?php  ?>">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="admin@example.com">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" class="form-control" value="123456">
            </div>

            <select class="form-control mb-3">
                <option>Select userType</option>
                <option value="Admin">Admin</option>
                <option value="User">User</option>
            </select>

            <div class="mb-0">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>

</div>
@endsection