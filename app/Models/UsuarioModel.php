<?php

declare(strict_types=1);

namespace Com\TravelMates\Models;

class UsuarioModel extends \Com\TravelMates\Core\BaseDbModel {

    function getAll(): array {
        $stmt = $this->pdo->query('SELECT * FROM usuarios');
        return $stmt->fetchAll();
    }
    
    function getUserById(int $id) {
        $stmt = $this->pdo->prepare('SELECT * FROM usuarios WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    function getUserByEmail(string $email) {
        $stmt = $this->pdo->prepare('SELECT * FROM usuarios WHERE email = ?');
        $stmt->execute([$email]);
        return $stmt->fetch();
    }
    
    function getUserByUsername(string $username) {
        $stmt = $this->pdo->prepare('SELECT * FROM usuarios WHERE username = ?');
        $stmt->execute([$username]);
        return $stmt->fetch();
    }

    function size(): int {
        $stmt = $this->pdo->query('SELECT * FROM usuarios');
        return count($stmt->fetchAll());
    }

    function addUser(array $post): bool {
        $stmt = $this->pdo->prepare('INSERT INTO usuarios (nombre_completo, username, sexo, pass, residencia, email) values (?,?,?,?,?,?)');
        $stmt->execute([
            $post['nombre_completo'],
            $post['username'], $post['sexo'],
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

}
