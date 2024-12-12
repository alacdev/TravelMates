var map = L.map('map').setView([40.416775, -3.703790], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Array para almacenar los marcadores creados
        var marcadores = [];

        // Al hacer clic en el mapa, agregar un marcador
        map.on('click', function (e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;
            var mensaje = prompt("Introduce un mensaje para el marcador:");

            if (mensaje) {
                L.marker([lat, lng])
                    .addTo(map)
                    .bindPopup(`<b>${mensaje}</b>`);

                // Agregar marcador al array local
                marcadores.push({
                    latitud: lat,
                    longitud: lng,
                    mensaje: mensaje
                });
            }
        });

        // Al hacer clic en el botón de guardar marcadores

        document.getElementById('guardar-marcadores').addEventListener('click', function (e) {
            e.preventDefault();

            // Enviar los marcadores por POST
            fetch('/guardar-marcadores', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(marcadores)
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        alert('Marcadores guardados correctamente');
                    } else {
                        alert('Error al guardar los marcadores');
                    }
                })
                .catch(error => console.error("Error al guardar los marcadores:", error));
        });