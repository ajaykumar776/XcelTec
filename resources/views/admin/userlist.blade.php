@extends('layouts.main')

@section('content')
<div class="row" style="margin-top: 10px;">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="">
                        UsersList
                    </div>
                    @error('error')
                    <div class="">
                        <span class="text-danger">{{ $message }}</span>
                    </div>
                    @enderror
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-centered mb-0" id="example">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Sources</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lists as $user)
                            <tr>
                                <td>{{ $user['first_name'] }}</td>
                                <td>{{ $user['last_name'] }}</td>
                                <td>{{ $user['email'] }}</td>
                                <td>{{ $user['phone'] }}</td>
                                <td>
                                    @if(count($user['sources']) > 0)
                                    @foreach($user['sources'] as $source)
                                    <span class="badge bg-primary">{{ $source->name }}</span>
                                    @endforeach
                                    @endif
                                </td>
                            </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    new DataTable('#example');
</script>
@endsection