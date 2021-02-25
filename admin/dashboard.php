<?php 
include_once 'funciones/sesiones.php';
include_once 'templates/header.php';
include_once 'templates/barra.php';
include_once 'templates/navegacion.php';
include_once 'funciones/funciones.php';

?>


  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dashboard</h1>
            <!-- <small>Información del evento</small> -->
          </div>
          <div class="col-sm-6">
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
            <div class="row">
              <div class="card-body">
              <div id="lineChart" style="height: 250px;"></div>
              </div>
            </div>

          <h2 class="page-header">Resumen de Registros</h2>
          <div class="row">
            <div class="col-lg-3 col-6">
              <?php 
                $sql= "SELECT COUNT(ID_Registrado) AS registros FROM registrados ";
                $resultado = $conn->query($sql);
                $registrados = $resultado->fetch_assoc();
              ?>
              <div class="small-box bg-info">
                <div class="inner">
                  <h3><?php echo $registrados['registros']; ?></h3>
                    
                  <p>Total registrados</p>
                </div>
                <div class="icon">
                  <i class="fas fa-user"></i>
                </div>
                <a href="lista-registrado.php" class="small-box-footer">
                  Más información <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>

            <div class="col-lg-3 col-6">
              <?php 
                $sql= "SELECT COUNT(ID_Registrado) AS registros FROM registrados WHERE pagado=1";
                $resultado = $conn->query($sql);
                $registrados = $resultado->fetch_assoc();
              ?>
              <div class="small-box bg-info bg-yellow">
                <div class="inner">
                  <h3><?php echo $registrados['registros']; ?></h3>
                    
                  <p>Total pagados</p>
                </div>
                <div class="icon">
                  <i class="fas fa-users"></i>
                </div>
                <a href="#" class="small-box-footer">
                  Más información <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>

            <div class="col-lg-3 col-6">
              <?php 
                $sql= "SELECT COUNT(ID_Registrado) AS registros FROM registrados WHERE pagado=0";
                $resultado = $conn->query($sql);
                $registrados = $resultado->fetch_assoc();
              ?>
              <div class="small-box bg-info bg-red">
                <div class="inner">
                  <h3><?php echo $registrados['registros']; ?></h3>
                    
                  <p>Total sin pagar</p>
                </div>
                <div class="icon">
                  <i class="fas fa-user-times"></i>
                </div>
                <a href="#" class="small-box-footer">
                  Más información <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>

            <div class="col-lg-3 col-6">
              <?php 
                $sql= "SELECT SUM(total_pagado) AS ganancias FROM registrados WHERE pagado=1";
                $resultado = $conn->query($sql);
                $registrados = $resultado->fetch_assoc();
              ?>
              <div class="small-box bg-info bg-green">
                <div class="inner">
                  <h3><?php echo (float) $registrados['ganancias']; ?></h3>
                    
                  <p>Ganancias Totales</p>
                </div>
                <div class="icon">
                  <i class="fas fa-dollar-sign"></i>
                </div>
                <a href="#" class="small-box-footer">
                  Más información <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
          </div>
      <!-- /.card -->
        <h2 class="page-header">Regalos</h2>
        <div class="row">
          <div class="col-lg-3 col-6">
              <?php 
                $sql= "SELECT COUNT(total_pagado) AS pulsera FROM registrados WHERE regalo=1";
                $resultado = $conn->query($sql);
                $regalo = $resultado->fetch_assoc();
              ?>
            <div class="small-box bg-info bg-dark"">
              <div class="inner">
                <h3><?php echo $regalo['pulsera']; ?></h3>
                <p>Pulseras</p>
              </div>
              <div class="icon">
                <i class="fas fa-gift"></i>
              </div>
              <a href="#" class="small-box-footer">
                Más información <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
                    <?php 
                      $sql= "SELECT COUNT(total_pagado) AS etiqueta FROM registrados WHERE regalo=2";
                      $resultado = $conn->query($sql);
                      $regalo = $resultado->fetch_assoc();
                    ?>
                    <div class="small-box bg-info bg-light">
                      <div class="inner">
                        <h3><?php echo $regalo['etiqueta']; ?></h3>
                        
                        <p>Etiquetas</p>
                      </div>
                      <div class="icon">
                        <i class="fas fa-gift"></i>
                      </div>
                      <a href="#" class="small-box-footer">
                        Más información <i class="fas fa-arrow-circle-right"></i>
                      </a>
                    </div>
          </div>
          <div class="col-lg-3 col-6">
            <?php 
              $sql= "SELECT COUNT(total_pagado) AS pluma FROM registrados WHERE regalo=3";
              $resultado = $conn->query($sql);
              $regalo = $resultado->fetch_assoc();
            ?>
            <div class="small-box bg-info bg-blue">
              <div class="inner">
                <h3><?php echo $regalo['pluma']; ?></h3>
                  
                <p>Plumas</p>
              </div>
              <div class="icon">
                <i class="fas fa-gift"></i>
              </div>
              <a href="#" class="small-box-footer">
                Más información <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
        </div>

  </section>
    <!-- /.content -->
</div>
  <!-- /.content-wrapper -->

 <?php include_once 'templates/footer.php' ?>

