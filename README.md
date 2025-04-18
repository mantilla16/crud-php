# Sistema de Gestión de Suscripciones ING. ALBERTO MANTILLA 

Se realizo un desarrollo en **PHP**, **MySQL** y **JavaScript**, para gestionar usuarios, planes y subscripciones a una tienda de musica de alta resolución.

## Tecnologías utilizadas

- PHP (backend)
- MySQL (base de datos)
- JavaScript (interactividad en el frontend)
- HTML5 / CSS3

## Estructura del proyecto
----CRUD
    |
    |----Controllers
    |    |
    |    |--PlanesSusController.php
    |    |--SuscripcionesController.php
    |    |--UserController.php
    |
    |----Core
    |    |
    |    |--DataBase.php
    |
    |----Models
    |    |
    |    |--PlanesSusModel.php
    |    |--SuscripcionesModel.php
    |    |--UserModel.php
    |
    |----Public
    |    |
    |    |Dockerfile
    |    |index.php
    |    |planes.php
    |    |suscripciones.php
    |    |--script.js
    |    |--styles.css
    |
    |----Views



CONTROLLERS:
Aquí se encuentran los controladores, encargados de recibir peticiones del usuario, procesar datos (generalmente usando los modelos) y decidir qué vista mostrar.

`PlanesSusController.php`: Controlador que maneja la lógica de los planes de suscripción. Se comunica con el modelo de planes y pasa la información necesaria a las vistas.

`SuscripcionesController.php`: Controlador principal para gestionar las suscripciones de los usuarios. Obtiene los datos desde el modelo y los muestra en la vista correspondiente.

`UserController.php`: Controlador para manejar las acciones relacionadas con los usuarios, como listar o modificar usuarios suscritos.

CORE:
Carpeta que contiene funcionalidades centrales o reutilizables para todo el proyecto.

`DataBase.php`: Clase que gestiona la conexión con la base de datos usando mysqli o PDO. Esta clase puede ser utilizada por los modelos para ejecutar consultas SQL.


MODELS:
Aquí están los modelos, que se encargan de interactuar directamente con la base de datos.

`PlanesSusModel.php`: Modelo que contiene funciones para consultar, insertar, actualizar o eliminar planes de suscripción.

`SuscripcionesModel.php`: Modelo que maneja todo lo relacionado con la tabla de suscripciones en la base de datos.

`UserModel.php`: Modelo encargado de gestionar los datos de los usuarios.

PUBLIC:
Contiene archivos accesibles desde el navegador, como scripts JS o hojas de estilo CSS.

`script.js`: Archivo JavaScript que incluye la lógica del frontend, como el cálculo automático de fechas de finalización basado en el plan seleccionado.

`styles.css`: Archivo de estilos CSS para personalizar la apariencia del sistema.

VIEWS:
Contiene los archivos PHP que actúan como vistas, encargados de mostrar la interfaz al usuario.

`index.php`: Página de inicio o panel principal del sistema.

`planes.php`: Vista donde se listan, crean o editan los planes de suscripción.

`suscripciones.php`: Vista principal para registrar y gestionar las suscripciones de los usuarios.

