@extends('layouts.main')

@section('content')

<div class="container">
    <h1>Create Technology</h1>

    <a href="{{ route('technologies.index') }}" class="btn btn-primary">Back</a>

    <form action="{{ route('technologies.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Create</button>
    </form>
</div>

@endsection