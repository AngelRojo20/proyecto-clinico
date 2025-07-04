# 🧪 Proyecto: Gestión de Muestras Biológicas

Este proyecto es una aplicación web desarrollada con Laravel, TypeScript y Docker para gestionar muestras biológicas recolectadas a pacientes por parte de técnicos del laboratorio clínico.

## 🚀 Funcionalidad

La aplicación permite registrar, consultar y actualizar la información relacionada con:

- 🧍‍♂️ Pacientes (con tipo y número de documento, nombres, apellidos, fecha de nacimiento, sexo, dirección y teléfono).
- 🧑‍🔬 Técnicos encargados del procesamiento o recolección de muestras.
- 🧪 Muestras biológicas (tipo, fecha de recolección, estado y observaciones).

## 🧱 Estructura de Entidades

- `TipoDocumento`: Identifica el tipo de documento (Cédula, Pasaporte, etc.)
- `Paciente`: Datos personales y de contacto del paciente.
- `Tecnico`: Personal del laboratorio.
- `TipoMuestra`: Categorías de muestras (sangre, orina, etc.)
- `Estado`: Estado de la muestra (pendiente, procesada, descartada, etc.)
- `Muestra`: Registro que relaciona paciente, técnico, tipo de muestra y estado.

## ⚙️ Tecnologías utilizadas

- Laravel 12
- TypeScript + Vite
- Docker y Docker Compose
- MariaDB
- PhpMyAdmin
- Blade (sistema de plantillas)
- Bootstrap (estilizado básico)

## 🐳 Instrucciones para levantar el proyecto con Docker

1. Clona este repositorio:

git clone https://github.com/usuario/nombre-repo.git
cd nombre-repo

2. Copia el archivo de entorno y genera la clave de aplicación:

cp .env.example .env
docker-compose exec app php artisan key:generate

3. Levanta los servicios con Docker Compose:

docker-compose up -d --build

4. Instala las dependencias y compila los assets (desde dentro del contenedor):

docker exec -it laravel_app bash
composer install
npm install
npm run dev

5. Corre las migraciones y seeders:

php artisan migrate:fresh --seed

6. Accede a la app en:

* Aplicación web: http://localhost

* PhpMyAdmin: http://localhost:8081

    * Servidor: mariadb
    * Usuario: user
    * Contraseña: secret

## 📂 Estructura básica del código

* app/Models/: Modelos de Eloquent
* app/Http/Controllers/: Controladores del CRUD
* resources/views/: Vistas Blade
* routes/web.php: Rutas web
* database/seeders/: Seeders con datos iniciales
