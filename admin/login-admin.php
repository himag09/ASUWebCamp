<?php 
// login
if (isset($_POST['login-admin'])) {
    include_once 'funciones/funciones.php';

    $usuario = filter_var($_POST['usuario'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
  
    try {
        $stmt=$conn->prepare("SELECT * from admins WHERE usuario = ? ");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $stmt->bind_result($id_admin, $usuario_admin, $nombre_admin, $password_admin, $editado, $nivel);
        if ($stmt->affected_rows) {
            $existe = $stmt->fetch();
            if ($existe) {
                if (password_verify($password, $password_admin)) {
                    $respuesta = array(
                        'respuesta' => 'exitoso',
                        'usuario' => $nombre_admin
                    );
                    session_start();
                    $_SESSION['usuario'] = $usuario_admin;
                    $_SESSION['nombre'] = $nombre_admin;
                    $_SESSION['nivel'] = $nivel;
                    $_SESSION['id'] = $id_admin;
                } else {
                    $respuesta = array(
                        'respuesta' => 'pass_inco'
                    );
                }
            } else {
                $respuesta = array(
                    'respuesta' => 'no_existe'
                );
            }
        }
        $stmt-> close();
        $conn->close();

    } catch (Exception $e) {
        echo "error" . $e->getMessage();
    }
    die(json_encode($respuesta));

}
?>