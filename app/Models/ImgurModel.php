<?php

declare(strict_types=1);

namespace Com\TravelMates\Models;

class ImgurModel extends \Com\TravelMates\Core\BaseDbModel {
    private $client_id;

    public function __construct($client_id) {
        $this->client_id = $client_id;
    }

    /**
     * Método para subir una imagen a Imgur.
     *
     * @param string $ruta Ruta del archivo que se subirá.
     * @return string URL de la imagen subida.
     * @throws Exception Si ocurre un error al subir la imagen.
     */
    public function obtenerUrl($ruta) {
        if (!file_exists($ruta)) {
            throw new Exception("El archivo no existe: $ruta");
        }

        $image_data = base64_encode(file_get_contents($ruta));

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.imgur.com/3/image');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Client-ID {$this->client_id}"
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, [
            'image' => $image_data
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        $response_data = json_decode($response, true);

        if (isset($response_data['data']['link'])) {
            return $response_data['data']['link']; // Retornar la URL de la imagen subida
        } else {
            $error_message = $response_data['data']['error'] ?? 'Error desconocido';
            throw new Exception("Error al subir la imagen: $error_message");
        }
    }
}
