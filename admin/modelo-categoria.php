<?php
    include_once 'funciones/funciones.php';
if (isset($_POST['registro'])) {
    // nuevo registro
    if ($_POST['registro'] == 'nuevo') {
        $nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
        $icono = filter_var($_POST['icono'], FILTER_SANITIZE_STRING);
        
        try {
            $stmt=$conn->prepare("INSERT INTO categoria_evento (cat_evento, icono) VALUES (?,?) ");
            $stmt->bind_param("ss", $nombre, $icono);
            $stmt->execute();
            $id_registro = $stmt->insert_id;
            if ($id_registro > 0) {
                $respuesta = array(
                    'respuesta' => 'exito',
                    'id_categoria' => $id_registro
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
        $nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
        $icono = filter_var($_POST['icono'], FILTER_SANITIZE_STRING);
        $id_categoria = filter_var($_POST['id_registro'], FILTER_SANITIZE_NUMBER_INT);

        try {
                $stmt = $conn->prepare("UPDATE categoria_evento SET cat_evento = ?, icono = ?, editado = NOW() WHERE id_categoria = ?");
                $stmt->bind_param("ssi", $nombre, $icono, $id_categoria);
                $stmt->execute();
            if ($stmt->affected_rows > 0) {
                $respuesta = array(
                    'respuesta' => 'exito',
                    'id_actualizado' => $id_categoria
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
            $stmt=$conn->prepare("DELETE FROM admins WHERE id_admin = ? ");
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