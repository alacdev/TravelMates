<?php

declare(strict_types=1);

namespace Com\TravelMates\Models;

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
        // $archivoRecortado = $this->cropImageToSquare($archivo);
        // $image_data = base64_encode(file_get_contents($archivoRecortado['tmp_name']));
        
        $image_data = base64_encode(file_get_contents($archivo['tmp_name']));

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
            return 'null';
        }
    }

    function cropImageToSquare($fileInput)
    {
        $info = getimagesize($fileInput);
        switch ($info[2]) {
            case IMAGETYPE_JPEG:
                $sourceImage = imagecreatefromjpeg($fileInput);
                break;
            case IMAGETYPE_PNG:
                $sourceImage = imagecreatefrompng($fileInput);
                break;
        }
        $width = imagesx($sourceImage);
        $height = imagesy($sourceImage);

        $size = min($width, $height);
        $x = ($width - $size) / 2;
        $y = ($height - $size) / 2;

        $croppedImage = imagecreatetruecolor($size, $size);
        imagecopy($croppedImage, $sourceImage, 0, 0, $x, $y, $size, $size);

        $tempFile = tempnam(sys_get_temp_dir(), 'cropped_');
        imagepng($croppedImage, $tempFile);

        imagedestroy($sourceImage);
        imagedestroy($croppedImage);

        return [
            'name' => 'cropped_' . $fileInput['name'],
            'type' => 'image/png',
            'tmp_name' => $tempFile,
            'error' => 0,
            'size' => filesize($tempFile)
        ];
    }


}
