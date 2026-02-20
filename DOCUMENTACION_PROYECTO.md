# ✅ Sistema de Gestión SST para Consultoría Empresarial
## Documentación General del Proyecto

---

## ✅ Descripción del Proyecto

Esta aplicación web desarrollada en Laravel tiene como objetivo la gestión integral de una empresa de consultoría en Seguridad y Salud en el Trabajo (SST).  

El sistema permite administrar empresas clientes, auditorías, usuarios, documentos (estándares SST), trabajos e imágenes asociadas, bajo una arquitectura basada en servicios que separa la lógica de negocio del controlador.

El proyecto está diseñado siguiendo buenas prácticas de desarrollo profesional:
- Arquitectura MVC
- Capa de Servicios (Service Layer)
- Documentación técnica (PHPDoc)
- Validación centralizada
- Relaciones Eloquent optimizadas
- Seguridad en autenticación y roles

---

## ✅ Objetivo del Sistema

Desarrollar una plataforma web que permita a una empresa consultora en SST:
- Gestionar empresas clientes
- Administrar auditorías SST
- Gestionar documentos normativos (estándares)
- Controlar usuarios por roles (Admin, Consultor, Cliente)
- Registrar trabajos y evidencias (imágenes)
- Centralizar la información organizacional de forma segura

---

## ✅ Arquitectura del Proyecto

### Arquitectura utilizada:
- MVC (Model - View - Controller)
- Service Layer Pattern (Capa de Servicios)

Estructura principal:

app/
├── Models
├── Services
├── Http/
│ ├── Controllers
│ ├── Middleware
│ └── Requests
│
resources/
├── views

### Separación de responsabilidades:
- Modelos → Base de datos y relaciones
- Servicios → Lógica de negocio
- Controladores → Flujo de la aplicación
- Vistas → Interfaz de usuario (Blade)

---

## ✅ Tecnologías Utilizadas

| Tecnología | Uso |
|-----------|-----|
| Laravel | Framework Backend |
| PHP | Lógica del servidor |
| MySQL | Base de datos |
| Blade | Motor de plantillas |
| Bootstrap | Diseño responsivo |
| Storage Laravel | Gestión de archivos |

---

## ✅ Roles del Sistema

El sistema maneja control de acceso basado en roles:

- Admin → Acceso total al sistema
- Consultor → Gestión de auditorías y documentos
- Cliente → Visualización de su empresa y estándares SST

El control se implementa mediante:
- Middleware personalizado (AdminMiddleware)
- Campo `role` en el modelo User

---

##  Módulos Principales del Sistema

### ✅ Gestión de Empresas
Permite:
- Registrar empresas
- Editar información empresarial
- Asignar empresa a usuario cliente
- Eliminar empresas

Relación:
- Una empresa tiene muchas auditorías
- Una empresa tiene muchos estándares
- Una empresa pertenece a un usuario

---

### ✅ Gestión de Auditorías SST
Funcionalidades:
- Crear auditorías por empresa
- Asignar consultores
- Estado de auditoría (pendiente, en proceso, finalizada)
- Observaciones y resultados
- Paginación de auditorías

Optimización:
- Uso de eager loading (with)
- Validación robusta de datos

---

### ✅ Gestión Documental (Estándares SST)
Módulo clave del sistema SST.

Permite:
- Subida de documentos normativos
- Descarga segura de archivos
- Eliminación de archivos del storage
- Asociación de documentos por empresa

Tipos de archivos soportados:
- PDF
- DOC / DOCX
- XLSX
- Imágenes (JPG, PNG)

Almacenamiento:
storage/app/public/documentos


---

### ✅ Gestión de Usuarios
Características:
- Listado de usuarios registrados
- Edición de roles (Admin, Consultor, Cliente)
- Eliminación de usuarios
- Relación directa con empresa

Seguridad:
- Password oculto con $hidden
- Autenticación con Laravel Auth
- Protección contra asignación masiva ($fillable)

---

### ✅ Gestión de Trabajos e Imágenes
Permite:
- Registrar trabajos por empresa
- Subir múltiples imágenes
- Eliminar imágenes individuales
- Evidencia visual de actividades SST

Relaciones:
- Trabajo pertenece a Empresa
- Trabajo tiene muchas Imágenes

---

## ✅ Modelos y Relaciones (Eloquent)

### Relaciones principales:
- User → hasOne → Empresa
- Empresa → hasMany → Auditoria
- Empresa → hasMany → Estandar
- Empresa → hasMany → Trabajo
- Trabajo → hasMany → Imagen
- Auditoria → belongsTo → Empresa
- Auditoria → belongsTo → User

---

## ✅ Capa de Servicios (Service Layer)

### Servicios implementados:
- EmpresaService
- AuditoriaService
- EstandarService
- TrabajoService
- UserService

---

## ✅ Seguridad del Sistema

Medidas aplicadas:
- Middleware de administrador
- Validación de formularios
- Protección CSRF
- Sanitización de datos
- Control de acceso por rol
- Descarga segura de archivos
- Manejo de excepciones con try/catch

---

## ✅ Base de Datos (Resumen)

Tablas principales:
- users
- empresas
- auditorias
- estandars
- trabajos
- imagens

El diseño sigue normalización y relaciones foráneas.

---

## ✅ Interfaz de Usuario (Frontend)

Características:
- Diseño responsivo con Bootstrap
- Tablas dinámicas con paginación
- Formularios validados
- Panel administrativo

---

## ✅ Escalabilidad del Proyecto

El sistema está preparado para futuras mejoras como:
- API REST
- Dashboard avanzado
- Reportes SST en PDF
- Notificaciones automáticas
- Control de auditorías avanzadas
- Integración con normativas SST
