@extends('layouts.main')

@section('content')

<h1>Technologies <span><a href="{{ route('technologies.create') }}" class="btn btn-success">Create Technology</a>
    </span></h1>


<div class="container">
    <table class="table mt-3" id="example">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($technologies as $technology)
            <tr>
                <td>{{ $technology->id }}</td>
                <td>{{ $technology->name }}</td>
                <td>
                    <a href="{{ route('technologies.edit', $technology->id) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('technologies.destroy', $technology->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script>
    new DataTable('#example');
</script>
@endsection