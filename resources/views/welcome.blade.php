<!DOCTYPE html>
<html>
<head>
    <title>Leaflet Map</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Leaflet CSS --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
    crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
    crossorigin=""></script>
    
    <style>
        #map { height: 600px; }
        .info {
            padding: 6px 8px;
            background: white;
            background: rgba(255,255,255,0.8);
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
            border-radius: 5px;
            line-height: 1.5;
        }
        .legend i {
            width: 18px;
            height: 18px;
            float: left;
            margin-right: 8px;
            opacity: 0.7;
        }
    </style>
</head>
<body>

    <div id="map"></div>

    {{-- Leaflet JS --}}
    

    <script>
        var map = L.map('map').setView([0.7203877454558969, 122.47458474464645], 10);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Control info saat hover
        const info = L.control();

        info.onAdd = function (map) {
            this._div = L.DomUtil.create('div', 'info leaflet-control');
            this.update();
            return this._div;
        };

        info.update = function (props) {
            this._div.innerHTML = `<h4>Info Lahan</h4>` + 
                (props ? `<b>Kecamatan: ${props.NAMOBJ || 'Tidak diketahui'}</b><br/>Jenis Tanam: ${props.J_Tanam}` : 'Arahkan ke polygon');
        };

        info.addTo(map);

        const colorMap = {}; // Cache warna berdasarkan kategori

        function getRandomColor() {
            const letters = '0123456789ABCDEF';
            let color = '#';
            for(let i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }

        function getColorByKategori(kategori) {
            if (!colorMap[kategori]) {
                colorMap[kategori] = getRandomColor(); // assign sekali saja
            }
            return colorMap[kategori];
        }

        function style(feature) {
            return {
            fillColor: getColorByKategori(feature.properties.J_Tanam),
            weight: 1,
            opacity: 5,
            color: 'white',
            dashArray: '3',
            fillOpacity: 0.35
            };
        }

        // Event saat mouseover, mouseout, click
        function highlightFeature(e) {
            const layer = e.target;

            layer.setStyle({
                weight: 3,
                color: '#666',
                dashArray: '',
                fillOpacity: 0.9
            });

            layer.bringToFront();
            info.update(layer.feature.properties);
        }

        function resetHighlight(e) {
            geojson.resetStyle(e.target);
            info.update();
        }

        function zoomToFeature(e) {
            map.fitBounds(e.target.getBounds());
        }

        function onEachFeature(feature, layer) {
            layer.on({
                mouseover: highlightFeature,
                mouseout: resetHighlight,
                click: zoomToFeature
            });
        }

        let geojson;

        const legend = L.control({ position: 'bottomright' });

        // Legenda bawah kanan
        legend.onAdd = function () {
            const div = L.DomUtil.create('div', 'info legend');
            const allValues = new Set();

            geojson.eachLayer(function (layer) {
                const value = layer.feature.properties.J_Tanam;
                if (value) {
                    allValues.add(value);
                }
            });

            const uniqueValues = Array.from(allValues).sort();
            let labels = [];

            for (let value of uniqueValues) {
                const color = getColorByKategori(value);
                labels.push(`<i style="background:${color}"></i> ${value}`);
            }

            div.innerHTML = labels.join('<br>');
            return div;
                };

                // Load GeoJSON
            fetch('assets/maps/pertanian.geojson')
            .then(response => response.json())
            .then(data => {
                geojson = L.geoJSON(data, {
                    style: style,
                    onEachFeature: onEachFeature
                }).addTo(map);

                legend.addTo(map);
            })
            .catch(error => console.error('Error loading GeoJSON:', error));
    </script>

</body>
</html>
