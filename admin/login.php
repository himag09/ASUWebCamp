<?php 
      session_start();
      if (isset($_GET['cerrar_sesion'])) {
        $cerrar_sesion = $_GET['cerrar_sesion'];
        if ($cerrar_sesion) {
          session_destroy();
        }
      }
      include_once 'templates/header.php';
      include_once 'funciones/funciones.php';
?>
<body class="hold-transition login-page">
  
  <div class="login-box">
    <div class="login-logo">
      <a href="../index.php"><b>ASU</b>WebCamp</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Inicia Sesión aquí</p>
        <form method="POST" action="login-admin.php" name="login-admin-form" id="login-admin">
        <div class="input-group mb-3">
          <input type="email" name="usuario" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <!-- <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div> -->
          <!-- /.col -->
          <div class="col-xs-4">
            <input type="hidden" name="login-admin" value="1">
            <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
</body>


<?php include_once 'templates/footer.php' ?>

