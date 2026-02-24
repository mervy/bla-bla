<?php

declare(strict_types=1);

namespace App\Service;

use App\Core\Session;
use App\Entity\User;
use App\Repository\UserRepository;

final class AuthService
{
    public function __construct(private readonly UserRepository $users)
    {
    }

    /** @return array{ok:bool,error?:string} */
    public function register(string $name, string $email, string $password): array
    {
        $name = trim($name);
        $email = trim($email);

        if ($name === '' || $email === '' || $password === '') {
            return ['ok' => false, 'error' => 'Preencha todos os campos.'];
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ['ok' => false, 'error' => 'E-mail inválido.'];
        }

        if (strlen($password) < 6) {
            return ['ok' => false, 'error' => 'A senha deve ter pelo menos 6 caracteres.'];
        }

        if ($this->users->findByEmail($email) instanceof User) {
            return ['ok' => false, 'error' => 'E-mail já cadastrado.'];
        }

        $hash = password_hash($password, PASSWORD_DEFAULT);
        $id = $this->users->create($name, $email, $hash);

        Session::regenerate();
        Session::set('user_id', $id);

        return ['ok' => true];
    }

    /** @return array{ok:bool,error?:string} */
    public function login(string $email, string $password): array
    {
        $email = trim($email);

        if ($email === '' || $password === '') {
            return ['ok' => false, 'error' => 'Informe e-mail e senha.'];
        }

        $user = $this->users->findByEmail($email);
        if (!$user instanceof User || !password_verify($password, $user->passwordHash)) {
            return ['ok' => false, 'error' => 'Credenciais inválidas.'];
        }

        Session::regenerate();
        Session::set('user_id', $user->id);

        return ['ok' => true];
    }

    public function logout(): void
    {
        Session::destroy();
    }

    public function user(): ?User
    {
        $id = Session::get('user_id');
        if (!is_int($id)) {
            return null;
        }

        return $this->users->findById($id);
    }

    public function check(): bool
    {
        return $this->user() instanceof User;
    }
}
