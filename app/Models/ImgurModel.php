<?php

declare(strict_types=1);

namespace Com\TravelMates\Models;
use Imagick;

class ImgurModel extends \Com\TravelMates\Core\BaseDbModel
{
    private const CLIENT_ID = 'ef85bd54003330c';

    /**
     * Método para subir una imagen a Imgur.
     *
     * @param string $archivo Archivo que se subirá.
     * @return string URL de la imagen subida.
     */
    public function obtenerUrl($archivo)
    {
        $tempFile = tempnam(sys_get_temp_dir(), 'img_');
        $this->cropAndResizeImage($archivo['tmp_name'], $tempFile);


        $image_data = base64_encode(file_get_contents($tempFile));
        unlink($tempFile);
        
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
            return 'null';
        }
    }
    
    /**
     * Recorta y redimensiona la imagen pasada para estandarizar todas las imágenes de la web
     *
     * @param  mixed $imagePath
     * @param  mixed $outputPath
     * @param  mixed $width
     * @param  mixed $height
     * @return void
     */
    public function cropAndResizeImage($imagePath, $outputPath, $width = 500, $height = 500)
    {
        $imagick = new Imagick($imagePath);
        $imagick->cropThumbnailImage($width, $height);
        $imagick->writeImage($outputPath);
        return true;
    }
}
