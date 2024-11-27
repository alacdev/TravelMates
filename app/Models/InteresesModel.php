<?php

declare(strict_types=1);

namespace Com\TravelMates\Models;

class InteresesModel extends \Com\TravelMates\Core\BaseDbModel {

    function obtenerTodos(): array {
        $stmt = $this->pdo->query('SELECT * FROM intereses');
        return $stmt->fetchAll();
    }

    function addInteresUsuario (int $id_usuario, int $id_interes) {
        $sql = "INSERT INTO intereses_usuarios (id_usuario, id_interes) VALUES (:id_usuario, :id_interes)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':id_usuario' => $id_usuario,
            ':id_interes' => $id_interes
        ]);
    }

    function eliminarInteresesUsuario (int $id_usuario) {
        $sql = "DELETE FROM intereses_usuarios WHERE id_usuario = :id_usuario";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':id_usuario' => $id_usuario
        ]);
    }
}
