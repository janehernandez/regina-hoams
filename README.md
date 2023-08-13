<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Reginaville Homeowners Management System

Web-based Management System for Regina Ville 2000 Home Owner Association (HOA). The project’s main objective is to design and develop a community
homeowners portal to let members of a homeowners association transact and access
information electronically.

## Table of Contents

-   [Requirements](#requirements)
-   [Frameworks](#frameworks)
-   [Installation](#installation)

## Requirements

-   PHP >= 8
-   Node 17
-   Laragon / XAMPP
-   MySQL

## Frameworks

-   Laravel 10
-   Vuejs 3

## Installation

1. Clone the repository:

    ```bash
    git clone https://github.com/janehernandez/regina-hoams.git
    ```

2. Navigate to the project directory:
    ```bash
    cd regina-hoams
    ```
3. Install the required dependencies using Composer::

    ```bash
    composer install
    ```

4. Set up your environment variables by copying the `.env.example` file:

    ```bash
    cp .env.example .env
    ```

5. Generate a new application key:

    ```bash
    php artisan key:generate
    ```

6. Configure your database connection in the `.env` file.

7. Run the migrations:(this will also generate a new admin user for testing)
    ```bash
    php artisan migrate --seed
    ```
8. Generate a JWT secret key:

    ```bash
    php artisan jwt:secret
    ```
