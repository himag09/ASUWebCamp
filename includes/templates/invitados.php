
<section class="seccion contenedor clearfix">

    <?php 
        try {
            require_once('includes/functions/db_conexion.php');
            $sql = "SELECT * FROM `invitados` ";
            $resultado = $conn->query($sql);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    ?>
    <section class="invitados contenedor seccion">
        <h2>Nuestros Invitados</h2>
        
       <?php while( $invitados = $resultado->fetch_assoc() ) { ?>

            <ul class="lista-invitados clearfix">
                <li>
                    <div class="invitado">
                    <a class="invitado-info" href="#<?php echo $invitados['invitado_id']; ?>">
                        <img src="img/invitados/<?php echo $invitados['url_imagen']; ?>" alt="imagen invitado" class="cboxNormal">
                        <p><?php echo $invitados['nombre_invitado'] . " " .$invitados['apellido_invitado']; ?></p>
                    </a>
                    </div>
                </li>
                <div style="display:none;">
                    <div class="invitado-info" id="<?php echo $invitados['invitado_id']; ?>">
                        <h2><?php echo $invitados['nombre_invitado'] . " " . $invitados['apellido_invitado']; ?></h2>
                    <img src="img/invitados/<?php echo $invitados['url_imagen']; ?>" alt="imagen invitado" class="cboxAgrandado">
                        <p><?php echo $invitados['descripcion']; ?></p>
                    </div>

                </div>  
            <?php }//while invitados ?>
        </ul> <!-- lista invitados -->
    </section><!-- invitados -->
    
    <?php $conn->close(); ?>
      
</section>


