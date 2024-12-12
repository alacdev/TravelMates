<?php

declare(strict_types=1);

namespace Com\TravelMates\Models;

class SolicitudesModel extends \Com\TravelMates\Core\BaseDbModel
{    
    /**
     * Devuelve las solictudes que ha recibido el usuario pasado como parámetro.
     *
     * @param  mixed $id_usuario
     * @return void
     */
    function obtenerSolicitudesRecibidas(int $id_usuario)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM solicitudes_amistad WHERE id_receptor = ?');
        $stmt->execute([$id_usuario]);
        return $stmt->fetchAll();
    }
    
    /**
     * Envía una solicitud de amistad
     *
     * @param  mixed $id_emisor
     * @param  mixed $id_receptor
     * @return bool
     */
    function enviarSolicitudAmistad(int $id_emisor, int $id_receptor): bool
    {
        $stmt = $this->pdo->prepare('INSERT INTO solicitudes_amistad (id_emisor, id_receptor) VALUES (?, ?)');
        $stmt->execute([$id_emisor, $id_receptor]);

        return $stmt->rowCount() > 0;
    }
    
    /**
     * Cancela la solicitud de amistad
     *
     * @param  mixed $id_emisor
     * @param  mixed $id_receptor
     * @return bool
     */
    function cancelarSolicitudAmistad(int $id_emisor, int $id_receptor): bool 
    {
        $stmt = $this->pdo->prepare('DELETE FROM solicitudes_amistad WHERE id_emisor = ? AND id_receptor = ?');
        $stmt->execute([$id_emisor, $id_receptor]);

        return $stmt->rowCount() > 0;
    }
    
    /**
     * Comprueba ya existe una solicitud entre los usuarios.
     *
     * @param  mixed $id_emisor
     * @param  mixed $id_receptor
     * @return void
     */
    public function verificarSolicitud($id_emisor, $id_receptor)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM solicitudes_amistad WHERE id_emisor = :id_emisor AND id_receptor = :id_receptor');
        $stmt->execute([
            'id_emisor' => $id_emisor,
            'id_receptor' => $id_receptor
        ]);

        return $stmt->fetch();
    }
    
    /**
     * Acepta la solicitud de amistad
     *
     * @param  mixed $id_solicitud
     * @return bool
     */
    function aceptarSolicitud(int $id_solicitud): bool 
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
    
    /**
     * Rechaza la solicitud de amistad
     *
     * @param  mixed $id_solicitud
     * @return bool
     */
    function rechazarSolicitud(int $id_solicitud): bool 
    {
        $stmt = $this->pdo->prepare('DELETE FROM solicitudes_amistad WHERE id = ?');
        $stmt->execute([$id_solicitud]);

        return $stmt->rowCount() > 0;
    }

}