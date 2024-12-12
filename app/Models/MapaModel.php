<?php

declare(strict_types=1);

namespace Com\TravelMates\Models;

class MapaModel extends \Com\TravelMates\Core\BaseDbModel
{
    
    /**
     * Devuelve todos los marcadores del usuario de la sesión
     *
     * @return array
     */
    public function obtenerMarcadores(): array
    {
        $stmt = $this->pdo->prepare('SELECT latitud, longitud, mensaje FROM marcadores_mapa WHERE id_usuario = :id_usuario');
        $stmt->execute([':id_usuario' => $_SESSION['user']['id']]);
        return $stmt->fetchAll();
    }
    
    /**
     * Añade un marcador a la bbdd
     *
     * @param  mixed $id_usuario
     * @param  mixed $latitud
     * @param  mixed $longitud
     * @param  mixed $mensaje
     * @return bool
     */
    public function nuevoMarcador(int $id_usuario, float $latitud, float $longitud, string $mensaje): bool
    {
        $sql = "INSERT INTO marcadores_mapa (id_usuario, latitud, longitud, mensaje) VALUES (:id_usuario, :latitud, :longitud, :mensaje)";
        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':id_usuario' => $id_usuario,
            ':latitud' => $latitud,
            ':longitud' => $longitud,
            ':mensaje' => $mensaje
        ]);

        return $stmt->rowCount() > 0;
    }
}
