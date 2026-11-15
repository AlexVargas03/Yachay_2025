# Yachay Perú

> *Cuida tu mente, protege tu mundo*

Plataforma web educativa construida en **PHP puro con arquitectura MVC** (sin frameworks). Permite a estudiantes, tutores, docentes e instituciones iniciar sesión y acceder a un panel con cursos y talleres, calendario y asistencia.

## Características

- Inicio de sesión con contraseñas cifradas (`password_hash` / `password_verify`).
- Protección **CSRF** en formularios.
- Sesiones seguras (`httponly`, `SameSite=Strict`).
- Router propio, sencillo, para rutas GET y POST.
- Acceso a datos con **PDO** y consultas preparadas.
- Roles de usuario: `alumno`, `tutor`, `docente`, `director`, `municipio`, `minedu`, `mincul`.
- Vistas de interfaz: login, página principal, perfil de usuario y talleres disponibles.

## Tecnologías

| Capa | Tecnología |
|---|---|
| Backend | PHP 8.2+ |
| Base de datos | MySQL / MariaDB (XAMPP) |
| Autoload | Composer (PSR-4) |
| Frontend | HTML, CSS, JavaScript |

## Estructura del proyecto

```
├── app/
│   ├── Config/        # Configuración (conexión a BD)
│   ├── Controllers/   # AuthController, DashboardController
│   ├── Core/          # Router, DB, Session, Auth, Csrf, View, Controller
│   ├── Models/        # User
│   └── Views/         # login, dashboard, layouts y páginas
├── database/
│   └── users.sql      # Script de creación de BD y tabla users
├── Material/          # Recursos gráficos (logo)
├── public/
│   └── index.php      # Punto de entrada (front controller)
├── routes/
│   └── web.php        # Definición de rutas
├── scripts/
│   └── seed_user.php  # Crea un usuario de prueba
└── composer.json
```

## Instalación y ejecución

**Requisitos:** PHP 8.2 o superior, Composer y MySQL (por ejemplo, el de XAMPP).

1. **Clonar el repositorio**
   ```bash
   git clone https://github.com/AlexVargas03/Yachay_2025.git
   cd Yachay_2025
   ```

2. **Generar el autoload**
   ```bash
   composer dump-autoload
   ```

3. **Crear la base de datos** (con MySQL encendido)
   ```bash
   mysql -u root < database/users.sql
   ```
   Si tu usuario o contraseña de MySQL son distintos, ajusta `app/Config/config.php`.

4. **Crear el usuario de prueba**
   ```bash
   php scripts/seed_user.php
   ```

5. **Levantar el servidor**
   ```bash
   php -S localhost:8000 -t public
   ```

6. Abrir **http://localhost:8000/login** en el navegador.

### Usuario de prueba

| Correo | Contraseña |
|---|---|
| `usuario@colegio.edu` | `Secreto123!` |

## Rutas

| Método | Ruta | Descripción |
|---|---|---|
| GET | `/login` | Formulario de inicio de sesión |
| POST | `/login` | Procesa el inicio de sesión |
| GET | `/logout` | Cierra la sesión |
| GET | `/` | Panel del usuario (requiere sesión) |

## Próximos pasos

- Conectar a rutas las vistas `PaginaPrin`, `PaginaUser` y `PaginaCurReg`.
- Recuperación de contraseña y registro de instituciones.
- Gestión de cursos, talleres y asistencia en la base de datos.

## Autor

**Alex Vargas** – [@AlexVargas03](https://github.com/AlexVargas03)
