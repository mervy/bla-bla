# Sistema de Login (PHP + MariaDB)

Projeto de autenticação feito **do zero**, em **PHP OOP com namespaces**, usando estrutura **MVC**:

- Composer (autoload PSR-4)
- Templates no padrão Plates
- Banco **MariaDB** via PDO
- Arquivo **.env** sem libs extras (loader próprio)

## Requisitos

- PHP 8.2+ (compatível com 8.5)
- Composer
- MariaDB

## Instalação

```bash
cp .env.example .env
composer dump-autoload
```

## Banco de dados

Crie o banco e rode o schema:

```bash
mysql -u root -p login_app < database/schema.sql
```

Tabela `users` com:
- `name`
- `username` (único)
- `email` (único)
- `password`
- `created_at`
- `update_at`

## Executar

```bash
php -S localhost:8000 -t public
```

## Estrutura MVC

- `public/index.php`: bootstrap mínimo
- `src/App.php`: inicialização da aplicação
- `config/routes.php`: todas as rotas
- `src/Controller`: controllers
- `src/Model`: modelos de domínio e acesso a dados
- `views`: templates

## Fluxo

- `/register`: cadastro com `name`, `username`, `email`, `password`
- `/login`: autenticação por `email` + `password`
- `/dashboard`: rota protegida
- `/logout`: encerra sessão
