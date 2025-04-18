<?php

/**
 * Modelo para manejar las suscripciones
 * Este modelo se encarga de realizar las operaciones CRUD (Crear, Leer, Actualizar, Eliminar) sobre la tabla de suscripciones en la base de datos.
 * Utilizamos la clase SuscripcionesModel para interactuar con la base de datos y realizar las operaciones necesarias.
 */
require_once __DIR__.'/../models/SuscripcionesModel.php';

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

    /*
    *  Sellama al metodo crearSuscripcion del modelo SuscripcionesModel para crear una nueva suscripción.
    *  Se pasan los parámetros necesarios como el ID del usuario, ID del plan, fecha de inicio, fecha de fin y estado.
    */
    if ($accion === 'crear') {
        SuscripcionesModel::createSuscripcion($_POST['usuario_id'], $_POST['plan_id'], $_POST['fecha_inicio'], $_POST['fecha_fin'], $_POST['estado']);
        header('Location: ../public/suscripciones.php');
    }

    /**
     * Se llama al método updateSuscripcion del modelo SuscripcionesModel para actualizar una suscripción existente.
     * Se pasan los parámetros necesarios como el ID del usuario, ID del plan, fecha de inicio, fecha de fin, ID de la suscripción y estado.
     */
    if ($accion === 'editar') {
        SuscripcionesModel::updateSuscripcion($_POST['usuario_id'], $_POST['plan_id'], $_POST['fecha_inicio'], $_POST['fecha_fin'], $_POST['id'], $_POST['estado']);
        header('Location: ../public/suscripciones.php');
    }

    /*
     * Se llama al método deleteSuscripcion del modelo SuscripcionesModel para eliminar una suscripción existente.
     * Se pasa el ID de la suscripción a eliminar.
     */

    if ($accion === 'eliminar') {
        SuscripcionesModel::deleteSuscripcion($_POST['id']);
        header('Location: ../public/suscripciones.php');
    }
}
?>