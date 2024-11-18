<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        #map {
            height: 80vh;
            width: 100%;
        }
    </style>
</head>
<body>

<div id="map"></div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    var map = L.map('map').setView([40.416775, -3.703790], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    function cargarMarcadores() {
        fetch('/mapa/get_marcadores')
            .then(response => response.json())
            .then(data => {
                console.log(data);
                data.forEach(marcador => {
                    L.marker([marcador.latitud, marcador.longitud])
                        .addTo(map)
                        .bindPopup(`<b>${marcador.mensaje}</b>`);
                });
            })
            .catch(error => console.error("Error al cargar los marcadores:", error));
    }

    cargarMarcadores();

    map.on('click', function(e) {
        var lat = e.latlng.lat;
        var lng = e.latlng.lng;
        var mensaje = prompt("Introduce un mensaje para el marcador:");

        if (mensaje) {
            L.marker([lat, lng])
                .addTo(map)
                .bindPopup(`<b>${mensaje}</b>`);

            fetch('/mapa/add_marcador', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `latitud=${lat}&longitud=${lng}&mensaje=${encodeURIComponent(mensaje)}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert('Marcador guardado correctamente');
                } else {
                    alert('Error al guardar el marcador');
                }
            })
            .catch(error => console.error("Error al guardar el marcador:", error));
        }
    });
</script>

</body>
</html>
