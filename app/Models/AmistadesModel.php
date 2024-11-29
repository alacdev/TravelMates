<?php

declare(strict_types=1);

namespace Com\TravelMates\Models;

class AmistadesModel extends \Com\TravelMates\Core\BaseDbModel
{
    function enviarSolicitudAmistad(int $id_emisor, int $id_receptor)
    {
        $stmt = $this->pdo->prepare('INSERT INTO solicitudes_amistad (id_emisor, id_receptor) VALUES (?, ?)');
        $stmt->execute([$id_emisor, $id_receptor]);

        return $stmt->rowCount() > 0;
    }

    function cancelarSolicitudAmistad(int $id_emisor, int $id_receptor)
    {
        $stmt = $this->pdo->prepare('DELETE FROM solicitudes_amistad WHERE id_emisor = ? AND id_receptor = ?');
        $stmt->execute([$id_emisor, $id_receptor]);

        return $stmt->rowCount() > 0;
    }

    public function verificarSolicitud($id_emisor, $id_receptor)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM solicitudes_amistad WHERE id_emisor = :id_emisor AND id_receptor = :id_receptor');
        $stmt->execute([
            'id_emisor' => $id_emisor,
            'id_receptor' => $id_receptor
        ]);

        return $stmt->fetch();
    }

    /*
    function aceptarSolicitudAmistad($id_solicitud) {
        $stmt = $this->pdo->prepare('SELECT id_emisor, id_receptor FROM solicitudes_amistad WHERE id_solicitud = ? AND estado = ?');
        $stmt->execute([$id_solicitud, "pendiente"]);
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $id_usuario_envia = $row['id_emisor'];
            $id_usuario_recibe = $row['id_receptor'];
    
            // Actualizar el estado de la solicitud
            $stmt = $this->pdo->prepare('UPDATE solicitudes_amistad SET estado = ? WHERE id_solicitud = ?');
            $stmt->execute(["aceptada", $id_solicitud]);
    
            // Insertar la amistad en la tabla amistades
            $stmt = $this->pdo->prepare('INSERT INTO amistades (id_usuario1, id_usuario2) VALUES (?, ?)');
            $stmt->execute([$id_emisor, $id_receptor]);
    
            echo "Solicitud de amistad aceptada.";
        } else {
            echo "Solicitud no encontrada o ya procesada.";
        }
    }
    */

    function rechazarSolicitudAmistad($id_solicitud)
    {
        $stmt = $this->pdo->prepare('UPDATE solicitudes_amistad SET estado = ? WHERE id_solicitud = ?');
        $stmt->execute(["rechazada", $id_solicitud]);

        if ($stmt->affected_rows > 0) {
            echo "Solicitud de amistad rechazada.";
        } else {
            echo "Solicitud no encontrada o ya procesada.";
        }
    }    

}
