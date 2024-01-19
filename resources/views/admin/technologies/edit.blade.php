@extends('layouts.main')

@section('content')
<div class="container">

    <h1>Edit Technology</h1>

    <a href="{{ route('technologies.index') }}" class="btn btn-primary">Back</a>

    <form action="{{ route('technologies.update', $technology->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" class="form-control" value="{{ $technology->name }}" required>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>

@endsection