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
<!-- Add this line before your script -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<!-- Your script comes after the Leaflet inclusion -->
<script>
    var map = L.map('map');
    var users = <?php echo json_encode($users); ?>;

    // Calculate average coordinates
    var totalLatitude = 0;
    var totalLongitude = 0;

    users.forEach(function(user) {
        var coordinates = user.map_details.split(',');
        totalLatitude += parseFloat(coordinates[0]);
        totalLongitude += parseFloat(coordinates[1]);
    });

    var avgLatitude = totalLatitude / users.length;
    var avgLongitude = totalLongitude / users.length;

    map.setView([avgLatitude, avgLongitude], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    users.forEach(function(user) {
        var coordinates = user.map_details.split(',');
        var firstName = user.first_name;
        var phone = user.phone;

        L.marker([parseFloat(coordinates[0]), parseFloat(coordinates[1])])
            .addTo(map)
            .bindPopup('<b>Name:</b> ' + firstName + '<br><b>Contact:</b> ' + phone)
            .openPopup();
    });
</script>

@endsection