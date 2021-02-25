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
            <h1>Editar Categoría 
              </h1>
              <small>Puedes editar los datos de la categoría aquí </small>
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
                  <h3 class="card-title">Editar Categoría</h3>
                </div>
                <div class="card-body">
                  <?php 
                  $sql = "SELECT * FROM `categoria_evento` WHERE `id_categoria` = $id";
                  $resultado = $conn->query($sql);
                  $categoria = $resultado->fetch_assoc();
                  ?>
                  
                  <!-- form start --> 
                  <form method="POST" action="modelo-categoria.php" name="guardar-registro" id="guardar-registro">
                  <div class="card-body">
                              <div class="form-group">
                                <label for="nombre">Nombre categoría:</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Categoría" value="<?php echo $categoria['cat_evento']; ?>">
                              </div>

                            <div class="form-group">
                              <label for="icono">Seleccionar icono:</label>
                              <div class="input-group">
                                
                                  <span class="input-group-text"><i id="iconoid" class="<?php echo $categoria['icono']; ?>"></i></span>
                                  <input type="text" id="icono" name="icono" class="form-control pull-right" placeholder="fa-icon">
                              </div>
                            </div>
                        
                          </div>
                          <!-- /.card-body -->
        
                          <div class="card-footer">
                            <input type="hidden" name="registro" value="actualizar">
                            <input type="hidden" name="id_registro" value="<?php echo $id; ?>">
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

