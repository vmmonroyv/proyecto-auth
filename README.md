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
---

## 🚀 Pasos para la Creación y Configuración (Comandos Exactos)

Ejecuta los siguientes comandos en tu terminal.

### 1. Crear Proyecto Laravel e Inicializar Git

```bash
# Crear proyecto Laravel
composer create-project laravel/laravel proyecto-auth
cd proyecto-auth

# Inicializar Git
git init
git add .
git commit -m "chore: initial project setup"
# Nota: Este es el commit Inicial sugerido antes de instalar dependencias adicionales.
2. Instalar Laravel Breeze (Auth Usuario/Contraseña)Bash# Instalar Breeze
composer require laravel/breeze --dev

# Instalar scaffolding (Blade Stack por defecto)
php artisan breeze:install

# Instalar dependencias frontend y compilar
npm install
npm run build    # O `npm run dev` para desarrollo
php artisan migrate
✅ Commit sugerido:Bashgit add .
git commit -m "feature: user/password authentication using Breeze"
3. Instalar y Configurar Socialite (Login con Google)3.1. Instalar DependenciaBashcomposer require laravel/socialite
3.2. Configuración de Credenciales de GoogleAccede a Google Cloud Console → Credentials.Crea un OAuth 2.0 Client ID.Añade el Redirect URI necesario (Ejemplo: http://localhost:8000/auth/google/callback).3.3. Configurar .envAñade las credenciales obtenidas al archivo .env:Fragmento de códigoGOOGLE_CLIENT_ID=tu_client_id
GOOGLE_CLIENT_SECRET=tu_client_secret
GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback
3.4. Agregar Servicio en config/services.phpAñade este bloque al array $services:PHP// config/services.php

'google' => [
    'client_id' => env('GOOGLE_CLIENT_ID'),
    'client_secret' => env('GOOGLE_CLIENT_SECRET'),
    'redirect' => env('GOOGLE_REDIRECT_URI'),
],
3.5. Definir Rutas en routes/web.phpAñade las rutas de redirección y callback, asegurando el uso del controlador:PHP// routes/web.php

use App\Http\Controllers\GoogleController;

Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);
3.6. Crear e Implementar GoogleControllerBashphp artisan make:controller GoogleController
Copia la siguiente implementación mínima en app/Http/Controllers/GoogleController.php:PHP<?php

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
                'password' => bcrypt(Str::random(16)), // Generar password obligatorio
            ]
        );

        Auth::login($user);

        return redirect()->intended('/dashboard');
    }
}
✅ Commit sugerido:Bashgit add .
git commit -m "feature: google authentication via Socialite"
4. Personalización de Vistas4.1. Agregar Botón de Login con GoogleEdita resources/views/auth/login.blade.php para incluir el enlace:Blade<a href="{{ route('google.login') }}" class="btn">Iniciar con Google</a>
4.2. Personalizar DashboardModifica resources/views/dashboard.blade.php para mostrar contenido personalizado:Blade<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Bienvenido, {{ Auth::user()->name }}</h2>
    </x-slot>
    </x-app-layout>
✅ Commit sugerido:Bashgit add .
git commit -m "feature: customized dashboard for authenticated users"
4.3. Modificar Página de BienvenidaSustituye el contenido de resources/views/welcome.blade.php por una vista para visitantes:Blade<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bienvenido</title>
</head>
<body>
  <h1>Bienvenido a la app</h1>
  <p>Información para visitantes.</p>
  <a href="{{ route('login') }}">Iniciar sesión</a>
  <a href="{{ route('register') }}">Registrarse</a>
</body>
</html>
✅ Commit sugerido:Bashgit add .
git commit -m "feature: custom welcome page for guests"
🛠️ Comandos Útiles para DesarrolloComandoDescripciónphp artisan serve --host=0.0.0.0 --port=8000Ejecutar servidor local de Laravel.php artisan migrateEjecutar las migraciones pendientes.npm run buildCompilar assets para producción.npm run devCompilar assets en modo desarrollo/vigilancia.🌟 Buena Práctica de Commits SugeridaPara mantener un historial de Git limpio y descriptivo, se recomienda la siguiente secuencia de commits:chore: initial project setupfeature: user/password authentication using Breezefeature: google authentication via Socialitefeature: customized dashboard for authenticated usersfeature: custom welcome page for guestsdocs: add project documentation in README.md🔐 Notas de SeguridadSecretos: No guardes CLIENT_SECRET ni claves privadas en commits públicos. El archivo .env debe estar en el .gitignore.Gestión de Cuentas: Considera agregar validaciones extra en el callback de Socialite (ej., bloquear dominios, vincular cuentas existentes) según las políticas de tu aplicación.📤 Subir a GitHubUna vez completado, sube tu proyecto a un repositorio remoto:Bashgit remote add origin [https://github.com/tu_usuario/proyecto-auth.git](https://github.com/tu_usuario/proyecto-auth.git)
git push -u origin main
📝 LicenciaEste repositorio usa la licencia MIT por defecto.Autor: Victor M.