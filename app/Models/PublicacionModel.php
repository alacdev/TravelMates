<?php

declare(strict_types=1);

namespace Com\TravelMates\Models;

class PublicacionModel extends \Com\TravelMates\Core\BaseDbModel
{

    function obtenerTodas(): array
    {
        $stmt = $this->pdo->query('SELECT * FROM publicaciones ORDER BY fecha DESC');
        return $stmt->fetchAll();
    }

    function obtenerPublicaciones(): array
    {
        $stmt = $this->pdo->query('SELECT * FROM publicaciones ORDER BY fecha DESC');
        return $stmt->fetchAll();
    }

    function obtenerPublicacionesPorIdUsuario(int $id_usuario): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM publicaciones WHERE id_usuario = ? ORDER BY fecha DESC');
        $stmt->execute([$id_usuario]);
        return $stmt->fetchAll();
    }

    function verificarMeGusta(int $id_usuario, int $id_publicacion)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM me_gusta WHERE id_usuario = :id_usuario AND id_publicacion = :id_publicacion');
        $stmt->execute([
            'id_usuario' => $id_usuario,
            'id_publicacion' => $id_publicacion
        ]);

        return $stmt->fetch();
    }

    public function meGusta(int $id_usuario, int $id_publicacion)
    {
        if (!$this->verificarMeGusta($id_usuario, $id_publicacion)) {
            $stmt = $this->pdo->prepare('INSERT INTO me_gusta (id_usuario, id_publicacion) VALUES (:id_usuario, :id_publicacion)');
            $stmt->execute([
                ':id_usuario' => $id_usuario,
                ':id_publicacion' => $id_publicacion
            ]);

            return $stmt->rowCount() > 0;
        }
    }

    public function noMeGusta(int $id_usuario, int $id_publicacion)
    {
        if ($this->verificarMeGusta($id_usuario, $id_publicacion)) {
            $stmt = $this->pdo->prepare('DELETE FROM me_gusta WHERE id_usuario = :id_usuario AND id_publicacion = :id_publicacion');
            $stmt->execute([
                ':id_usuario' => $id_usuario,
                ':id_publicacion' => $id_publicacion
            ]);

            return $stmt->rowCount() > 0;
        }
    }

    public function nuevaPublicacion(string $url, int $id_usuario, string $texto, string $fecha): bool
    {
        $sql = "INSERT INTO publicaciones (url_img, id_usuario, texto, fecha) VALUES (:url_img, :id_usuario, :texto, :fecha)";
        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':url_img' => $url,
            ':id_usuario' => $id_usuario,
            ':texto' => $texto,
            ':fecha' => $fecha
        ]);

        return $stmt->rowCount() > 0;
    }
}
