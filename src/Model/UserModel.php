<?php

declare(strict_types=1);

namespace App\Model;

use PDO;

final class UserModel
{
    public function __construct(private readonly PDO $pdo)
    {
    }

    public function findByEmail(string $email): ?User
    {
        $stmt = $this->pdo->prepare('SELECT id, name, username, email, password FROM users WHERE email = :email LIMIT 1');
        $stmt->execute(['email' => $email]);
        $row = $stmt->fetch();

        if (!is_array($row)) {
            return null;
        }

        return new User((int) $row['id'], $row['name'], $row['username'], $row['email'], $row['password']);
    }

    public function findByUsername(string $username): ?User
    {
        $stmt = $this->pdo->prepare('SELECT id, name, username, email, password FROM users WHERE username = :username LIMIT 1');
        $stmt->execute(['username' => $username]);
        $row = $stmt->fetch();

        if (!is_array($row)) {
            return null;
        }

        return new User((int) $row['id'], $row['name'], $row['username'], $row['email'], $row['password']);
    }

    public function findById(int $id): ?User
    {
        $stmt = $this->pdo->prepare('SELECT id, name, username, email, password FROM users WHERE id = :id LIMIT 1');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();

        if (!is_array($row)) {
            return null;
        }

        return new User((int) $row['id'], $row['name'], $row['username'], $row['email'], $row['password']);
    }

    public function create(string $name, string $username, string $email, string $password): int
    {
        $stmt = $this->pdo->prepare('INSERT INTO users (name, username, email, password) VALUES (:name, :username, :email, :password)');
        $stmt->execute([
            'name' => $name,
            'username' => $username,
            'email' => $email,
            'password' => $password,
        ]);

        return (int) $this->pdo->lastInsertId();
    }
}
