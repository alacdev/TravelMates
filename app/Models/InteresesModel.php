<?php

declare(strict_types=1);

namespace Com\TravelMates\Models;

class InteresesModel extends \Com\TravelMates\Core\BaseDbModel
{
    
    /**
     * Devuelve todos los intereses.
     *
     * @return array
     */
    function obtenerTodos(): array
    {
        $stmt = $this->pdo->query('SELECT * FROM intereses');
        return $stmt->fetchAll();
    }
    
    /**
     * Devuelve los intereses del usuario pasado como parámetro.
     *
     * @param  mixed $id_usuario
     * @return void
     */
    function obtenerInteresesPorIdUsuario(int $id_usuario)
    {
        $sql = "SELECT i.interes FROM intereses i JOIN intereses_usuarios iu ON i.id = iu.id_interes WHERE iu.id_usuario = :id_usuario";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':id_usuario' => $id_usuario
        ]);
        
        return $stmt->fetchAll();
    }

    
    /**
     * Añade un el interes al usuario.
     *
     * @param  mixed $id_usuario
     * @param  mixed $id_interes
     * @return void
     */
    function addInteresUsuario(int $id_usuario, int $id_interes)
    {
        $sql = "INSERT INTO intereses_usuarios (id_usuario, id_interes) VALUES (:id_usuario, :id_interes)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':id_usuario' => $id_usuario,
            ':id_interes' => $id_interes
        ]);
    }
    
    /**
     * Elimina el interes del usuario
     *
     * @param  mixed $id_usuario
     * @return void
     */
    function eliminarInteresesUsuario(int $id_usuario)
    {
        $sql = "DELETE FROM intereses_usuarios WHERE id_usuario = :id_usuario";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':id_usuario' => $id_usuario
        ]);
    }
}
