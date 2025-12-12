<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# 🛡️ Proyecto Laravel: Autenticación (Breeze) + Google (Socialite)

## 📝 Resumen del Proyecto

Este proyecto es un ejemplo práctico en **Laravel** que implementa un sistema de autenticación robusto combinando dos métodos clave:

1.  **Autenticación tradicional por usuario/contraseña** (Implementado con **Laravel Breeze** - Blade Stack).
2.  **Inicio de sesión social con Google** (Implementado con **Laravel Socialite**).

El resultado final incluye un flujo completo de autenticación, un dashboard personalizado para usuarios autenticados y una página de bienvenida modificada para visitantes.

## 📦 Tecnologías y Requisitos

| Tecnología | Requisito | Notas |
| :--- | :--- | :--- |
| **PHP** | `>= 8.1` | Lenguaje de programación principal. |
| **Composer** | | Manejador de dependencias de PHP. |
| **Laravel** | Versiones 8, 9, 10+ | Las instrucciones son compatibles. |
| **Laravel Breeze** | | Scaffolding de autenticación por defecto. |
| **Laravel Socialite** | | Paquete para login con Google. |
| **Node.js / NPM** | | Necesario para compilar assets (CSS/JS). |
| **Base de datos** | (MySQL, SQLite, etc.) | Configuración necesaria en `.env`. |

## 📁 Estructura Recomendada del Proyecto
```text
proyecto-auth/
├─ app/
├─ bootstrap/
├─ config/
├─ database/
├─ resources/
│ ├─ views/
│ │ ├─ welcome.blade.php
│ │ ├─ auth/
│ │ └─ dashboard.blade.php
├─ routes/
│ └─ web.php
├─ .env
├─ composer.json
└─ README.md

```
---


# 🚀 Instalación del proyecto

## 1️⃣ Crear proyecto Laravel

```bash
composer create-project laravel/laravel proyecto-auth
cd proyecto-auth
```
---

## 2️⃣ Instalar Breeze (login usuario/contraseña)

```bash
composer require laravel/breeze --dev
php artisan breeze:install
npm install
npm run build
php artisan migrate
```
---

## 3️⃣ Agregar Login con Google (Socialite)

3.1 Instalar Socialite

```bash
composer require laravel/socialite
```
---
3.2 Configurar .env

```bash
GOOGLE_CLIENT_ID=tu_client_id
GOOGLE_CLIENT_SECRET=tu_secret
GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback
```
---
3.3 Editar config/services.php

```bash
'google' => [
    'client_id' => env('GOOGLE_CLIENT_ID'),
    'client_secret' => env('GOOGLE_CLIENT_SECRET'),
    'redirect' => env('GOOGLE_REDIRECT_URI'),
],
```
---
3.4 Crear rutas en routes/web.php

```bash
use App\Http\Controllers\GoogleController;

Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);
```
---
3.5 Crear el controlador

```bash
php artisan make:controller GoogleController
```
---
3.6 Código del controlador

```bash
<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $user = User::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'password' => bcrypt(Str::random(16)),
            ]
        );

        Auth::login($user);

        return redirect('/dashboard');
    }
}

```
## 4️⃣ Personalizar Dashboard

## 5️⃣ Personalizar Welcome