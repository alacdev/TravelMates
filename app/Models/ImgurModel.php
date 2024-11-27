<?php

declare(strict_types=1);

namespace Com\TravelMates\Models;

class ImgurModel extends \Com\TravelMates\Core\BaseDbModel {
    private const CLIENT_ID = 'ef85bd54003330c';

    /**
     * Método para subir una imagen a Imgur.
     *
     * @param string $ruta Ruta del archivo que se subirá.
     * @return string URL de la imagen subida.
     */
    public function obtenerUrl($ruta) {        
        $image_data = base64_encode(file_get_contents($ruta));
        

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.imgur.com/3/image');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Client-ID {CLIENT_ID}"
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, [
            'image' => $image_data
        ]);        

        $response = curl_exec($ch);
        curl_close($ch);        

        $response_data = json_decode($response, true);

        if (isset($response_data['data']['link'])) {
            return $response_data['data']['link'];
        } else {
            //error
        }
    }
}
