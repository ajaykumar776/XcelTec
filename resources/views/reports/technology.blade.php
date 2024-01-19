@extends('layouts.main')

@section('content')
<div class="row" style="margin-top: 10px;">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="">
                        <h1>Technology Report</h1>
                    </div>
                    @error('error')
                    <div class="">
                        <span class="text-danger">{{ $message ?? "" }}</span>
                    </div>
                    @enderror
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-centered mb-0" id="technology">
                        <thead>
                            <tr>
                                <th>Technology</th>
                                <th>Client</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($technologyReport as $data)
                            <tr>
                                <td>{{ $data['name'] }}</td>
                                <td>{{ $data['users_count'] }}</td>
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
    new DataTable('#technology');
</script>
@endsection