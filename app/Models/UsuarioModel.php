<?php

declare(strict_types=1);

namespace Com\TravelMates\Models;

class UsuarioModel extends \Com\TravelMates\Core\BaseDbModel
{
    
    /**
     * Devuelve todos los usuarios de la bbdd
     *
     * @return array
     */
    function obtenerTodos(): array
    {
        $stmt = $this->pdo->query('SELECT * FROM usuarios');
        return $stmt->fetchAll();
    }
    
    /**
     * Devuelve el usuario cuyo id coincida con el pasado como parámetro
     *
     * @param  mixed $id
     * @return void
     */
    function obtenerUsuarioPorId(int $id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM usuarios WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    
    /**
     * Devuelve el usuario cuyo email coincida con el pasado como parámetro
     *
     * @param  mixed $email
     * @return void
     */
    function obtenerUsuarioPorEmail(string $email)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM usuarios WHERE email = ?');
        $stmt->execute([$email]);
        return $stmt->fetch();
    }
    
    /**
     * Devuelve el usuario cuyo nombre de usuario coincida con el pasado como parámetro
     *
     * @param  mixed $username
     * @return void
     */
    function obtenerUsuarioPorUsername(string $username)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM usuarios WHERE username = ?');
        $stmt->execute([$username]);
        return $stmt->fetch();
    }
    
    /**
     * Devuelve el/los usuario/s coincidente/s con la búsqueda que ha hecho el usuario
     *
     * @param  mixed $id_usuario
     * @param  mixed $busqueda
     * @return void
     */
    function buscarUsuarios(int $id_usuario, string $busqueda)
    {
        $busqueda = '%' . $busqueda . '%';
        $stmt = $this->pdo->prepare('SELECT * FROM usuarios WHERE (username LIKE ? OR nombre_completo LIKE ?) AND id != ?');
        $stmt->execute([$busqueda, $busqueda, $id_usuario]);

        return $stmt->fetchAll();
    }
    
    /**
     * Devuelve el número de usuarios que hay en la bbdd
     *
     * @return int
     */
    function size(): int
    {
        $stmt = $this->pdo->query('SELECT * FROM usuarios');
        return count($stmt->fetchAll());
    }
    
    /**
     * Eliminar el usuario pasado como parámetro
     *
     * @param  mixed $id_usuario
     * @return bool
     */
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
    
    /**
     * Añade un nuevo usuario con los datos de $post
     *
     * @param  mixed $post
     * @return bool
     */
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

    /**
     * Actualiza el usuario pasado como parámetro con los datos de $post
     *
     * @param  mixed $id_usuario
     * @param  mixed $post
     * @return bool
     */
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
