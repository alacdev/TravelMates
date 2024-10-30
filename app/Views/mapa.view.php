<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa con Marcadores desde la Base de Datos</title>
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
    // Inicializar el mapa
    var map = L.map('map').setView([40.416775, -3.703790], 13);

    // Cargar los tiles de OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Función para obtener marcadores desde la base de datos
    function cargarMarcadores() {
        fetch('get_marcadores.php')
            .then(response => response.json())
            .then(data => {
                data.forEach(marcador => {
                    // Añadir los marcadores al mapa
                    L.marker([marcador.latitud, marcador.longitud])
                        .addTo(map)
                        .bindPopup(`<b>${marcador.descripcion}</b>`);
                });
            });
    }

    // Cargar los marcadores al inicializar el mapa
    cargarMarcadores();

    // Evento para añadir un nuevo marcador al hacer clic en el mapa
    map.on('click', function(e) {
        var lat = e.latlng.lat;
        var lng = e.latlng.lng;

        // Pedir al usuario que introduzca una descripción para el marcador
        var descripcion = prompt("Introduce una descripción para el marcador:");

        if (descripcion) {
            // Añadir el marcador al mapa
            L.marker([lat, lng])
                .addTo(map)
                .bindPopup(`<b>${descripcion}</b>`);

            // Guardar el marcador en la base de datos
            fetch('add_marcador.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `latitud=${lat}&longitud=${lng}&descripcion=${descripcion}`
            }).then(response => response.json())
              .then(data => {
                  if (data.status === 'success') {
                      alert('Marcador guardado correctamente');
                  } else {
                      alert('Error al guardar el marcador');
                  }
              });
        }
    });
</script>

</body>
</html>
