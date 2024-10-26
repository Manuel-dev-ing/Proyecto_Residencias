# Proyectos de Residencias Profesionales

## Descripcion
Este sistema permite a los usuarios acceder a una base de datos donde pueden buscar soluciones a problemas cotidianos y frecuentes que suelen surgir en las sucursales. Adicionalmente, proporciona la funcionalidad para registrar nuevas incidencias que se presentan en las sucursales. Las incidencias registradas son evaluadas y gestionadas por un administrador, quien se encarga de asignar soluciones adecuadas a cada caso.

## Funcionalidades
### Dashboard Principal
  - `Resumen de Incidencias:` Visualización de las incidencias abiertas, cerradas y el total de incidencias.
  - `Gráfica por Sucursales:` Muestra la distribución de incidencias por cada sucursal, facilitando la identificación de sucursales con mayor volumen de problemas.
  - `Buscador de Incidencias:` Herramienta de búsqueda que permite a los usuarios encontrar incidencias específicas mediante palabras clave.

### Gestión de Entidades
  - `Categorías:` Administrar y actualizar las diferentes categorías para clasificar las incidencias.
  - `Usuarios:` Gestión de usuarios que pueden interactuar con el sistema y recibir asignacion de rol para clasificarlos.
  - `Prioridades:` Configurar y ajustar los niveles de prioridad para cada incidencia, optimizando el orden de resolución.
  - `Sucursales:` Administración de las sucursales para su correcta asociación con las incidencias.

### Gestión y Consulta de Incidencias
  - `Consulta de Incidencias:`
     - Los usuarios pueden visualizar sus propias incidencias y su estado actual.
     - El Departamento de TI tiene acceso a todas las incidencias y puede asignar responsables para la resolución de cada una.
  - `Detalle de la Incidencia:` Visualización detallada de cada incidencia, donde los usuarios pueden interactuar con el personal asignado por TI para recibir actualizaciones y,   finalmente, cerrar la incidencia cuando haya sido resuelta.

### Perfil de Usuario
  - `Visualización y Actualización de Perfil:` Los usuarios pueden ver y actualizar su información personal.
  - `Cambio de Contraseña:` Funcionalidad para que el usuario pueda actualizar su contraseña de acceso.

### Creación de Incidencias
  - `Registro de Incidencias:` Los usuarios pueden crear una nueva incidencia especificando:
      - `Título:` Breve descripción de la incidencia.
      - `Descripción:` Detalle completo de la situación o problema.
      - `Categoría:` Selección de una categoría relevante para el problema.
      - `Prioridad:` Definición de la urgencia de la incidencia.
      - `Documentos Adjuntos:` Opción para añadir archivos o documentos relevantes que ayuden en la resolución del problema.

## Tecnologias utilizadas
- `Backend:` PHP y MySQL.
- `Frontend:` HTML, CSS, Bootstrap, JavaScript, jQuery.

## Instalacion
Para iniciar con el proyecto bienesRaíces, existen dos métodos principales de instalación que puedes seguir según tu preferencia.
### Opción 1: Instalación con XAMPP
1. Descargar e instalar XAMPP:
  - Ve a la página oficial de XAMPP y descarga la versión compatible con tu sistema operativo.  
  - Instala y ejecuta XAMPP, asegurándote de activar Apache y MySQL desde el panel de control.
2. Configurar el Proyecto:
  - Clona el repositorio de bienesRaíces en el directorio htdocs de XAMPP. Por defecto, esto estará en C:\xampp\htdocs\bienesRaíces.
  - Abre el archivo de configuración para la conexión a la base de datos en tu proyecto (generalmente config.php o en una clase de configuración) y asegúrate de que las credenciales coincidan:
      - Host: localhost
      - Usuario: root
      - Contraseña: (dejar en blanco por defecto en XAMPP)

  3. Configurar la Base de Datos:
     - Inicia sesión en phpMyAdmin (generalmente disponible en http://localhost/phpmyadmin).
     - Crea una base de datos para el proyecto llamada bienesRaíces.
     - Importa el archivo SQL incluido en el proyecto para generar las tablas y datos iniciales.

  4. Iniciar el Servidor:
     - Accede al proyecto en el navegador desde http://localhost/bienesRaíces.

  ### Opción 2: Instalación Manual con Apache y MySQL Workbench
 
  1. Instalar Apache y MySQL:
     - Descarga e instala Apache desde la web oficial de Apache.
     - Descarga e instala MySQL Server desde la web oficial de MySQL.
     - Configura Apache para que apunte al directorio de tu proyecto. Edita el archivo httpd.conf de Apache y cambia la ruta del DocumentRoot al directorio donde se clonará el repositorio bienesRaíces.
 
 2. Instalar y Configurar MySQL Workbench:
    - Descarga e instala MySQL Workbench desde la web oficial de MySQL Workbench.
    - Inicia sesión en MySQL Workbench y crea una nueva conexión usando las credenciales configuradas en tu instalación de MySQL Server.
    - Crea una base de datos llamada bienesRaíces.
    - Importa el archivo SQL incluido en el proyecto para generar las tablas y datos iniciales.
 
 3. Configurar el Proyecto:
    - Clona el repositorio bienesRaíces en tu carpeta de documentos o en un directorio accesible para Apache.
    - Asegúrate de que las credenciales de conexión en el archivo de configuración del proyecto estén correctas para tu base de datos:
      - Host: localhost
      - Usuario: (el usuario que configuraste)
      - Contraseña: (la contraseña configurada en MySQL)
     
4. Iniciar el Servidor Apache:
   - Inicia Apache, y abre el proyecto desde http://localhost/bienesRaíces en el navegador. 

## Licencia

Proyectos de Residencias Profesionales es [MIT licensed](./LICENSE).

## Contacto
**Nombre:** Manuel Tamayo Montero.

**Correo:** manueltamayo9765@gmail.com

  
