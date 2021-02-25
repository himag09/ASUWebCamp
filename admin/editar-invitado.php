<?php 
include_once 'funciones/sesiones.php';
  $id = $_GET['id'];
  if (!filter_var($id, FILTER_VALIDATE_INT)) {
    die("Error");
  }
include_once 'templates/header.php';
include_once 'funciones/funciones.php';
include_once 'templates/barra.php';
include_once 'templates/navegacion.php';
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edita un invitado 
              </h1>
              <small>Llena el formulario para editar un invitado </small>
          </div>
          <div class="col-sm-6">
          </div>
        </div>
        <div class="row">
          <div class="col-md-8">
            <!-- Main content -->
            <section class="content">
        
              <!-- Default box -->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Editar Invitado</h3>

                </div>
                <div class="card-body">
                <?php 
                  $sql = "SELECT * FROM invitados WHERE invitado_id = $id";
                  $resultado = $conn->query($sql);
                  $invitado = $resultado->fetch_assoc();
                ?>
                
                  <form method="POST" action="modelo-invitado.php" name="guardar-registro" id="guardar-registro-archivo" enctype="multipart/form-data">
                          <div class="card-body">
                              <div class="form-group">
                                <label for="nombre_invitado">Nombre:</label>
                                <input type="text" class="form-control" id="nombre_invitado" name="nombre_invitado" placeholder="Nombre Invitado" value="<?php echo $invitado['nombre_invitado']; ?>">
                              </div>
                              <div class="form-group">
                                <label for="apellido_invitado">Apellido:</label>
                                <input type="text" class="form-control" id="apellido_invitado" name="apellido_invitado" placeholder="Apeliido Invitado" value="<?php echo $invitado['apellido_invitado']; ?>">
                              </div>
                              <div class="form-group">
                                <label for="biografia_invitado">Biografía:</label>
                                <textarea class="form-control" name="biografia_invitado" row=8 placeholder="Biografía" id="biografia_invitado" ><?php echo $invitado['descripcion']; ?></textarea>
                              </div>
                              <div class="form-group">
                                <label for="imagen_actual">Imagen actual:</label>
                                <br>
                                <img src="../img/invitados/<?php echo $invitado['url_imagen']; ?>"  class="img-thumbnail w-25">
                              </div>
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" id="imagen_invitado" name="archivo_imagen" >
                                <label class="custom-file-label" for="imagen_invitado">Elige una imagen</label>
                              </div>
                              
                      
                          </div>
                          <!-- /.card-body -->
        
                          <div class="card-footer">
                            <input type="hidden" name="registro" value="actualizar">
                            <input type="hidden" name="id_registro" value="<?php echo $invitado['invitado_id']; ?>">
                            <button type="submit" class="btn btn-primary" id="crear_registro">Añadir</button>
                          </div>
                   </form>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
        
            </section>
            <!-- /.content -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

  </div>
  <!-- /.content-wrapper -->

 <?php include_once 'templates/footer.php' ?>

