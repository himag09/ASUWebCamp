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
            <h1>Crear Registro de personas
              </h1>
              <small>Llena el formulario para crear un registro </small>
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
                  <h3 class="card-title">Crear Registro de personas</h3>
        
                </div>
                <div class="card-body">
                  <form method="POST" action="modelo-registro.php" name="guardar-registro" id="guardar-registro">
                        <div class="card-body">
                            <div class="form-group">
                              <label for="nombre">Nombre:</label>
                              <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
                            </div>
                            <div class="form-group">
                              <label for="apellido">Apellido:</label>
                              <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido">
                            </div>
                            <div class="form-group">
                              <label for="email">Email:</label>
                              <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                            </div>
                            
                            <div class="form-group">
                              <div class="paquetes" id="paquetes">
                              <div class="box-header with-border">
                                <h3 class="box-title">Elije el número de boletos</h3>
                              </div>
                                <ul class="lista-precios clearfix row">
                                    <li class="col-md-4 align-self-end">
                                      <div class="tabla-precio text-center p-1">
                                          <h3>Pase para el viernes</h3>
                                          <p class="numero">$30</p>
                                          <ul>
                                          <li class="d-flex align-items-start"><i class="fas fa-check"></i>Bocadillos Gratios</li>
                                          <li class="d-flex align-items-start"><i class="fas fa-check"></i>Conferencias del día</li>
                                          <li class="d-flex align-items-start"><i class="fas fa-check"></i>Todos los talleres del día</li>
                                          </ul>
                                          <div class="orden">
                                              <label for="pase_dia">Boletos deseados:</label>
                                              <input type="number" class="form-control" id="pase_dia" name="boletos[]" value="" min="0" size="3" placeholder="0">
                                          </div>
                                      </div>
                                    </li><!-- lista precio-->
                                    <li class="col-md-4 align-self-end">
                                    <div class="tabla-precio text-center p-1">
                                        <h3>Todos los días</h3>
                                        <p class="numero">$50</p>
                                        <ul>
                                        <li  class="d-flex align-items-start"><i class="fas fa-check"></i>Bocadillos Gratios</li>
                                        <li  class="d-flex align-items-start"><i class="fas fa-check"></i>Todas las conferencias</li>
                                        <li  class="d-flex align-items-start"><i class="fas fa-check"></i>Todos los talleres</li>
                                        </ul>
                                        <div class="orden">
                                            <label for="pase_completo">Boletos deseados:</label>
                                            <input type="number" class="form-control" id="pase_completo" name="boletos[]" min="0" size="3" placeholder="0">
                                        </div>
                                    </div>
                                    </li><!-- lista precio-->
                                    <li class="col-md-4 align-self-end">
                                    <div class="tabla-precio text-center p-1">
                                        <h3>Viernes y sábado</h3>
                                        <p class="numero">$45</p>
                                        <ul>
                                        <li class="d-flex align-items-start"><i class="fas fa-check"></i>Bocadillos Gratios</li>
                                        <li class="d-flex align-items-start"><i class="fas fa-check"></i>Conferencias de los 2 días</li>
                                        <li class="d-flex align-items-start"><i class="fas fa-check"></i>Talleres de los 2 días</li>
                                        </ul>
                                        <div class="orden">
                                            <label for="pase_dosdias">Boletos deseados:</label>
                                            <input type="number" class="form-control" id="pase_dosdias" name="boletos[]" min="0" size="3" placeholder="0">
                                            
                                        </div>
                                    </div>
                                    </li><!-- lista precio-->
                                </ul>
                              </div> <!--paquetes-->
                            </div>
                            <div class="form-group">
                              <div class="box-header with-border">
                                <h3 class="box-title">Elige los talleres</h3>
                              </div>
                              <div id="eventos" class="eventos clearfix">
                                <div class="caja">
                                    <?php 
                                        try {
                                            $sql = ("SELECT eventos.*, categoria_evento.cat_evento, invitados.nombre_invitado, invitados.apellido_invitado ");
                                            $sql .= " FROM eventos";
                                            $sql .= " JOIN categoria_evento ";
                                            $sql .= " ON eventos.id_cat_evento = categoria_evento.id_categoria ";
                                            $sql .= " JOIN invitados ";
                                            $sql .= " ON eventos.id_inv = invitados.invitado_id ";
                                            $sql .= " ORDER BY eventos.fecha_evento, eventos.id_cat_evento, eventos.hora_evento ";
                                            $resultado = $conn->query($sql);
                                        } catch (Exception $e) {
                                            echo "error" . $e->getMessage();
                                        }
                                        $eventos_dias = array();
                                        
                                        while ($eventos = $resultado->fetch_assoc()) {
                                            $fecha = $eventos['fecha_evento'];
                                            // CAMBIAR a español
                                            setlocale(LC_ALL, 'esp.UTF-8');
                                            $dia_semana = strftime("%A", strtotime($fecha));
                                            $categoria = $eventos['cat_evento'];
                                            // array con los días
                                            $dia = array(
                                                'nombre_evento' => $eventos['nombre_evento'],
                                                'nombre_invitado' => $eventos['nombre_invitado'] ." " .$eventos['apellido_invitado'],
                                                'hora' => date('H:i', strtotime($eventos['hora_evento'])),
                                                'id' => $eventos['evento_id']
                                            );
                                            $eventos_dias[$dia_semana][$categoria][] = $dia;
                                        }
                                        // echo "<pre>";
                                        //     var_dump($eventos_dias);
                                        //     echo "<pre>";
                                        $no_permitido = array("á","é","í","ó","ú");
                                        $permitido = array("a","e","i","o","u");
                                        
                                    ?>
                                    <?php foreach ($eventos_dias as $dia => $eventos) { ?>
                                        
                                        <div id="<?php echo str_replace($no_permitido, $permitido, $dia); ?>" class="contenido-dia clearfix row">
                                            <h4 class="text-center nombre_dia"><?php echo $dia; ?></h4>
                                            <?php foreach ($eventos as $tipo => $evento_dia) { ?>
                                            
                                                <div class="col-md-4 float-left">
                                                    <p><?php echo $tipo; ?>:</p>
                                                    <?php foreach ($evento_dia as $evento) { ?>
                                                        <label class="icheck-primary">
                                                            <input type="checkbox" name="registro_evento[]" id="<?php echo $evento['id']; ?>" value="<?php echo $evento['id']; ?>">
                                                            <label for="<?php echo $evento['id']; ?>"></label>
                                                            <time><?php echo $evento['hora']; ?></time> 
                                                            <?php echo $evento['nombre_evento']; ?> <br>
                                                            <span class="autor"><?php echo $evento['nombre_invitado']; ?></span>
                                                        </label>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>
                                        </div><!--#CONTENIDODIA-->
                                    <?php } ?>
                                </div><!--.caja-->
                              </div> <!-- #eventos-->
                             
                              <div id="resumen" class="resumen">
                                  <div class="box-header with-border">
                                    <br>
                                   <h3 class="box-title">Pagos y Extras</h3>
                                  </div>
                                <div class="caja clearfix row">
                                    <div class="extras col-md-6">
                                        <div class="orden">
                                            <label for="camisa_evento">Camisa del evento $10 <small>(prmoción 7% dto.)</small></label>
                                            <input type="number" class="form-control" min="0" id="camisa_evento" name="pedido_extra[camisas][cantidad]" placeholder="0">
                                            <input type="hidden" value="10" name="pedido_extra[camisas][precio]">

                                        </div> <!--.orden-->
                                        <div class="orden">
                                            <label for="etiquetas">Paquete de 10 etiquetas $2 <small>(HTML5, CSS3, JavaScript, Chrome)</small></label>
                                            <input type="number" class="form-control" min="0" id="etiquetas" name="pedido_extra[etiquetas][cantidad]" placeholder="0">
                                            <input type="hidden" value="10" name="pedido_extra[etiquetas][precio]">

                                        </div> <!--.orden-->
                                        <div class="orden">
                                            <label for="regalo">Seleccione un regalo</label>
                                            <select id="regalo" name="regalo" required class="form-control seleccionar">
                                                <option value="" disabled selected>-Seleccione un regalo-</option>
                                                <option value="3">Etiquetas</option>
                                                <option value="1">Pulseras</option>
                                                <option value="3">Plumas</option>
                                            </select>
                                        </div><!--.orden-->
                                        <br>
                                        <input type="button" id="calcular" class="btn btn-success" value="Calcular">
                                    </div> <!--.extras-->
                                    <div class="total col-md-6">
                                        <p>Resumen:</p>
                                        <div id="lista-productos" class="lista-productos">

                                        </div>
                                        <p>Total:</p>
                                        <div class="suma-total" id="suma-total">

                                        </div>
                                        <input type="hidden" name="total_pedido" id="total_pedido">
                                        <input type="hidden" name="total_descuento" id="total_descuento" value="total_descuento">

                                    </div> <!--.total-->
                                </div><!--.caja-->
                            </div><!--#resumen-->
                        </div>
                </div>
                <!-- /.card-body -->
        
                          <div class="card-footer">
                            <input type="hidden" name="registro" value="nuevo">
                            <button type="submit" class="btn btn-primary" id="btnRegistro">Añadir</button>
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

