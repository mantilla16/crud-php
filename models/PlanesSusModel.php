<?php
/**
 * Modelo para manejar los planes de suscripción
 * Diseñado con metodos estaticos para proporcionar funcionalidad sin necesidad de instanciar la clase.
 * 
 */
require_once __DIR__. '/../core/Database.php';


class PlanesSusModel{
    /**
     * Obtiene todos los planes de suscripción de la base de datos
     * @return mysqli_result Resultado de la consulta a la base de datos 
     */
    public static function getPlanesSus(){
        
        $db = Database::conectar();

        $sql = "SELECT * FROM planes_suscripcion";
        $result = $db->query($sql);
        return $result;
    }

    /**
     * Crea un nuevo plan de suscripción en la base de datos
     * @return bool True si la insercion fue exitosa, false en caso contrario
     */
    public static function createPlanSus($nombre, $precio, $duracion, $descripcion){
        $db = Database::conectar();
        $sql = "INSERT INTO planes_suscripcion (nombre_plan, precio, duracion_dias, descripcion) VALUES (?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("siss", $nombre, $precio, $duracion, $descripcion);
        return $stmt->execute();
    }

    /**
     * Actualiza un plan de suscripción existente en la base de datos
     * @return bool True si la actualizacion fue exitosa, false en caso contrario
     */
    public static function updatePlanSus($nombre, $precio, $duracion, $descripcion, $id){
        $db = Database::conectar();
        $sql = "UPDATE planes_suscripcion SET nombre_plan=?, precio=?, duracion_dias=?, descripcion=? WHERE id=?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("sissi", $nombre, $precio, $duracion, $descripcion, $id);
        return $stmt->execute();

    }

    /**
     * Elimina un plan de suscripción existente de la base de datos
     * @return bool True si la eliminacion fue exitosa, false en caso contrario
     */
    public static function deletePlanSus($id){
        $db = Database::conectar();
        $sql = "DELETE FROM planes_suscripcion WHERE id=?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>