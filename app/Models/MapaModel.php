<?php

declare(strict_types=1);

namespace Com\TravelMates\Models;

class MapaModel extends \Com\TravelMates\Core\BaseDbModel {

    public function getMarcadores(int $id_usuario): array {
        $stmt = $this->pdo->prepare('SELECT latitud, longitud, mensaje FROM marcadores_mapa WHERE id_usuario = :id_usuario');
        $stmt->execute([':id_usuario' => $id_usuario]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function addMarcador(int $id_usuario, float $latitud, float $longitud, string $mensaje): bool {
        $sql = "INSERT INTO marcadores_mapa (id_usuario, latitud, longitud, mensaje) VALUES (:id_usuario, :latitud, :longitud, :mensaje)";
        $stmt = $this->pdo->prepare($sql);

        $resultado = $stmt->execute([
            ':id_usuario' => $id_usuario,
            ':latitud' => $latitud,
            ':longitud' => $longitud,
            ':mensaje' => $mensaje
        ]);

        if (!$resultado) {
            error_log("Error al insertar el marcador: " . implode(", ", $stmt->errorInfo()));
        }
        echo json_encode(['status' => $resultado ? 'success' : 'error']);
        return $resultado;
    }
}
