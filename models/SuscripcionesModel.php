<?php

/**
 * Modelo para manejar las suscripciones
 * Diseñado con metodos estaticos para proporcionar funcionalidad sin necesidad de instanciar la clase.
 * 
 */

require_once __DIR__. '/../core/Database.php';

class SuscripcionesModel{

    /**
     * Obtiene todas las suscripciones de la base de datos, se incluye tambien el nombre del usuario y el nombre del plan.
     * @return mysqli_result Resultado de la consulta a la base de datos 
     */
    public static function getSuscripciones(){
        
        $db = Database::conectar();

        $sql = "SELECT 
                    s.usuario_id, s.plan_id,
                    s.id AS suscripcion_id,
                    u.nombre AS nombre_usuario,
                    p.nombre_plan AS nombre_plan,
                    s.fecha_inicio,
                    s.fecha_fin,
                    s.estado
                FROM suscripciones s
                JOIN usuarios u ON s.usuario_id = u.id
                JOIN planes_suscripcion p ON s.plan_id = p.id
                ";
        $result = $db->query($sql);
        return $result;
    }

    /**
     * Crea una nueva suscripcion en la base de datos, se inserta el id del usuario, el id del plan, la fecha de inicio, la fecha de fin y el estado.
     * @return bool True si la insercion fue exitosa, false en caso contrario
     * 
     */

    public static function createSuscripcion($id_usuario, $id_plan, $fecha_inicio, $fecha_fin, $estado){
        $db = Database::conectar();
        $sql = "INSERT INTO suscripciones (usuario_id, plan_id, fecha_inicio, fecha_fin, estado) VALUES (?, ?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("iisss", $id_usuario, $id_plan, $fecha_inicio, $fecha_fin, $estado);
        return $stmt->execute();
    }

    /**
     * Actualiza una suscripcion existente en la base de datos, se actualizan el id del usuario, el id del plan, la fecha de inicio, la fecha de fin y el estado.
     * @return bool True si la actualizacion fue exitosa, false en caso contrario
     */
    public static function updateSuscripcion($id_usuario, $id_plan, $fecha_inicio, $fecha_fin, $id, $estado){
        $db = Database::conectar();
        $sql = "UPDATE suscripciones SET usuario_id=?, plan_id=?, fecha_inicio=?, fecha_fin=?, estado=? WHERE id=?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("iisssi", $id_usuario, $id_plan, $fecha_inicio, $fecha_fin, $estado, $id);
        return $stmt->execute();

    }

    /**
     * Elimina una suscripcion de la base de datos, se elimina la suscripcion con el id especificado.
     * @return bool True si la eliminacion fue exitosa, false en caso contrario.
     */
    public static function deleteSuscripcion($id){
        $db = Database::conectar();
        $sql = "DELETE FROM suscripciones WHERE id=?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>