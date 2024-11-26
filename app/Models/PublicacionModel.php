<?php

declare(strict_types=1);

namespace Com\TravelMates\Models;

class PublicacionModel extends \Com\TravelMates\Core\BaseDbModel {

    function getAll(): array {
        $stmt = $this->pdo->query('SELECT * FROM publicaciones');
        return $stmt->fetchAll();
    }

    public function nuevaPublicacion(string $url, string $texto, string $fecha): bool {
        $sql = "INSERT INTO publicaciones (url_img, texto, fecha) VALUES (:url_img, :texto, :fecha)";
        $stmt = $this->pdo->prepare($sql);

        $resultado = $stmt->execute([
            ':url_img' => $url,
            ':texto' => $texto,
            ':fecha' => $fecha
        ]);

        if (!$resultado) {
            error_log("Error al insertar la pu: " . implode(", ", $stmt->errorInfo()));
        }
        echo json_encode(['status' => $resultado ? 'success' : 'error']);
        return $resultado;
    }
}
