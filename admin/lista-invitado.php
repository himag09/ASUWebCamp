<?php 
include_once 'funciones/sesiones.php';
include_once 'templates/header.php';
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
            <h1>Listado de Invitados</h1>
          </div>
          <div class="col-sm-6">
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Administra la lista de invitados y su información aquí</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="registros" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Biografía</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                      try {
                        include_once 'funciones/funciones.php';
                        $sql = ("SELECT * FROM invitados ");
                        $resultado = $conn->query($sql);
                      } catch (Exception $e) {
                          $error = $e->getMessage();
                          echo $error;
                      }
                      
                      while ($invitado = $resultado->fetch_assoc() ) { ?>
                        <tr>
                          
                          <td><?php echo $invitado['nombre_invitado'] . " " . $invitado['apellido_invitado'] ; ?></td>
                          <td><?php echo $invitado['descripcion']; ?></td>
                          <td> <img src="../img/invitados/<?php echo $invitado['url_imagen']; ?>" width="150px"></td>
                          <td>
                            <a href="editar-invitado.php?id=<?php echo $invitado['invitado_id']; ?>" class="btn bg-orange margin p-2">
                              <i class="fas fa-edit text-white "></i>
                            </a>
                            <a href="#" data-id="<?php echo $invitado['invitado_id']; ?>" data-tipo="invitado" class="btn bg-maroon margin p-2 borrar_registro">
                              <i class="fas fa-trash text-white"></i>
                            </a>
                          </td>
                        </tr>
                      <?php } ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Nombre</th>
                    <th>Biografía</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 <?php include_once 'templates/footer.php' ?>

