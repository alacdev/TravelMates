<?php

declare(strict_types=1);

namespace Com\TravelMates\Models;

class MapaModel extends \Com\TravelMates\Core\BaseDbModel {

    public function getMarcadores(): array {
        $stmt = $this->pdo->query('SELECT latitud, longitud, descripcion FROM marcadores');
        return $stmt->fetchAll();
    }

    public function addMarcador(float $latitud, float $longitud, string $descripcion): bool {
        $sql = "INSERT INTO marcadores (latitud, longitud, descripcion) VALUES (:latitud, :longitud, :descripcion)";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
                    ':latitud' => $latitud,
                    ':longitud' => $longitud,
                    ':descripcion' => $descripcion
        ]);
    }

}
