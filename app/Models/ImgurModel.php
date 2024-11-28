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
        $rutaProcesada = $this->recortarYRedimensionar($ruta, 15);
    
        $image_data = base64_encode(file_get_contents($rutaProcesada));
    
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
    
    private function recortarYRedimensionar($archivo, $tamanio) {
        // Obtener las dimensiones originales de la imagen
        list($ancho, $alto, $tipo) = getimagesize($archivo);
    
        // Cargar la imagen dependiendo de su tipo
        switch ($tipo) {
            case IMAGETYPE_JPEG:
                $imagenOriginal = imagecreatefromjpeg($archivo);  // Cargar imagen JPEG en memoria
                break;
            case IMAGETYPE_PNG:
                $imagenOriginal = imagecreatefrompng($archivo);   // Cargar imagen PNG en memoria
                break;
            default:
                throw new Exception("Tipo de imagen no soportado.");
        }
    
        // Determinar el tamaño de la dimensión menor (ancho o alto) para hacer un recorte cuadrado
        $dimensionMenor = min($ancho, $alto);
        $x = ($ancho - $dimensionMenor) / 2;  // Coordenada X para centrar el recorte
        $y = ($alto - $dimensionMenor) / 2;   // Coordenada Y para centrar el recorte
    
        // Crear el recorte cuadrado de la imagen
        $imagenCuadrada = imagecrop($imagenOriginal, [
            'x' => $x,
            'y' => $y,
            'width' => $dimensionMenor,
            'height' => $dimensionMenor
        ]);
    
        // Redimensionar la imagen recortada al tamaño deseado
        $imagenRedimensionada = imagescale($imagenCuadrada, $tamanio, $tamanio);
    
        // Ruta de la carpeta donde se guardarán las imágenes recortadas y redimensionadas
        $directorioDestino = __DIR__ . '/../../assets/img/';
        
        // Asegurarse de que la carpeta exista
        if (!is_dir($directorioDestino)) {
            mkdir($directorioDestino, 0777, true);  // Crear la carpeta si no existe
        }
    
        // Crear un nombre único para evitar sobrescribir archivos existentes
        $nombreArchivo = uniqid('img_') . '.jpg';
        $rutaFinal = $directorioDestino . $nombreArchivo;
    
        // Guardar la imagen redimensionada en la carpeta de destino
        imagejpeg($imagenRedimensionada, $rutaFinal);
    
        // Liberar memoria
        imagedestroy($imagenOriginal);
        imagedestroy($imagenCuadrada);
        imagedestroy($imagenRedimensionada);
    
        // Devolver la ruta final de la imagen guardada
        return $rutaFinal;
    }
    
    
}
