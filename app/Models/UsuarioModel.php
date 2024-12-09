<?php

declare(strict_types=1);

namespace Com\TravelMates\Models;

class UsuarioModel extends \Com\TravelMates\Core\BaseDbModel
{

    function obtenerTodos(): array
    {
        $stmt = $this->pdo->query('SELECT * FROM usuarios');
        return $stmt->fetchAll();
    }

    function obtenerUsuarioPorId(int $id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM usuarios WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    function obtenerUsuarioPorEmail(string $email)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM usuarios WHERE email = ?');
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    function obtenerUsuarioPorUsername(string $username)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM usuarios WHERE username = ?');
        $stmt->execute([$username]);
        return $stmt->fetch();
    }

    //hay que echarle un ojo a esto
    function obtenerUsuariosCompatibles(int $id_usuario)
    {
        $stmt = $this->pdo->prepare('SELECT i.interes FROM intereses i JOIN intereses_usuarios iu ON iu.id_interes = i.id WHERE iu.id_usuario = ?');
        $stmt->execute([$id_usuario]);

        $intereses_usuario = $stmt->fetchAll();
        $intereses_usuario = array_column($intereses_usuario, 'interes'); // Convertir los intereses en un array simple

        $usuarios_compatibles = [];

        // Buscar usuarios con intereses similares
        foreach ($intereses_usuario as $interes) {
            $stmt = $this->pdo->prepare('SELECT iu.id_usuario FROM intereses_usuarios iu JOIN intereses i ON i.id = iu.id_interes WHERE i.interes = ? AND iu.id_usuario != ?');
            $stmt->execute([$interes, $id_usuario]);

            while ($row = $stmt->fetch()) {
                $id_usuario_compatible = $row['id_usuario'];
                if (isset($usuarios_compatibles[$id_usuario_compatible])) {
                    $usuarios_compatibles[$id_usuario_compatible]++;
                } else {
                    $usuarios_compatibles[$id_usuario_compatible] = 1;
                }
            }
        }
        arsort($usuarios_compatibles);
        return $usuarios_compatibles;
    }

    function buscarUsuarios(int $id_usuario, string $busqueda)
    {
        $busqueda = '%' . $busqueda . '%';
        $stmt = $this->pdo->prepare('SELECT * FROM usuarios WHERE (username LIKE ? OR nombre_completo LIKE ?) AND id != ?');
        $stmt->execute([$busqueda, $busqueda, $id_usuario]);

        return $stmt->fetchAll();
    }

    function size(): int
    {
        $stmt = $this->pdo->query('SELECT * FROM usuarios');
        return count($stmt->fetchAll());
    }

    function eliminarUsuario(int $id_usuario): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM usuarios WHERE id = ?');
        $stmt->execute([$id_usuario]);
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function addUser(array $post): bool
    {
        $stmt = $this->pdo->prepare('INSERT INTO usuarios (nombre_completo, username, sexo, pass, residencia, email) values (?,?,?,?,?,?)');
        $stmt->execute([
            $post['nombre_completo'],
            $post['username'],
            $post['sexo'],
            $post['pass'],
            $post['residencia'],
            $post['email']
        ]);
        return $stmt->rowCount() > 0;
    }
    function actualizarUsuario(int $id_usuario, array $post): bool
    {
        $sql = 'UPDATE usuarios SET nombre_completo = :nombre_completo, username = :username, residencia = :residencia, email = :email';
        $params = [
            ':nombre_completo' => $post['nombre_completo'],
            ':username' => $post['username'],
            ':residencia' => $post['residencia'],
            ':email' => $post['email'],
            ':id_usuario' => $id_usuario
        ];

        if (!empty($post['pass'])) {
            $sql .= ', pass = :pass';
            $params[':pass'] = password_hash($post['pass'], PASSWORD_DEFAULT);
        }

        if (!empty($post['url_img'])) {
            $sql .= ', url_img = :url_img';
            $params[':url_img'] = $post['url_img'];
        }

        $sql .= ' WHERE id = :id_usuario';

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        return $stmt->rowCount() > 0;
    }

}
