<?php 
include_once 'funciones/sesiones.php';
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
            <h1>Crear Categorías de Eventos 
              </h1>
              <small>Llena el formulario para crear una categoria </small>
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
                  <h3 class="card-title">Crear Categoría</h3>
        
                </div>
                <div class="card-body">
                  <form method="POST" action="modelo-categoria.php" name="guardar-registro" id="guardar-registro">
                          <div class="card-body">
                              <div class="form-group">
                                <label for="nombre">Nombre categoría:</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Categoría">
                              </div>

                            <div class="form-group">
                              <label for="icono">Seleccionar icono:</label>
                              <div class="input-group">
                                  <span class="input-group-text"><i id="iconoid" class="fas fa-archive"></i></span>
                                  <input type="text" id="icono" name="icono" class="form-control pull-right" placeholder="fa-icon">
                              </div>
                            </div>
                        
                      
                          </div>
                          <!-- /.card-body -->
        
                          <div class="card-footer">
                            <input type="hidden" name="registro" value="nuevo">
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

