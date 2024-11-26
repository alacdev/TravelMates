<?php

declare(strict_types=1);

namespace Com\TravelMates\Models;

class UsuarioModel extends \Com\TravelMates\Core\BaseDbModel {

    function obtenerTodos(): array {
        $stmt = $this->pdo->query('SELECT * FROM usuarios');
        return $stmt->fetchAll();
    }
    
    function obtenerUsuarioPorId(int $id) {
        $stmt = $this->pdo->prepare('SELECT * FROM usuarios WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    function obtenerUsuarioPorEmail(string $email) {
        $stmt = $this->pdo->prepare('SELECT * FROM usuarios WHERE email = ?');
        $stmt->execute([$email]);
        return $stmt->fetch();
    }
    
    function obtenerUsuarioPorUsername(string $username) {
        $stmt = $this->pdo->prepare('SELECT * FROM usuarios WHERE username = ?');
        $stmt->execute([$username]);
        return $stmt->fetch();
    }

    function obtenerUsuariosCompatibles (int $id_usuario) {
        $stmt = $this->pdo->prepare('SELECT intereses FROM intereses WHERE id_usuario = ?');
        $stmt->execute([$id_usuario]);
        $result = $stmt->get_result();

        $intereses_usuario = $result->fetch_all(MYSQLI_ASSOC);
        $intereses_usuario = array_column($intereses_usuario, 'interes'); // Convertir los intereses en un array simple

        $usuarios_compatibles = [];

        // Buscar usuarios con intereses similares
        foreach ($intereses_usuario as $interes) {
            $stmt = $this->pdo->prepare('SELECT id_usuario FROM intereses WHERE interes = ? AND id_usuario != ?');
            $stmt->execute([$interes, $id_usuario]);
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()) {
                $id_usuario_compatible = $row['id_usuario'];
                if (isset($usuarios_compatibles[$id_usuario_compatible])) {
                    $usuarios_compatibles[$id_usuario_compatible]++;
                } else {
                    $usuarios_compatibles[$id_usuario_compatible] = 1;
                }
            }
        }
        arsort($usuarios_compatibles)
        return $usuarios_compatibles;
    }

    function enviarSolicitudAmistad(int $id_emisor, int $id_receptor) {
        $stmt = $this->pdo->prepare('INSERT INTO solicitudes_amistad (id_emisor, id_receptor) VALUES (?, ?)');
        $stmt->execute([$id_emisor, $id_receptor]);
    
        if ($stmt->affected_rows > 0) {
            echo "Solicitud de amistad enviada.";
        } else {
            echo "Error al enviar la solicitud.";
        }
    }

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

    function buscarUsuarios(string $busqueda) {
        $busqueda = '%' . $busqueda . '%';
        $stmt = $this->pdo->prepare('SELECT * FROM usuarios WHERE username LIKE ? OR nombre_completo LIKE ?');
        $stmt->execute([$busqueda, $busqueda]);
    
        return $stmt->fetchAll();
    }
    
    
    function rechazarSolicitudAmistad($id_solicitud) {
        $stmt = $this->pdo->prepare('UPDATE solicitudes_amistad SET estado = ? WHERE id_solicitud = ?');
        $stmt->execute(["rechazada", $id_solicitud]);
        
        if ($stmt->affected_rows > 0) {
            echo "Solicitud de amistad rechazada.";
        } else {
            echo "Solicitud no encontrada o ya procesada.";
        }
    }

    function size(): int {
        $stmt = $this->pdo->query('SELECT * FROM usuarios');
        return count($stmt->fetchAll());
    }

    //TODO: Actualizar esto para añadir intereses y url_img
    function addUser(array $post): bool {
        $stmt = $this->pdo->prepare('INSERT INTO usuarios (nombre_completo, username, sexo, pass, residencia, email) values (?,?,?,?,?,?)');
        $stmt->execute([
            $post['nombre_completo'],
            $post['username'], 
            $post['sexo'],
            $post['pass'],
            $post['residencia'],
            $post['email']
        ]);
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    //TODO: Actualizar cuando haya intereses y foto de perfil
    function actualizarUsuario(int $id_usuario, array $post): bool {
        $stmt = $this->pdo->prepare('UPDATE usuario SET nombre_completo = :nombre_completo, username = :username, sexo = :sexo, pass = :pass, residencia = :residencia, email = :email WHERE id = :id_usuario');
        $stmt->execute([
            ':nombre_completo' => $post['nombre_completo'],
            ':username' => $post['username'],
            ':sexo' => $post['sexo'],
            ':pass' => $post['pass'],
            ':residencia' => $post['residencia'],
            ':email' => $post['email'],
            ':id_usuario' => $id_usuario
        ]);
        return $stmt->rowCount() > 0;
    }    

}
