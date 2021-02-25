<?php include_once 'includes/templates/header.php'; ?>

    <section class="seccion contenedor clearfix">
        <h2>Calendario de Eventos</h2>

        <?php 
            try {
                require_once('includes/functions/db_conexion.php');
                $sql = "SELECT evento_id, nombre_evento, fecha_evento, hora_evento, cat_evento, icono, nombre_invitado, apellido_invitado ";
                $sql .=" FROM eventos ";
                $sql .=" INNER JOIN categoria_evento ";
                $sql .=" ON eventos.id_cat_evento = categoria_evento.id_categoria ";
                // lo de 2 arriba: de la tabla EVENTOS y de la tabla CATEGORIA_EVENTOS, cuales columnas son las que deben ser iguales, asi se relacionan las tablas 
                $sql .=" INNER JOIN invitados ";
                $sql .=" ON eventos.id_inv = invitados.invitado_id ";
                // en  la tabla EVENTOS y en la tabla INVITADOS, cuales columnas son las que deben ser iguales
                $sql .= "ORDER BY evento_id";
                $resultado = $conn->query($sql);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        ?>

        <div class="calendario">
        
            <?php 
                $calendario = array();
            // forma recomendada de imprimir fetch_assoc
                while( $eventos = $resultado->fetch_assoc() ) { 
                    // obtiene la fecha del evento
                    $fecha = $eventos['fecha_evento'];
                    $evento = array(
                        // formateados
                        'titulo' => $eventos['nombre_evento'],
                        'fecha' => $eventos['fecha_evento'],
                        'hora' => $eventos['hora_evento'],
                        'categoria' => $eventos['cat_evento'],
                        //'icono' => 'fa' . " " . $eventos['icono'],
                        'icono' => $eventos['icono'],
                        'invitado' => $eventos['nombre_invitado'] . " " . $eventos['apellido_invitado']
                    );
                    $calendario[$fecha][] = $evento;
            ?>
                <?php } ///WHILE DE FECH_ASSOC ?>
                
                <?php // imprime todos los eventos
                // para acceder a la llave y al valor:
                    foreach($calendario as $dia =>$lista_eventos) {?>
                        <h3 class="texto1">
                            <i class="fas fa-calendar-alt"></i>
                            <?php 
                                //cambiar a español unix:
                                setlocale(LC_TIME, 'es_ES.UTF-8');
                                // para windows:
                                setlocale(LC_TIME, 'spanish');
                                //echo date no acepta cambios en la fecha 
                                // echo date("F j, Y", strtotime($dia) ); 
                                echo utf8_encode(strftime("%A, %d, %B del %Y", strtotime($dia)));
                                
                            ?>
                        </h3>
                        <?php foreach($lista_eventos as $evento) { ?>
                            <div class="dia">
                                <p class="titulo"><?php echo utf8_encode($evento['titulo']); ?></p>
                                <p class="hora">
                                    <i class="far fa-clock" aria-hidden="true"></i>
                                    <?php echo $evento['fecha'] . " " . $evento['hora']; ?>
                                </p>
                                
                                <p>
                                    <i class="<?php echo $evento['icono']; ?>" aria-hidden="trie"></i>
                                    <?php echo $evento['categoria']; ?>
                                </p>
                                <p>
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <?php echo $evento['invitado']; ?>    
                                </p>
                            </div>
                        <?php } //fin foreach eventos ?>
                    <?php } //fin foreach de dias ?>
                
        </div>  <!-- Calendario -->
        <?php $conn->close(); ?>
      
    </section>

<?php include_once 'includes/templates/footer.php'; ?>
