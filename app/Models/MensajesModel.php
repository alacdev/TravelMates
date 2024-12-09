<?php

declare(strict_types=1);

namespace Com\TravelMates\Models;

class MensajesModel extends \Com\TravelMates\Core\BaseDbModel {

    function obtenerTodos(): array {
        $stmt = $this->pdo->query('SELECT * FROM mensajes');
        return $stmt->fetchAll();
    }

    function guardarMensaje (int $id_emisor, int $id_receptor, string $mensaje) {
        $sql = "INSERT INTO mensajes (id_emisor, id_receptor, contenido, fecha) VALUES (:id_emisor, :id_receptor, :mensaje, NOW())";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':id_emisor' => $id_emisor,
            ':id_receptor' => $id_receptor,
            ':mensaje'=> $mensaje
        ]);
    }
}
