<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

#  Sistema de Gestión para Consultoría SST (Seguridad y Salud en el Trabajo)

Aplicación web desarrollada en Laravel para la gestión integral de una empresa de consultoría en Seguridad y Salud en el Trabajo (SST).
El sistema permite administrar empresas clientes, estándares documentales, auditorías, trabajos de consultoría, evidencias fotográficas y usuarios con control de roles.

---

##  Contexto del Proyecto (Consultoría SST)

Este sistema fue diseñado específicamente para una empresa de consultoría en Seguridad y Salud en el Trabajo (SST), con el propósito de centralizar la información, optimizar la gestión documental y mejorar el seguimiento de los procesos asociados al Sistema de Gestión de Seguridad y Salud en el Trabajo (SG-SST).

La aplicación permite a la consultora:

* Gestionar estándares normativos por empresa
* Controlar documentación del SG-SST
* Registrar trabajos de consultoría
* Almacenar evidencias (imágenes y archivos)
* Organizar auditorías realizadas a empresas clientes
* Controlar el acceso según roles (admin, consultor, cliente)

---

##  Objetivo del Sistema

Digitalizar y optimizar los procesos internos de una consultora SST, facilitando:

* La gestión documental normativa
* El seguimiento de empresas clientes
* El registro de trabajos de consultoría
* La trazabilidad de auditorías
* El almacenamiento de evidencias técnicas
* El acceso seguro a la información según el rol del usuario

---

##  Tecnologías Utilizadas

* PHP 8+
* Laravel (Framework MVC)
* MySQL (Base de Datos)
* Blade (Motor de plantillas)
* Laravel Eloquent ORM
* Laravel Services (Arquitectura por capas)
* Bootstrap / CSS (Interfaz)
* Storage (Gestión de archivos)

---

##  Arquitectura del Proyecto

El sistema sigue buenas prácticas de arquitectura limpia:

* Modelos (Models): Representan las entidades del sistema
* Servicios (Services): Lógica de negocio
* Controladores (Controllers): Manejo de solicitudes HTTP
* Middleware: Control de acceso por roles
* Requests: Validaciones centralizadas
* Vistas (Blade): Interfaz de usuario

Estructura por capas:

```
Controller → Service → Model → Database
```

---

##  Roles del Sistema

###  Administrador

* Gestión de usuarios
* Administración de empresas
* Subida y eliminación de estándares
* Control total del sistema

###  Consultor SST

* Registro de trabajos de consultoría
* Subida de evidencias (imágenes)
* Gestión de documentación técnica
* Seguimiento de auditorías

###  Cliente (Empresa)

* Acceso a sus estándares SST
* Descarga de documentos asignados
* Consulta de información asociada a su empresa

---

##  Módulo de Gestión Documental (Estándares SST)

Este es uno de los módulos principales del sistema, orientado al control documental exigido por el SG-SST.

### Funcionalidades:

* Subida de documentos por empresa
* Descarga de estándares por usuarios autorizados
* Eliminación segura de archivos
* Validación de formatos permitidos
* Asociación de documentos a empresas específicas

### Tipos de archivos permitidos:

* PDF
* DOC / DOCX
* XLSX
* JPG / PNG

### Flujo del módulo:

1. El administrador o consultor sube un estándar SST
2. El documento se almacena en el sistema
3. Se asocia a una empresa cliente
4. El cliente autenticado puede visualizar y descargar sus documentos
5. Se mantiene un control documental centralizado y seguro

---

##  Módulos Principales del Sistema

###  Gestión de Empresas

* Registro de empresas clientes
* Asociación con usuarios
* Control de información empresarial

###  Gestión de Auditorías

* Registro de auditorías SST
* Asociación con empresa y consultor
* Resultados y observaciones
* Seguimiento del estado de auditorías

###  Gestión de Trabajos de Consultoría

* Creación de trabajos por empresa
* Descripción de actividades realizadas
* Asociación de evidencias fotográficas

###  Gestión de Imágenes (Evidencias)

* Subida de imágenes por trabajo
* Almacenamiento en disco público
* Eliminación de evidencias
* Relación directa con trabajos de consultoría

###  Gestión de Usuarios

* Administración de roles (admin, consultor, cliente)
* Edición de roles
* Eliminación de usuarios
* Perfil de usuario autenticado

---

##  Seguridad Implementada

* Autenticación de usuarios
* Middleware para control de acceso por rol (Admin)
* Validación de formularios mediante Requests
* Protección contra Mass Assignment ($fillable)
* Ocultamiento de datos sensibles ($hidden)
* Eliminación segura de archivos del storage

---

##  Base de Datos (Entidades Principales)

* Users (Usuarios)
* Empresas
* Auditorias
* Trabajos
* Imagens (Evidencias)
* Estándares (Documentos SST)

Relaciones destacadas:

* Un usuario puede tener una empresa
* Una empresa tiene muchos estándares
* Una empresa tiene muchos trabajos
* Un trabajo tiene muchas imágenes
* Una auditoría pertenece a una empresa y a un usuario (consultor)

---

##  Instalación del Proyecto

### 1. Clonar el repositorio

```bash
git clone https://github.com/Willan79/prelabconsultores.git
cd prelabconsultores
```

### 2. Instalar dependencias

```bash
composer install
```

### 3. Configurar el archivo .env

```bash
cp .env.example .env
php artisan key:generate
```

Configurar la base de datos en el archivo `.env`:

```
DB_DATABASE=nombre_db
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Ejecutar migraciones

```bash
php artisan migrate
```

### 5. Crear enlace de almacenamiento (para archivos e imágenes)

```bash
php artisan storage:link
```

### 6. Iniciar el servidor

```bash
php artisan serve
```

---


##  Estado del Proyecto

Proyecto en desarrollo activo, enfocado en la mejora continua de:

* Arquitectura del sistema
* Gestión documental SST
* Optimización de servicios
* Seguridad y validaciones
* Escalabilidad empresarial
