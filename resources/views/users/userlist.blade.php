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
                    <div class="">
                        <a class="btn btn-primary" href="{{ route('register') }}">Add User</a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-centered mb-0">
                        <thead>
                            <tr>
                                <th>UserName</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>User Type</th>
                                <th>OTP Verified</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lists as $user)
                            <tr>
                                <td>{{ $user['name'] }}</td>
                                <td>{{ $user['email'] }}</td>
                                <td>{{ $user['phone'] }}</td>
                                <td>{{ $user['user_type'] }}</td>
                                <td>{{ $user['otp_verified'] ? 'Yes' : 'No' }}</td>
                                <td>{{ $user['created_at'] }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" onclick="handleEditButtonClick({{$user['id']}})">
                                        <i class="fa fa-edit"></i> Edit
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="handleDeleteButtonClick({{ $user['id']}})">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
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
    // Function to handle the edit button click
    function handleEditButtonClick(userId) {

        var userType = "{{ session('user_type') }}";
        if (userType === 'Admin') {
            window.location.href = '/users/edit/' + userId;
        } else {
            alert("You Don't have permission to edit");
        }
    }
    // Function to handle the Delete button click
    function handleDeleteButtonClick(userId) {

        var userType = "{{ session('user_type') }}";
        if (userType === 'Admin') {
            var confirmDelete = confirm("Are you sure you want to delete this user?");
            if (confirmDelete) {
                deleteUser(userId);
            } else {
                return false;
            }
        } else {
            alert("You Don't have permission to Delete");
        }
    }

    function deleteUser(userId) {
        var userType = "{{ session('user_type') }}";
        if (userType === 'Admin') {
            $.ajax({
                url: '/users/delete/' + userId,
                type: 'get',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    if (data.error) {
                        alert(data.error);
                    }
                    console.log('User deleted successfully!');
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        } else {
            alert("You Don't have permission to Delete");
        }

    }
</script>

@endsection