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
            <h1>Crear Evento 
              </h1>
              <small>Llena el formulario para crear un evento </small>
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
                  <h3 class="card-title">Crear Evento</h3>
        
                </div>
                <div class="card-body">
                  <form method="POST" action="modelo-evento.php" name="guardar-registro" id="guardar-registro">
                        <div class="card-body">
                            <div class="form-group">
                              <label for="titulo_evento">Titulo Evento:</label>
                              <input type="text" class="form-control" id="titulo_evento" name="titulo_evento" placeholder="Titulo del evento">
                            </div>

                            <div class="form-group">
                              <label for="nombre">Categoría:</label>
                                <select name="categoria_evento" class="form-control seleccionar" style="width: 100%;">
                                    <option selected="selected" disabled>-Selecciona-</option>
                                <?php 
                                    try {
                                        $sql = ("SELECT * FROM categoria_evento ");
                                        $resultado = $conn->query($sql); 
                                        while ($cat_evento = $resultado->fetch_assoc()) { ?>
                                        
                                            <option value="<?php echo $cat_evento['id_categoria']; ?>"><?php echo $cat_evento['cat_evento']; ?></option>
                                    <?php }  
                                    } catch (Excecption $e) {
                                        echo "Error:" . $e->getMessage();
                                     } 
                                ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Fecha Evento:</label>
                                <div class="input-group date" id="fechaEvento" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#fechaEvento" name="fecha_evento"/>
                                    <div class="input-group-append" data-target="#fechaEvento" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="bootstrap-timepicker">
                                <div class="form-group">
                                    <label>Hora Evento:</label>

                                    <div class="input-group date" id="timepicker" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" data-target="#timepicker" name="hora_evento"/>
                                        <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                              <label for="nombre">Invitado o Ponente:</label>
                                <select name="invitado" class="form-control seleccionar" style="width: 100%;">
                                    <option selected="selected" disabled>-Seleccione-</option>
                                <?php 
                                    try {
                                        $sql = ("SELECT invitado_id, nombre_invitado, apellido_invitado FROM invitados ");
                                        $resultado = $conn->query($sql); 
                                        while ($invitado = $resultado->fetch_assoc()) { ?>
                                        
                                            <option value="<?php echo $invitado['invitado_id']; ?>">
                                                <?php echo $invitado['nombre_invitado'] . " " . $invitado['apellido_invitado']; ?>
                                            </option>
                                    <?php }  
                                    } catch (Excecption $e) {
                                        echo "Error:" . $e->getMessage();
                                     } 
                                ?>
                                </select>
                            </div>
                      
                        </div>
                          <!-- /.card-body -->
        
                            <div class="card-footer">
                                <input type="hidden" name="registro" value="nuevo">
                                <button type="submit" class="btn btn-primary">Añadir</button>
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

