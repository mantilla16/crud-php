<?php
/**
 * Modelo para manejar los planes de suscripción
 * Este modelo se encarga de realizar las operaciones CRUD (Crear, Leer, Actualizar, Eliminar) sobre la tabla de los planes de suscripcion en la base de datos.
 * Utilizamos la clase PlanesSusModel para interactuar con la base de datos y realizar las operaciones necesarias.
 */
require_once __DIR__.'/../models/PlanesSusModel.php';


/*
 * Verifica si la solicitud es de tipo POST
 * Si es así, se procesan los datos enviados desde el formulario.
 * Dependiendo de la acción solicitada (crear, editar, eliminar), se llama al método correspondiente del modelo.
 */
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    // Verifica si se ha enviado una acción a través del formulario
    // Si no se ha enviado, asigna una cadena vacía a la variable $accion
    if (isset($_POST['accion'])) {
        $accion = $_POST['accion'];
    } else {
        $accion = '';
    }

    /** 
     *  Se llama al metodo createPlanSus del modelo PlanesSusModel para crear un nuevo plan de suscripción.
     *  Se pasan los parámetros necesarios como el nombre, precio, duración y descripción.
     */
    if ($accion === 'crear') {
        PlanesSusModel::createPlanSus($_POST['nombre'], $_POST['precio'], $_POST['duracion'], $_POST['descripcion']);
        header('Location: ../public/planes.php');
    }
    /**
     * Se llama al método updatePlanSus del modelo PlanesSusModel para actualizar un plan de suscripción existente.
     * Se pasan los parámetros necesarios como el nombre, precio, duración, descripción y ID del plan.
     */
    if ($accion === 'editar') {
        PlanesSusModel::updatePlanSus($_POST['nombre'], $_POST['precio'], $_POST['duracion'], $_POST['descripcion'], $_POST['id']);
        header('Location: ../public/planes.php');
    }

    /*
     * Se llama al método deletePlanSus del modelo PlanesSusModel para eliminar un plan de suscripción existente.
     * Se pasa el ID del plan a eliminar.
     */

    if ($accion === 'eliminar') {
        PlanesSusModel::deletePlanSus($_POST['id']);
        header('Location: ../public/planes.php');
    }
}
?>