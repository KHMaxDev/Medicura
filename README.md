# Medicura

Plataforma de gestión médica construida con Laravel 11 y MySQL/MariaDB. Permite administrar doctores, pacientes, instituciones, medicamentos, citas y tratamientos, con paneles separados para administradores y doctores.

## Requisitos

- PHP 8.2 o superior con `pdo_mysql`
- Composer 2
- MySQL 8 o MariaDB 10.4 o superior
- XAMPP, Laragon o un servidor MySQL local equivalente
- Node.js 20 o superior (solo si se compilan assets)

## Base de datos local

Inicia MySQL desde el panel de control de XAMPP y crea la base de datos:

```powershell
C:\xampp\mysql\bin\mysql.exe -u root -e "CREATE DATABASE IF NOT EXISTS medicura CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

La conexión local predeterminada es:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=medicura
DB_USERNAME=root
DB_PASSWORD=
```

## Instalación

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
php artisan serve
```

La aplicación queda disponible en `http://localhost:8000`.

## Credenciales de ejemplo

| Perfil | Correo | Contraseña |
| --- | --- | --- |
| Administrador | `admin@medicura.local` | `Admin#2026` |
| Administrador secundario | `admin2@medicura.local` | `Admin#2026` |
| Doctor | `doctor@medicura.local` | `Doctor#2026` |
| Paciente | `paciente@medicura.local` | `Paciente#2026` |
| Cuidador | `cuidador@medicura.local` | `Cuidador#2026` |

Los doctores adicionales usan `doctor02@medicura.local` hasta `doctor20@medicura.local` con la contraseña `Doctor#2026`. Los pacientes adicionales usan `paciente02@medicura.local` hasta `paciente20@medicura.local` con la contraseña `Paciente#2026`.

Cambia estas contraseñas antes de exponer la aplicación fuera de tu equipo.

## Datos sembrados

El seeder crea:

- 2 administradores
- 20 doctores
- 20 pacientes
- 1 cuidador
- 20 instituciones
- 20 medicamentos
- 40 relaciones doctor-paciente
- 40 citas
- 20 tratamientos

## Rutas principales

| Ruta | Descripción |
| --- | --- |
| `/` | Página pública y formulario de contacto |
| `/login` | Inicio de sesión |
| `/registro` | Registro de doctores (requiere aprobación) |
| `/recuperar-contrasena` | Solicitud de enlace de recuperación |
| `/admin` | Panel administrativo |
| `/doctor` | Panel del doctor |
| `/api/health` | Estado del servicio |

Los paneles están protegidos por autenticación y middleware de rol. Los doctores solo pueden consultar y modificar la información de sus pacientes asignados.

## Estructura

```text
app/
  Http/Controllers/Admin/      Controladores del panel administrativo
  Http/Controllers/Doctor/     Controladores del panel del doctor
  Http/Controllers/Auth/       Autenticación y recuperación de contraseña
  Http/Requests/               Validación de formularios
  Http/Middleware/             Control de acceso por rol
  Models/                      Modelos Eloquent
  Policies/                    Autorización por propietario
  Services/                    Lógica de citas, pacientes, reportes y contraseñas
database/
  migrations/                  Esquema MySQL
  seeders/                     Datos de ejemplo
resources/views/
  admin/                       Vistas del panel administrativo
  doctor/                      Vistas del panel del doctor
  auth/                        Login, registro y recuperación
  layouts/                     Layouts y componentes compartidos
  pdf/                         Plantillas de reportes PDF
```

Tablas principales: `users`, `institutions`, `medicines`, `appointments`, `treatments` y `doctor_patient`.

## Comandos útiles

```bash
php artisan migrate:fresh --seed
php artisan db:seed
php artisan route:list
php artisan view:cache
php artisan config:clear
php artisan test
```

## Notas de seguridad

- Las contraseñas se almacenan con `Hash::make`.
- Los enlaces de recuperación son firmados y temporales.
- Las solicitudes de doctores requieren aprobación administrativa.
- No se envían contraseñas por correo.
- Mantén `.env` fuera del control de versiones y rota cualquier credencial expuesta.
