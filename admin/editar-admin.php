<?php 
    include_once 'funciones/sesiones.php';
    if (isset($_GET)) {
      $id = $_GET['id'];
      // VALIDAR QUE ID SEA INT
      if (!filter_var($id, FILTER_VALIDATE_INT)) {
        die("error");
      }
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
            <h1>Editar Administrador 
              </h1>
              <small>Puedes editar los datos del administrador aquí </small>
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
                  <h3 class="card-title">Editar Administrador</h3>
                </div>
                <div class="card-body">
                  <?php 
                  $sql = "SELECT * FROM `admins` WHERE `id_admin` = $id";
                  $resultado = $conn->query($sql);
                  $admin = $resultado->fetch_assoc();
                  ?>
                  
                  <!-- form start -->
                  <form method="POST" action="modelo-admin.php" name="guardar-registro" id="guardar-registro">
                          <div class="card-body">
                            <div class="form-group">
                              <label for="inputEmail">Correo eletrónico:</label>
                              <input type="email" class="form-control" id="inputEmail" name="usuario" placeholder="Correo electrónico" value="<?php echo $admin['usuario']; ?>">
                            </div>
                            <div class="form-group">
                              <label for="nombre">Nombre:</label>
                              <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="<?php echo $admin['nombre']; ?>">
                            </div>
                            <div class="form-group">
                              <label for="password">Contraseña:</label>
                              <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña">
                            </div>
                      
                          </div>
                          <!-- /.card-body -->
        
                          <div class="card-footer">
                            <input type="hidden" name="registro" value="actualizar">
                            <input type="hidden" name="id_registro" value="<?php echo $id; ?>">
                            <button type="submit" class="btn btn-primary">Guardar</button>
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

