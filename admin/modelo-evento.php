<?php
    include_once 'funciones/funciones.php';
if (isset($_POST['registro'])) {
    // nuevo evento
    if ($_POST['registro'] == 'nuevo') {
        $titulo = filter_var($_POST['titulo_evento'], FILTER_SANITIZE_STRING);
        $categoria_id = filter_var($_POST['categoria_evento'], FILTER_SANITIZE_STRING);
        $invitado_id = filter_var($_POST['invitado'], FILTER_SANITIZE_STRING);
        //obtener fecha
        $fecha = $_POST['fecha_evento'];
        $fecha_formateada = date('Y-m-d', strtotime($fecha)); 
        // obtener hora 
        $hora_evento = $_POST['hora_evento'];
        
        try {
            $stmt=$conn->prepare("INSERT INTO eventos (nombre_evento, fecha_evento, hora_evento, id_cat_evento, id_inv) VALUES (?,?,?,?,?) ");
            $stmt->bind_param("sssii", $titulo, $fecha_formateada, $hora_evento, $categoria_id, $invitado_id);
            $stmt->execute();
            $id_registro = $stmt->insert_id;
            if ($stmt->affected_rows) {
            // if ($id_registro > 0) {
                $respuesta = array(
                    'respuesta' => 'exito',
                    'id_insertado' => $id_registro
                );
            } else {
                $respuesta = array(
                    'respuesta' => 'error',
                    'num_error' => $stmt->errno
                );
            }
            $stmt-> close();
            $conn->close();

        } catch (Exception $e) {
            echo "error" . $e->getMessage();
        }
        die(json_encode($respuesta));
    }
    // actualizar registro
    if ($_POST['registro'] == 'actualizar') {
        $id_registro = filter_var($_POST['id_registro'], FILTER_SANITIZE_STRING);
        $titulo = filter_var($_POST['titulo_evento'], FILTER_SANITIZE_STRING);
        $categoria_id = filter_var($_POST['categoria_evento'], FILTER_SANITIZE_STRING);
        $invitado_id = filter_var($_POST['invitado'], FILTER_SANITIZE_STRING);
        //obtener fecha
        $fecha = $_POST['fecha_evento'];
        $fecha_formateada = date('Y-m-d', strtotime($fecha)); 
        // obtener hora 
        $hora_evento = $_POST['hora_evento'];
        
        try {

            $stmt = $conn->prepare("UPDATE eventos SET nombre_evento = ?, fecha_evento = ?, hora_evento = ?, id_cat_evento = ?, id_inv = ?, editado = NOW() WHERE evento_id = ? ");
            $stmt ->bind_param("sssiii", $titulo, $fecha_formateada, $hora_evento, $categoria_id, $invitado_id, $id_registro);
            $stmt->execute();
            if ($stmt->affected_rows) {
                $respuesta = array(
                    'respuesta' => 'exito',
                    'id_actualizado' => $id_registro
                );
            } else {
                $respuesta = array(
                    'respuesta' => 'error'
                );
            }
            $stmt->close();
            $conn->close();
        } catch (Exception $e) {
            $respuesta = array(
                'respuesta' => $e->getMessage()
            );
        }
        die(json_encode($respuesta));

    }
    if ($_POST['registro'] == 'eliminar') {
        $id_borrar = $_POST['id'];
        try {
            $stmt=$conn->prepare("DELETE FROM eventos WHERE evento_id = ? ");
            $stmt->bind_param("i", $id_borrar);
            $stmt->execute();
            if ($stmt->affected_rows) {
                $respuesta = array(
                    'respuesta' => 'exito',
                    'id_eliminado' => $id_borrar
                );
            } else {
                $respuesta = array(
                    'respuesta' => 'error' 
                );
            }
            $stmt->close();
            $conn->close();
        } catch (Exception $e) {
            $respuesta = array(
                'respuesta' => $e->getMessage()

            );
        }
        die(json_encode($respuesta));
    }
}
 
?>