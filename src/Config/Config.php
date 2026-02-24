<?php

declare(strict_types=1);

namespace App\Config;

final class Config
{
    public static function appName(): string
    {
        return Env::get('APP_NAME', 'Sistema de Login') ?? 'Sistema de Login';
    }

    public static function sessionName(): string
    {
        return Env::get('SESSION_NAME', 'app_session') ?? 'app_session';
    }

    /** @return array{host:string,port:string,name:string,user:string,pass:string} */
    public static function db(): array
    {
        return [
            'host' => Env::get('DB_HOST', '127.0.0.1') ?? '127.0.0.1',
            'port' => Env::get('DB_PORT', '3306') ?? '3306',
            'name' => Env::get('DB_NAME', 'login_app') ?? 'login_app',
            'user' => Env::get('DB_USER', 'root') ?? 'root',
            'pass' => Env::get('DB_PASS', '') ?? '',
        ];
    }
}
