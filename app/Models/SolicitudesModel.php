<?php

declare(strict_types=1);

namespace Com\TravelMates\Models;

class SolicitudesModel extends \Com\TravelMates\Core\BaseDbModel
{
    function obtenerSolicitudesRecibidas(int $id_usuario)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM solicitudes_amistad WHERE id_receptor = ?');
        $stmt->execute([$id_usuario]);
        return $stmt->fetchAll();
    }

    function aceptarSolicitud(int $id_solicitud)
    {
        $stmt1 = $this->pdo->prepare('SELECT * FROM solicitudes_amistad WHERE id = ?');
        $stmt1->execute([$id_solicitud]);
        $solicitud = $stmt1->fetch();

        if ($solicitud) {
            $stmt2 = $this->pdo->prepare('INSERT INTO amistades (id_usuario1, id_usuario2, fecha) VALUES (?, ?, NOW())');
            $stmt2->execute([$solicitud['id_emisor'], $solicitud['id_receptor']]);

            $stmt3 = $this->pdo->prepare('DELETE FROM solicitudes_amistad WHERE id = ?');
            $stmt3->execute([$id_solicitud]);

            return true;
        }

        return false;
    }

    function rechazarSolicitud(int $id_solicitud)
    {
        $stmt = $this->pdo->prepare('DELETE FROM solicitudes_amistad WHERE id = ?');
        $stmt->execute([$id_solicitud]);

        return $stmt->rowCount() > 0;
    }

}