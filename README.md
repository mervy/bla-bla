# Sistema de Login (PHP + MariaDB)

Projeto de autenticação feito **do zero**, em **PHP OOP com namespaces**, usando:

- Composer (autoload PSR-4)
- Templates com **Plates**
- Banco **MariaDB** via PDO
- Arquivo **.env** sem libs extras (loader próprio)

## Requisitos

- PHP 8.2+ (compatível com 8.5)
- Composer
- MariaDB

## Instalação

```bash
cp .env.example .env
composer install
```

Configure seu `.env` com acesso ao banco.

## Banco de dados

Crie o banco e rode o schema:

```bash
mysql -u root -p login_app < database/schema.sql
```

## Executar localmente

```bash
php -S localhost:8000 -t public
```

Acesse:

- `http://localhost:8000/register` para criar conta
- `http://localhost:8000/login` para autenticar
- `http://localhost:8000/dashboard` para área logada

## Estrutura

- `public/index.php`: front controller + rotas
- `src/`: camadas OOP (Core, Controller, Service, Repository)
- `views/`: templates Plates
- `database/schema.sql`: estrutura inicial

## Segurança aplicada

- Hash de senha com `password_hash`
- Verificação com `password_verify`
- Regeneração de sessão após login/cadastro
- Escape de saída no template
