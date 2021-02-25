<?php
    include_once 'funciones/funciones.php';
if (isset($_POST['registro'])) {
    // nuevo registro
    // $respuesta = array(
    //     'post' => $_POST,
    //     'file' => $_FILES
    // );
    // die(json_encode($respuesta));
    
    if ($_POST['registro'] == 'nuevo') {

        $nombre = filter_var($_POST['nombre_invitado'], FILTER_SANITIZE_STRING);
        $apellido = filter_var($_POST['apellido_invitado'], FILTER_SANITIZE_STRING);
        $biografia = filter_var($_POST['biografia_invitado'], FILTER_SANITIZE_STRING);

        $directorio = "../img/invitados/";
        if (!is_dir($directorio)) {
            mkdir($directorio, 0755, true);
        }
        if (move_uploaded_file($_FILES['archivo_imagen']['tmp_name'], $directorio . $_FILES['archivo_imagen']['name'])) {
            $imagen_url = $_FILES['archivo_imagen']['name'];
            $imagen_resultado = "Se subió correctamente";
        } else {
            $respuesta = array(
                'respuesta' => error_get_last
            );
        }

        try {
            $stmt=$conn->prepare("INSERT INTO invitados (nombre_invitado, apellido_invitado, descripcion, url_imagen) VALUES (?,?,?,?) ");
            $stmt->bind_param("ssss", $nombre, $apellido, $biografia, $imagen_url);
            $stmt->execute();
            $id_registro = $stmt->insert_id;
            if ($id_registro > 0) {
                $respuesta = array(
                    'respuesta' => 'exito',
                    'id_categoria' => $id_registro,
                    'resultado_imagen' => $imagen_url
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
        $nombre = filter_var($_POST['nombre_invitado'], FILTER_SANITIZE_STRING);
        $apellido = filter_var($_POST['apellido_invitado'], FILTER_SANITIZE_STRING);
        $biografia = filter_var($_POST['biografia_invitado'], FILTER_SANITIZE_STRING);

        $id_registro = $_POST['id_registro'];

        $directorio = "../img/invitados/";
        if (!is_dir($directorio)) {
            mkdir($directorio, 0755, true);
        }
        if (move_uploaded_file($_FILES['archivo_imagen']['tmp_name'], $directorio . $_FILES['archivo_imagen']['name'])) {
            $imagen_url = $_FILES['archivo_imagen']['name'];
            $imagen_resultado = "Se subió correctamente";
        } else {
            $respuesta = array(
                'respuesta' => error_get_last()
            );
        }

        try {
                if ($_FILES['archivo_imagen']['size'] > 0) {
                // con imagen
                    $stmt= $conn->prepare("UPDATE invitados SET nombre_invitado = ?, apellido_invitado = ?, descripcion = ?, url_imagen = ? WHERE invitado_id = ?");
                    $stmt->bind_param("ssssi", $nombre, $apellido, $biografia, $imagen_url, $id_registro);
                } else {
                // sin imagen 
                    $stmt= $conn->prepare("UPDATE invitados SET nombre_invitado = ?, apellido_invitado = ?, descripcion = ? WHERE invitado_id = ?");
                    $stmt->bind_param("sssi", $nombre, $apellido, $biografia, $id_registro);
                
                }
                
                $stmt->execute();
                // $registros = $stmt->affected_rows;
                $estado = $stmt->execute();

                if ($estado == true) {
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
            $stmt=$conn->prepare("DELETE FROM invitados WHERE invitado_id = ? ");
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