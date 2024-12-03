<?php

declare(strict_types=1);

namespace Com\TravelMates\Models;

class AmistadesModel extends \Com\TravelMates\Core\BaseDbModel
{
    public function obtenerAmistades(int $id_usuario): array
    {
        $stmt = $this->pdo->prepare('
        SELECT 
            CASE 
                WHEN id_usuario1 = ? THEN id_usuario2
                ELSE id_usuario1
            END AS id_amigo
        FROM amistades
        WHERE id_usuario1 = ? OR id_usuario2 = ?;
    ');

        $stmt->execute([$id_usuario, $id_usuario, $id_usuario]);

        return $stmt->fetchAll();
    }

    public function esAmigo(int $id_usuario): bool
    {
        $id_usuario_sesion = $_SESSION['user']['id'];

        $stmt = $this->pdo->prepare('
        SELECT 
            CASE 
                WHEN id_usuario1 = ? AND id_usuario2 = ? THEN 1
                WHEN id_usuario1 = ? AND id_usuario2 = ? THEN 1
                ELSE 0
            END AS es_amigo
        FROM amistades
        WHERE (id_usuario1 = ? AND id_usuario2 = ?) 
           OR (id_usuario1 = ? AND id_usuario2 = ?);
    ');

        $stmt->execute([$id_usuario_sesion, $id_usuario, $id_usuario, $id_usuario_sesion, $id_usuario_sesion, $id_usuario, $id_usuario, $id_usuario_sesion]);

        return $stmt->rowCount() > 0;
    }



}
