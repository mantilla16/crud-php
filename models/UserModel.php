<?php
/**
 * Modelo para manejar a los usuarios
 * Diseñado con metodos estaticos para proporcionar funcionalidad sin necesidad de instanciar la clase.
 * 
 */
require_once __DIR__. '/../core/Database.php';

class UserModel{

    /**
     * Obtiene todos los usuarios de la base de datos
     * @return mysqli_result Resultado de la consulta a la base de datos 
     */
    public static function getUser(){
        
        $db = Database::conectar();

        $sql = "SELECT * FROM usuarios";
        $result = $db->query($sql);
        return $result;
    }

    /**
     * Crea un nuevo usuario en la base de datos
     * @return bool True si la insercion fue exitosa, false en caso contrario
     */
    public static function createUser($nombre, $correo){
        
        $db = Database::conectar();

        $sql = "INSERT INTO usuarios (nombre, correo) VALUES (?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("ss", $nombre, $correo);
        return $stmt->execute();
        
    }
    /**
     * Actualiza un usuario existente en la base de datos
     * @return bool True si la actualizacion fue exitosa, false en caso contrario
     */
    public static function updateUser($id, $nombre, $correo){
        
        $db = Database::conectar();

        $sql = "UPDATE usuarios SET nombre = ?, correo = ? WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("ssi", $nombre, $correo, $id);
        return $stmt->execute();
        
    }

    /**
     * Elimina un usuario existente de la base de datos
     * @return bool True si la eliminacion fue exitosa, false en caso contrario
     */
    public static function deleteUser($id){
        
        $db = Database::conectar();

        $sql = "DELETE FROM usuarios WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
        
    }

}


?>