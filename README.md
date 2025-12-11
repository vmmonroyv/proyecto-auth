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

```text
ejercicio-4/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── PlayersController.php    # Controlador para jugadores
│   │       ├── SportsController.php     # Controlador para deportes
│   │       └── TeamsController.php      # Controlador para equipos
│   └── Models/
│       ├── Player.php                # Modelo para jugadores
│       ├── Sport.php                 # Modelo para deportes
│       └── Team.php                  # Modelo para equipos
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php           # Plantilla base
│       ├── players/
│       │   ├── create.blade.php        # Vista para crear jugador
│       │   ├── edit.blade.php          # Vista para editar jugador
│       │   └── index.blade.php         # Vista general de jugador
│       ├── sports/
│       │   ├── create.blade.php        # Vista para crear deporte
│       │   ├── edit.blade.php          # Vista para editar deporte
│       │   └── index.blade.php         # Vista general de deporte
│       ├── teams/
│       │   ├── create.blade.php        # Vista para crear equipo
│       │   ├── edit.blade.php          # Vista para editar equipo
│       │   └── index.blade.php         # Vista general de equipo
│       └── index.blade.php             # Dashboard principal
└── routes/
    └── web.php                         # Rutas web del sistema

```
---