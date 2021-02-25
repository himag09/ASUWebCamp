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
            <h1>Listado de Eventos</h1>
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
                <h3 class="card-title">Aquí podras editar o borrar los eventos</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="registros" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Categoría</th>
                    <th>Invitado</th>
                    <th>Acciones</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                      try {
                        include_once 'funciones/funciones.php';
                        $sql = ("SELECT evento_id, nombre_evento, fecha_evento, hora_evento, cat_evento, nombre_invitado, apellido_invitado ");
                        $sql .= (" FROM eventos");
                        // INNERJOIN PARA SELECCIONAR LAS DEMAS TABLAS 
                        $sql .= (" INNER JOIN categoria_evento ");
                        // asi se hace refefrencia una tabla con la otra
                        $sql .= (" ON eventos.id_cat_evento = categoria_evento.id_categoria ");
                        $sql .= (" INNER JOIN invitados ");
                        $sql .= (" ON eventos.id_inv = invitados.invitado_id ");
                        $sql .= (" ORDER BY evento_id ");
                        $resultado = $conn->query($sql);
                      } catch (Exception $e) {
                          $error = $e->getMessage();
                          echo $error;
                      }
                      
                      while ($evento = $resultado->fetch_assoc() ) { ?>
                        <tr>
                          
                          <td><?php echo $evento['nombre_evento']; ?></td>
                          <td><?php echo $evento['fecha_evento']; ?></td>
                          <td><?php echo $evento['hora_evento']; ?></td>
                          <td><?php echo $evento['cat_evento']; ?></td>
                          <td><?php echo $evento['nombre_invitado'] . " " . $evento['apellido_invitado']?></td>
                          <td>
                            <a href="editar-evento.php?id=<?php echo $evento['evento_id']; ?>" class="btn bg-orange margin">
                              <i class="fas fa-edit text-white"></i>
                            </a>
                            <a href="#" data-id="<?php echo $evento['evento_id']; ?>" data-tipo="evento" class="btn bg-maroon margin borrar_registro">
                              <i class="fas fa-trash text-white"></i>
                            </a>
                          </td>
                        </tr>
                      <?php } ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Nombre</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Categoría</th>
                    <th>Invitado</th>
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

