@extends('layouts.main')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card mt-5">
            <div class="card-header">Login</div>
            <div class="card-body">
                <form action="{{ route('loginsave') }}" method="post">
                    @csrf
                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <input type="email" id="form2Example1" class="form-control" name="email" placeholder="Email address">
                        <small style="color: red; margin:2px;">{{ $errors->first('email') }}</small>
                    </div>
                    <div class="form-outline mb-4">
                        <input type="password" id="form2Example2" name="pass" class="form-control" placeholder="Password">
                        <small style="color: red; margin:2px;">{{ $errors->first('pass') }}</small>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <button type="submit" class="btn btn-primary btn-block mb-4 w-100">Sign in</button>
                        </div>
                        <div class="col">
                            <a class="btn btn-primary" href="{{ route('register') }}">Register</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection