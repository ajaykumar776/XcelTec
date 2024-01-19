function initializeMap(users) {
    var map = L.map('map');
    var totalLatitude = 0;
    var totalLongitude = 0;

    users.forEach(function (user) {
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

    users.forEach(function (user) {
        var coordinates = user.map_details.split(',');
        var firstName = user.first_name;
        var lastName = user.last_name;
        var phone = user.phone;
        var email = user.email;

        L.marker([parseFloat(coordinates[0]), parseFloat(coordinates[1])])
            .addTo(map)
            .bindPopup(`<b>Name:</b> ${firstName} ${lastName}<br><b>Contact:</b> ${phone}<br><b>Email:</b> ${email}`)
            .openPopup();
    });
}