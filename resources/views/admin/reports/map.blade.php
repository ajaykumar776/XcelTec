@extends('layouts.main')

@section('content')
<div class="row" style="margin-top: 10px;">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="">
                        <h1>Map Report</h1>
                    </div>
                    @error('error')
                    <div class="">
                        <span class="text-danger">{{ $message ?? "" }}</span>
                    </div>
                    @enderror
                </div>
            </div>

            <div class="card-body">
                <div id="map" style="height: 400px;"></div>
            </div>
        </div>
    </div>

</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        initializeMap(<?php echo $users ?>);
    });
</script>

@endsection