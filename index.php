<?php include_once 'includes/templates/header.php'; ?>
    <section class="seccion contenedor">
      <h2>La mejor conferencia de diseño web en español</h2>
      <p>Conoce los eventos que no puede perderse este 2021 que podrían revolucionar a la industria mundial. Si tienes la oportunidad de asistir, puede ser una oportunidad única para compartir con las mentes más brillantes en desarrollo UX. Te invitamos a conocer cuáles son.</p>
    </section>

    <section class="programa">
      <div class="contenedor-video">
        <video autoplay loop poster="img/bg-talleres.jpg">
          <source src="video/video.mp4" type="video/mp4">
          <source src="video/video.webm" type="video/mp4">
          <source src="video/video.ogv" type="video/mp4">
        </video><!-- video -->
      </div> <!-- contenedor video-->
      <div class="contenido-programa">
        <div class="contenedor">
          <div class="programa-evento">
            <h2>Programa del Evento</h2>

            <?php 
            try {
                require_once('includes/functions/db_conexion.php');
                $sql = "SELECT * FROM `categoria_evento` ";
                $sql .= "ORDER BY id_categoria DESC";

                // $sql .= "ORDER BY evento_id";
                $resultado = $conn->query($sql);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        ?>
            <nav class="menu-programa">
              <!-- ->FECH_ARRAY(MY...) ES LO MISMO QUE ->fetch_assoc() ) {  -->
              <?php while($cat = $resultado->fetch_array(MYSQLI_ASSOC)) {  ?>
                
                <a href="#<?php echo strtolower($cat['cat_evento']); ?>">
                  <i class="<?php echo $cat['icono']; ?>" aria-hidden="true"></i>
                  <?php echo $cat['cat_evento']; ?>
                </a>
              <?php } ?>
            </nav>

            <?php 
            try {
                require_once('includes/functions/db_conexion.php');
                $sql = "SELECT `evento_id`, `nombre_evento`, `fecha_evento`, `hora_evento`, `cat_evento`, `icono`, `nombre_invitado`, `apellido_invitado` ";
                $sql .="FROM `eventos` ";
                $sql .="INNER JOIN `categoria_evento` ";
                $sql .="ON eventos.id_cat_evento = categoria_evento.id_categoria ";
                $sql .="INNER JOIN `invitados` ";
                $sql .="ON eventos.id_inv = invitados.invitado_id ";
                $sql .="AND eventos.id_cat_evento = 1 ";
                $sql .="ORDER BY `evento_id` LIMIT 2;";
                $sql .= "SELECT `evento_id`, `nombre_evento`, `fecha_evento`, `hora_evento`, `cat_evento`, `icono`, `nombre_invitado`, `apellido_invitado` ";
                $sql .="FROM `eventos` ";
                $sql .="INNER JOIN `categoria_evento` ";
                $sql .="ON eventos.id_cat_evento = categoria_evento.id_categoria ";
                $sql .="INNER JOIN `invitados` ";
                $sql .="ON eventos.id_inv = invitados.invitado_id ";
                $sql .="AND eventos.id_cat_evento = 2 ";
                $sql .="ORDER BY `evento_id` LIMIT 2;";
                $sql .= "SELECT `evento_id`, `nombre_evento`, `fecha_evento`, `hora_evento`, `cat_evento`, `icono`, `nombre_invitado`, `apellido_invitado` ";
                $sql .="FROM `eventos` ";
                $sql .="INNER JOIN `categoria_evento` ";
                $sql .="ON eventos.id_cat_evento = categoria_evento.id_categoria ";
                $sql .="INNER JOIN `invitados` ";
                $sql .="ON eventos.id_inv = invitados.invitado_id ";
                $sql .="AND eventos.id_cat_evento = 3 ";
                $sql .="ORDER BY `evento_id` LIMIT 2;";

            }   catch (Exception $e) {
                echo $e->getMessage();
            }
            ?>
            <?php $conn ->multi_query($sql); ?>

            <?php 
              do {
                $resultado = $conn->store_result();

                // $row = $resultado->fetch_all(MYSQLI_ASSOC);
                // fetchall no soportado
                $columnas= array();
                while ($row = $resultado->fetch_assoc()) { 
                  $columnas[] = $row;
                } ?>
                <?php $i = 0; ?>
                <?php foreach($columnas as $evento): ?>
                  <!-- solo se ejecuta en los pares 2, 4 , 6 -->
                  
                  <?php if($i % 2 == 0) { ?>
                    <div id="<?php echo strtolower($evento['cat_evento']); ?>" class="info-curso ocultar clearfix">
                  <?php } ?>
                  <div class="detalle-evento">
                  
                    <h3><?php echo mb_strtoupper(utf8_encode($evento['nombre_evento'])); ?></h3>
                    <p><i class="far fa-clock" aria-hidden="true"></i><?php echo $evento['hora_evento']; ?></p>
                    <p><i class="fas fa-calendar-alt" aria-hidden="true"></i><?php echo $evento['fecha_evento']; ?></p>
                    <p><i class="fa fa-user" aria-hidden="true"></i><?php echo $evento['nombre_invitado'] . " " . $evento['apellido_invitado']; ?></p>
                  </div><!---detalle evento-->
                  
                  <?php if($i % 2 == 1): ?>
                      <a href="calendario.php" class="button float-right">Ver Todas</a>
                     </div><!-- #talleres-->
                  <?php endif; ?>
                  <?php $i++; ?>

                <?php endforeach; ?>      
              <?php $resultado->free(); ?>
              <?php } while ($conn->more_results() && $conn->next_result()); ?>
            


           
            
          </div><!-- programa-evento-->
        </div> <!-- contenedor -->
      </div> <!-- contenido-programa -->
    </section> <!-- programa -->
    
    <?php include_once 'includes/templates/invitados.php'; ?>


    <div class="contador parallax">
      <div class="contenedor">
        <ul class="resumen-evento clearfix">
          <li><p class="numero">0</p>Invitados</li>
          <li><p class="numero">0</p>Talleres</li>
          <li><p class="numero">0</p>Días</li>
          <li><p class="numero">0</p>Conferencias</li>
        </ul>
      </div>
    </div> <!-- contador -->

    <section class="precios seccion">
      <h2>Precios</h2>
      <div class="contenedor">
        <ul class="lista-precios clearfix">
          <li>
            <div class="tabla-precio">
              <h3>Pase por día</h3>
              <p class="numero">$30</p>
              <ul>
                <li><i class="fas fa-check"></i>Bocadillos Gratios</li>
                <li><i class="fas fa-check"></i>Todas las conferencias del día</li>
                <li><i class="fas fa-check"></i>Todos los talleres del día</li>
              </ul>
              <a href="registro.php" class="button hollow">Comprar</a>
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
              <a href="registro.php" class="button">Comprar</a>
            </div>
          </li><!-- lista precio-->
          <li>
            <div class="tabla-precio">
              <h3>Pase por 2 días</h3>
              <p class="numero">$45</p>
              <ul>
                <li><i class="fas fa-check"></i>Bocadillos Gratios</li>
                <li><i class="fas fa-check"></i>Todas las conferencias de los 2 días</li>
                <li><i class="fas fa-check"></i>Todos los talleres de los 2 días</li>
              </ul>
              <a href="registro.php" class="button hollow">Comprar</a>
            </div>
          </li><!-- lista precio-->
        </ul>
      </div>
    </section>

    <div class="mapa" id="mapa">


    </div>

    <section class="seccion">
      <h2>Testimoniales</h2>
      <div class="testimoniales contenedor clearfix">
        <div class="testimonial">
          <blockquote>
            <p>
              Desde  el primero módulo que me ayudó a entender los fundamentos del desarrollo web y poder comunicarme mejor con los desarrolladores, en lo que se puede hacer o no.
            </p>
            <footer class="info-testimonial clearfix">
              <img src="img/testimonial.jpg" alt="imagen testimonial">
              <cite>Oscar Acosta Gonzalez <span>Diseñador Web en Uber</span> </cite>
            </footer>
          </blockquote>
        </div><!-- testimonial -->
        <div class="testimonial">
          <blockquote>
            <p>
              Fue mucha la seguridad que me infundió en mis conocimientos, no solo en los que ya tenía, sino en aquellos que fui aprendiendo en el en el webcamp, totalmente recomendado.
            </p>
            <footer class="info-testimonial clearfix">
              <img src="img/testimonial1.jpg" alt="imagen testimonial">
              <cite>Luis Palomino Peralta <span>Diseñador en PedidosHoy</span> </cite>
            </footer>
          </blockquote>
        </div><!-- testimonial -->
        <div class="testimonial">
          <blockquote>
            <p>
              Valio totalmente el tiempo invertido, ya que sin ello no tendría la confianza que tengo ahora para presentar mis proyectos e ideas a profesionales del rubro o en reuniones en mi trabajo.
            </p>
            <footer class="info-testimonial clearfix">
              <img src="img/testimonial2.jpg" alt="imagen testimonial">
              <cite>Omar Sanchez Gini <span>Diseñador Web independiente</span> </cite>
            </footer>
          </blockquote>
        </div><!-- testimonial -->
      </div> <!-- testimoniales -->
    </section>

    <div class="newsletter parallax">
      <div class="contenido contenedor">
        <p>regístrate al newsletter:</p>
        <h3>AsuWebCamp</h3>
        <a href="#mc_embed_signup" class="boton_newsletter button transparente">Registro</a>
      </div><!-- contenido-->
    </div> <!-- newsletter -->

    <section class="seccion">
      <h2>Faltan</h2>
      <div class="cuenta-regresiva contenedor">
        <ul class="clearfix">
          <li><p id="dias" class="numero"></p>días</li>
          <li><p id="horas" class="numero"></p>horas</li>
          <li><p id="minutos" class="numero"></p>minutos</li>
          <li><p id="segundos" class="numero"></p>segundos</li>
        </ul>
      </div> <!-- cuenta regresiva -->
    </section>

<?php include_once 'includes/templates/footer.php'; ?>