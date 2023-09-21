
# About Church Management System
    Es una aplicación web para iglesias que gestiona las actividades administrativas de la iglesia.
    Gestiona las asistencias de la iglesia, colecciones, miembros, eventos, anuncios.
    también incluye mensajería por correo electrónico, análisis de asistencia, recaudación, miembros, etc.

# Installation

## Clone project
```bash
git clone https://github.com/Cvelal/ProyectoSeminario.git
```
## Install Composer Dependencies
```bash
composer install
```
## Create Environment File
## No realizar este paso
```bash
cp .env.example .env
```
## Configure Environment File
/ .env
```
APP_NAME=CMS
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cms
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"
```
## Generate App Key
```bash
php artisan key:generate
```
## Create Database
...
## Migrate Database Tables
```bash
php artisan migrate
```

## Running Server
```bash
php artisan serve
```
