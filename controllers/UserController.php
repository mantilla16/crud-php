<?php
/**
 * Modelo para manejar a los usuarios
 * Este modelo se encarga de realizar las operaciones CRUD (Crear, Leer, Actualizar, Eliminar) sobre la tabla de usuarios en la base de datos.
 * Utilizamos la clase UserModel para interactuar con la base de datos y realizar las operaciones necesarias.
 */
require_once __DIR__.'/../models/UserModel.php';

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
     * Se llama al metodo createUser del modelo UserModel para crear un nuevo usuario.
     * Se pasan los parámetros necesarios como el nombre y correo.
     */
    if ($accion === 'crear') {
        UserModel::createUser($_POST['nombre'], $_POST['correo']);
        header('Location: ../views/index.php');
    }

    /**
     * Se llama al método updateUser del modelo UserModel para actualizar un usuario existente.
     * Se pasan los parámetros necesarios como el ID, nombre y correo.
     */
    if ($accion === 'editar') {
        UserModel::updateUser($_POST['id'], $_POST['nombre'], $_POST['correo']);
        header('Location: ../views/index.php');
    }

    /**
     * Se llama al método deleteUser del modelo UserModel para eliminar un usuario existente.
     * Se pasa el ID del usuario a eliminar.
     */
    if ($accion === 'eliminar') {
        UserModel::deleteUser($_POST['id']);
        header('Location: ../views/index.php');
    }
}
?>
