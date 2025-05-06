<!DOCTYPE html>
<html>
<head>
    <title>Leaflet Map</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Leaflet CSS --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    
    <style>
        #map { height: 600px; }
    </style>
</head>
<body>

    <div id="map"></div>

    {{-- Leaflet JS --}}
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
        var map = L.map('map').setView([0.7203877454558969, 122.47458474464645], 10);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Load GeoJSON
        fetch('assets/maps/pertanian.geojson')
            .then(response => response.json())
            .then(data => {
                L.geoJSON(data).addTo(map);
            });

    </script>

</body>
</html>
