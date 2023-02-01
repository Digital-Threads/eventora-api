# API

-   [Development](#development)
-   [Production](#production)
-   [Installation](#installation)
-   [HTTP](#http)
-   [Console](#console)
-   [Testing](#testing)

For composer platform requirements run `composer check-platform-reqs` command.

## Development

For development purposes use `.dev/docker-compose.yml`.

-   Enter `.dev` directory
-   Copy `.env.example` to `.env` & configure local ports
-   Build containers using `docker-compose build` command
-   Add `api.test` as a local hosts record (optional)
-   Run containers using `docker-compose up -d` command
-   Follow the [Installation](#installation) guide

**NOTE:** All development containers are recreating production environment as close as possible, prefer to use them for development instead of a custom setup!

**NOTE:** Application `.env.example` & `.env.testing.example` are initially compatible with development containers!

## Production

For production purposes use `Dockerfile` provided in the project root dir.

-   Setup [Application environment](#application-environment)
-   Run `docker build -t api .` to build the container
-   Run `docker run -p {PORT}:80 --rm api` to run the container

### Commands

-   `docker build -t api .` - Build production container
-   `docker run -d -p {PORT}:80 --rm api` - Run production container at specified port
-   `docker ps | grep mam-api | awk '{ print $1 }' | xargs docker stop` - Stop production container

## Installation

-   Run `composer install` command.
-   Setup [Application environment](#application-environment)
-   Run `php artisan install` command

### Application environment

Copy `.env.example` file to `.env` in the root folder, see [Laravel Environment Configuration Documentation](https://laravel.com/docs/9.x/configuration#environment-configuration) for more detailed information.

#### Required configurations

-   [Database configuration](https://laravel.com/docs/9.x/database#configuration)
-   [Cache configuration](https://laravel.com/docs/9.x/cache#configuration)
-   [File Storage configuration](https://laravel.com/docs/9.x/filesystem#configuration)
-   [Mail configuration](https://laravel.com/docs/9.x/mail#configuration)
-   [Queue driver prerequisites](https://laravel.com/docs/9.x/queues#driver-prerequisites)

## HTTP

See the latest Swagger **API DOCUMENTATION** using `/docs` uri.

## Console

| Signature | Description                    |
| --------- | ------------------------------ |
| `install` | Fresh install the application  |
| `ci`      | Continuous integration command |

## Testing

Run `composer test` in the project root directory.

### Testing prerequisites

-   [Project dependencies installed](#installation)
-   [Database connection](https://laravel.com/docs/9.x/database)

### Manual setup

-   Copy `.env.testing.example` to `.env.testing` in project root directory.
-   Setup [Database connection configuration](https://laravel.com/docs/9.x/database#configuration)
-   Run `composer test` in project root directory.

## TODO

-   [x] Development docker-compose
-   [x] Production dockerfile
-   [x] Installation & CI
-   [x] Github Actions & Dependabot
-   [x] Default API Schemas
-   [x] Test suite
-   [x] HealthCheck
-   [ ] Sanctum authorization
-   [x] Example module
-   [ ] Extended documentation
-   [ ] Github repository template
-   [ ] Composer project template
-   [ ] Module generator commands
