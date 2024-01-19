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

            <div class="container">
                <form method="POST" action="{{ route('usersave') }}" id="UserForm">
                    @csrf
                    <div class="row">
                        <input type="text" name="user_id" hidden value="{{$data['id'] ?? ''}}">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="first_name" class="form-label">First Name</label>
                                <input required type="text" id="first_name" class="form-control" name="first_name" value="{{ old('first_name', $data['first_name'] ?? '') }}">
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
                            <div class="mb-3">
                                <label for="contact" class="form-label">Contact</label>
                                <input required type="contact" id="contact" name="phone" class="form-control" value="{{ old('phone', $data['phone'] ?? '') }}">
                                @error('phone')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <div id="map" style="height: 400px;"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Last Name</label>
                                <input required type="text" id="last_name" class="form-control" name="last_name" value="{{ old('last_name', $data['last_name'] ?? '') }}">
                                @error('name')
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
                            @if($col_source)
                            <div class="mb-3">
                                <label>How did you hear about us?</label>
                                <?php $count = 0; ?>
                                @foreach($sources as $index=> $source)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="source{{$source->id}}" name="sources[]" value="{{$source->id}}" <?php echo isset($data['sources'][$index]) ? (($data['sources'][$index]->id == $source->id) ? "checked" : "") : ""  ?>>
                                    <label class="form-check-label" for="source{{$source->id}}">{{$source->name}}</label>
                                </div>
                                <?php $count++; ?>
                                @endforeach

                                @error('sources')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            @endif
                            @if($col_technology)
                            <div class="mb-3">
                                <label>Technology Interested:</label>
                                <input type="text" hidden value="{{$data['map_details']}}" name="map_details" id="mapdata">
                                <div class="row">
                                    <?php $count = 0; ?>
                                    @foreach($technology as $index => $source)
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="source{{$source->id}}" name="technology[]" value="{{$source->id}}" <?php echo isset($data['technologies'][$index]) ? (($data['technologies'][$index]->id == $source->id) ? "checked" : "") : ""  ?>>
                                            <label class="form-check-label" for="source{{$source->id}}">{{$source->name}}</label>
                                        </div>
                                    </div>

                                    <?php
                                    $count++;
                                    if ($count % 10 == 0) {
                                        // Close the current row and start a new one
                                        echo '</div><div class="row">';
                                    }
                                    ?>
                                    @endforeach
                                </div>
                                @endif

                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary" style="width: 20%; float:right;">{{$title}}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    let coordinatesString = $('#mapdata').val();
    var coordinatesArray = coordinatesString.split(', ');

    var latitude = parseFloat(coordinatesArray[0]);
    var longitude = parseFloat(coordinatesArray[1]);

    var map = L.map('map').setView([51.505, -0.09], 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    var marker = coordinatesString ? L.marker([latitude, longitude]).addTo(map) : "";
    map.on('click', function(e) {
        if (marker) {
            map.removeLayer(marker);
        }
        marker = L.marker(e.latlng).addTo(map);
        console.log(marker);
        let data = e.latlng.lat + ' , ' + e.latlng.lng;
        $('#mapdata').val(data);
    });
</script>
@endsection