<?php include_once 'includes/templates/header.php'; ?>

    <section class="seccion contenedor">
        <h2>Registro de Usuarios</h2>
        <form action="validar_registro.php" class="registro" id="registro" method="POST">
            <div id="datos_usario" class="registro caja clearfix">
                <div class="campo">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Tu Nombre">
                </div>
                <div class="campo">
                    <label for="apellido">Apellido:</label>
                    <input type="text" id="apellido" name="apellido" placeholder="Tu Apellido">
                </div>
                <div class="campo">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" placeholder="Tu email">
                </div>
                <div id="error"></div> 
                
            </div><!--datos_usuario-->
            <div class="paquetes" id="paquetes">
                <h3>Elije el numero de boletos</h3>
                <ul class="lista-precios clearfix">
                    <li>
                    <div class="tabla-precio">
                        <h3>Pase por día (viernes)</h3>
                        <p class="numero">$30</p>
                        <ul>
                        <li><i class="fas fa-check"></i>Bocadillos Gratios</li>
                        <li><i class="fas fa-check"></i>Todas las conferencias del día</li>
                        <li><i class="fas fa-check"></i>Todos los talleres del día</li>
                        </ul>
                        <div class="orden">
                            <label for="pase_dia">Boletos deseados:</label>
                            <input type="number" id="pase_dia" name="boletos[]" value="" min="0" size="3" placeholder="0">
                        </div>
                    </div>
                    </li><!-- lista precio-->
                    <li>
                    <div class="tabla-precio">
                        <h3>Todos los días</h3>
                        <p class="numero">$50</p>
                        <ul>
                        <li><i class="fas fa-check"></i>Bocadillos Gratios</li>
                        <li><i class="fas fa-check"></i>Todas las conferencias</li>
                        <li><i class="fas fa-check"></i>Todos los talleres</li>
                        </ul>
                        <div class="orden">
                            <label for="pase_completo">Boletos deseados:</label>
                            <input type="number" id="pase_completo" name="boletos[]" min="0" size="3" placeholder="0">
                        </div>
                    </div>
                    </li><!-- lista precio-->
                    <li>
                    <div class="tabla-precio">
                        <h3>Pase por 2 días (11 y 12)</h3>
                        <p class="numero">$45</p>
                        <ul>
                        <li><i class="fas fa-check"></i>Bocadillos Gratios</li>
                        <li><i class="fas fa-check"></i>Todas las conferencias de los 2 días</li>
                        <li><i class="fas fa-check"></i>Todos los talleres de los 2 días</li>
                        </ul>
                        <div class="orden">
                            <label for="pase_dosdias">Boletos deseados:</label>
                            <input type="number" id="pase_dosdias" name="boletos[]" min="0" size="3" placeholder="0">
                            
                        </div>
                    </div>
                    </li><!-- lista precio-->
                </ul>
            </div> <!--paquetes-->

            <div id="eventos" class="eventos clearfix">
                <h3>Elije tus talleres</h3>
                <div class="caja">
                    <?php 
                        try {
                            require_once('includes/functions/db_conexion.php');
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
                        
                        <div id="<?php echo str_replace($no_permitido, $permitido, $dia); ?>" class="contenido-dia clearfix">
                            <h4><?php echo $dia; ?></h4>
                            <?php foreach ($eventos as $tipo => $evento_dia) { ?>
                            
                                <div>
                                    <p><?php echo $tipo; ?>:</p>
                                    <?php foreach ($evento_dia as $evento) { ?>
                                        <label>
                                            <input type="checkbox" name="registro[]" id="<?php echo $evento['id']; ?>" value="<?php echo $evento['id']; ?>">
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
                <h3>Pago y Extras</h3>
                <div class="caja clearfix">
                    <div class="extras">
                        <div class="orden">
                            <label for="camisa_evento">Camisa del evento $10 <small>(prmoción 7% dto.)</small></label>
                            <input type="number" min="0" id="camisa_evento" name="pedido_camisas" placeholder="0">
                        </div> <!--.orden-->
                        <div class="orden">
                            <label for="etiquetas">Paquete de 10 etiquetas $2 <small>(HTML5, CSS3, JavaScript, Chrome)</small></label>
                            <input type="number" min="0" id="etiquetas" name="pedido_etiquetas" placeholder="0">
                        </div> <!--.orden-->
                        <div class="orden">
                            <label for="regalo">Seleccione un regalo</label>
                            <select id="regalo" name="regalo" required>
                                <option value="" disabled selected>-Seleccione un regalo-</option>
                                <option value="3">Etiquetas</option>
                                <option value="1">Pulseras</option>
                                <option value="3">Plumas</option>
                            </select>
                        </div><!--.orden-->

                        <input type="button" id="calcular" class="button" value="Calcular">
                    </div> <!--.extras-->
                    <div class="total">
                        <p>Resumen:</p>
                        <div id="lista-productos" class="lista-productos">

                        </div>
                        <p>Total:</p>
                        <div class="suma-total" id="suma-total">

                        </div>
                        <input type="hidden" name="total_pedido" id="total_pedido">
                        <!-- kk -->
                        <input type="hidden" name="total_descuento" id="total_descuento" value="total_descuento">
                        <input type="submit" id="btnRegistro" name="submit" class="button" value="Pagar">
                    </div> <!--.total-->
                </div><!--.caja-->
            </div><!--#resumen-->
        </form>
    </section>

<?php include_once 'includes/templates/footer.php'; ?>


