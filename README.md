## Local installation

- Copy `.env.example` to `.env`
- Run `docker compose up -d` to up containers
- Run `docker compose exec app composer install` to install composer packages
- Run `docker compose exec app php artisan migrate` to migrate database schema
- Run `docker compose exec app php artisan jwt:secret` to generate JWT secret
- Add next line to your `/etc/hosts` file: `127.0.0.1   codebase.localhost`

Application is available on `http://codebase.localhost`. <br>
API docs is available on `http://codebase.localhost/docs/api`
