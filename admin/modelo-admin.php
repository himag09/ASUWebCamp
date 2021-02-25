<?php
    include_once 'funciones/funciones.php';
if (isset($_POST['registro'])) {
    // nuevo registro
    if ($_POST['registro'] == 'nuevo') {
        $usuario = filter_var($_POST['usuario'], FILTER_SANITIZE_STRING);
        $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
        $nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
        
        
        
        $options = array(
            'cost' => 11
        );
        $password_hashed = password_hash($password, PASSWORD_BCRYPT, $options);
        try {
            $stmt=$conn->prepare("INSERT INTO admins (usuario, nombre, password) VALUES (?,?,?) ");
            $stmt->bind_param("sss", $usuario, $nombre, $password_hashed);
            $stmt->execute();
            $id_registro = $stmt->insert_id;
            // if ($stmt->affected_rows) {
            if ($id_registro > 0) {
                $respuesta = array(
                    'respuesta' => 'exito',
                    'id_admin' => $id_registro
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
        $usuario = filter_var($_POST['usuario'], FILTER_SANITIZE_STRING);
        $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
        $nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
        $id_admin = filter_var($_POST['id_registro'], FILTER_SANITIZE_NUMBER_INT);
        try {
            if (empty($_POST['password'])) {
                $stmt = $conn->prepare("UPDATE admins SET usuario = ?, nombre = ?, editado = NOW() WHERE id_admin = ?");
                $stmt->bind_param("ssi", $usuario, $nombre, $id_admin);
            } else {
                $options = array(
                    'cost' => 11
                );
                $hash_password = password_hash($password, PASSWORD_BCRYPT, $options);
                $stmt = $conn->prepare("UPDATE admins SET usuario = ?, nombre = ?, password = ?, editado = NOW() WHERE id_admin = ? ");
                $stmt->bind_param("sssi", $usuario, $nombre, $hash_password, $id_admin);
            }
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                $respuesta = array(
                    'respuesta' => 'exito'
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
            $stmt=$conn->prepare("DELETE FROM categoria_evento WHERE categoria_idd = ? ");
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