<?php

declare(strict_types=1);

namespace Com\TravelMates\Models;

class PublicacionModel extends \Com\TravelMates\Core\BaseDbModel {

    function getAll(): array {
        $stmt = $this->pdo->query('SELECT * FROM publicaciones ORDER BY fecha DESC');
        return $stmt->fetchAll();
    }

    public function nuevaPublicacion(string $url, string $username, string $texto, string $fecha): bool {
        $sql = "INSERT INTO publicaciones (url_img, username, texto, fecha) VALUES (:url_img, :username, :texto, :fecha)";
        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':url_img' => $url,
            ':username' => $username,
            ':texto' => $texto,
            ':fecha' => $fecha
        ]);

        return $stmt->rowCount() > 0;
    }
}
