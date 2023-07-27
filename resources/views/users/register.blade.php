@extends('layouts.main')

@section('content')

<?php

$addresses = $addresses ?? null;
?>
<style>
    .btn-center {
        display: flex;
        align-items: end;
        justify-content: center;
    }

    .clone-btn {
        border-radius: 50%;
        color: red;
        background: transparent;
        border: 4px solid red;
        font-size: 14px;
    }

    .clone-btn:hover {
        background: none;
        color: black;
        border: 4px solid red;
    }

    .btn-danger {
        border-radius: 50%;
        color: black;
        background: transparent;
        border: 4px solid black;
        font-size: 14px;
    }

    .btn-danger:hover {
        background: none;
        color: black;
        border: 4px solid black;
    }
</style>
<div class="row">
    <div class="col-2"></div>
    <div class="col-md-8" style="margin-top: 10px;">

        <div class="card">

            <div class="card-header d-flex justify-content-between">
                <div>
                    <a href="{{ route('dashboard') }}" class="">Go Back</a>
                </div>
                <div>
                    <h5 class="card-title">{{ $title }} Form</h5>
                </div>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('usersave') }}" id="UserForm">
                    @csrf
                    <div class="row">
                        <input type="text" name="user_id" hidden value="{{$data['id'] ?? ''}}">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input required type="text" id="name" class="form-control" name="name" value="{{ old('name', $data['name'] ?? '') }}">
                                @error('name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input required type="email" id="email" name="email" class="form-control" value="{{ old('email', $data['email'] ?? '') }}">
                                @error('email')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>


                        </div>
                        <div class="col-md-6">

                            <div class="mb-3">
                                <label for="contact" class="form-label">Contact</label>
                                <input required type="contact" id="contact" name="phone" class="form-control" value="{{ old('phone', $data['phone'] ?? '') }}">
                                @error('phone')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            @if($col_pass)
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input required type="text" id="password" class="form-control" name="password" value="{{ old('password', $data['password'] ?? '') }}">
                                @error('password')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            @endif
                            <div class="mb-3">
                                <label>User Type:</label>
                                <div class="form-check form-check-inline">
                                    <input required class="form-check-input" type="radio" id="userTypeUser" name="user_type" value="User" {{ (old('user_type', $data['user_type'] ?? '') === 'User') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="userTypeUser">User</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input required class="form-check-input" type="radio" id="userTypeAdmin" name="user_type" value="Admin" {{ (old('user_type', $data['user_type'] ?? '') === 'Admin') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="userTypeAdmin">Admin</label>
                                </div>
                            </div>
                            @error('user_type')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="row justify-content mt-5">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    Address Form
                                </div>
                                <div class="card-body" id="main_div">
                                    @if($addresses !==null)
                                    @foreach ($addresses as $index => $address)
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="country">Country</label>
                                                <select required class="form-control" id="country_{{ $index }}" onchange="loadState(this.id,this.value)" name="country_id[]">
                                                    <option value="">Select Country</option>
                                                    <!-- Populate country dropdown dynamically -->
                                                    @foreach ($countries as $country)
                                                    <option value="{{ $country['id'] }}" @if (old('country_id.'.$index, $address['country'])==$country['id']) selected @endif>
                                                        {{ $country['name'] }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('country_id.*')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="state">State</label>
                                                <select required class="form-control" id="state_{{ $index }}" name="state_id[]" onchange="loadCity(this.id,this.value)">
                                                    <option value="">Select State</option>
                                                    @foreach ($states as $state)
                                                    <option value="{{ $state['id'] }}" @if (old('state_id.'.$index, $address['state'])==$state['id']) selected @endif>
                                                        {{ $state['name'] }}
                                                    </option>
                                                    @endforeach
                                                    @error('state_id.*')
                                                    <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="city">City</label>
                                                <select required class="form-control" name="city_id[]" id="city_{{ $index }}">
                                                    <option value="">Select City</option>
                                                    @foreach ($cities as $city)
                                                    <option value="{{ $city['id'] }}" @if (old('city_id.'.$index, $address['city'])==$city['id']) selected @endif>
                                                        {{ $city['name'] }}
                                                    </option>
                                                    @endforeach
                                                    <!-- Cities will be populated dynamically based on selected state -->
                                                </select>
                                                @error('city_id.*')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-1 btn-center">
                                            <!-- The "+" button should only be shown for the first address row -->
                                            @if ($index === 0)
                                            <button type="button" class="btn btn-primary clone-btn">+</button>
                                            @else
                                            <!-- Show "Remove" button for all other address rows -->
                                            <button type="button" class="btn btn-danger remove-btn">-</button>
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif
                                    @if($addresses ==null)
                                    <div class="row default">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="country">Country</label>
                                                <select required class="form-control" id="country_0" onchange="loadState(this.id,this.value)" name="country_id[]">
                                                    <option value="">Select Country</option>
                                                    <!-- Populate country dropdown dynamically -->
                                                    @foreach ($countries as $country)
                                                    <option value="{{ $country['id'] }}" @if (old('country_id', $address['country'] ?? '' )==$country['id']) selected @endif>
                                                        {{ $country['name'] }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('country_id.*')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror

                                            </div>

                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="state">State</label>
                                                <select required class="form-control" id="state_0" name="state_id[]" onchange="loadCity(this.id,this.value)">
                                                    <option value="">Select State</option>
                                                    @foreach ($states as $state)
                                                    <option value="{{ $state['id'] }}" @if (old('state_id', $address['state'] ?? '' )==$state['id']) selected @endif>
                                                        {{ $state['name'] }}
                                                    </option>
                                                    @endforeach
                                                    <!-- States will be populated dynamically based on selected country -->
                                                </select>
                                                @error('state_id.*')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="city">City</label>
                                                <select required class="form-control" name="city_id[]" id="city_0">
                                                    <option value="">Select City</option>
                                                    @foreach ($cities as $city)
                                                    <option value="{{ $city['id'] }}" @if (old('city_id', $address['city'] ?? '' )==$city['id']) selected @endif>
                                                        {{ $city['name'] }}
                                                    </option>
                                                    @endforeach
                                                    <!-- Cities will be populated dynamically based on selected state -->
                                                </select>
                                                @error('city_id.*')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="col-md-1 btn-center">
                                            <button type="button" class="btn btn-primary clone-btn">+</button>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary" style="width: 20%; float:right;">{{$title}}</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        var counter = <?php echo count($addresses ?? []) ?? 0 ?>
        // Cloning row on "+" button click
        $(document).on("click", ".clone-btn", function() {
            var lastRow = $('#main_div').find('.row').last();
            var clonedRow = lastRow.clone();
            counter++;

            clonedRow.find("select").val(""); // Reset select values in cloned row
            clonedRow.find(".clone-btn").removeClass("clone-btn btn-primary").addClass("remove-btn btn-danger").text("-");

            // Update the IDs of the select tags
            clonedRow.find("select").each(function() {
                var oldId = $(this).attr("id");
                var prefix = oldId.split("_")[0]; // Get the prefix, e.g., "country"
                var newId = prefix + "_" + counter; // Append the counter to form the new ID
                $(this).attr("id", newId);
            });

            clonedRow.insertAfter(lastRow);
        });

        // Removing row on "-" button click
        $(document).on("click", ".remove-btn", function() {
            $(this).closest(".row").remove();
        });
    });
</script>
@endsection