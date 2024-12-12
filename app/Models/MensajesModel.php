<?php

declare(strict_types=1);

namespace Com\TravelMates\Models;

class MensajesModel extends \Com\TravelMates\Core\BaseDbModel {
    
    /**
     * Guarda un mensaje en la bbdd
     *
     * @param  mixed $id_emisor
     * @param  mixed $id_receptor
     * @param  mixed $mensaje
     * @return bool
     */
    function guardarMensaje (int $id_emisor, int $id_receptor, string $mensaje): bool {
        $sql = "INSERT INTO mensajes (id_emisor, id_receptor, contenido, fecha) VALUES (:id_emisor, :id_receptor, :mensaje, NOW())";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':id_emisor' => $id_emisor,
            ':id_receptor' => $id_receptor,
            ':mensaje'=> $mensaje
        ]);
        return $stmt->rowCount() > 0;
    }
}
