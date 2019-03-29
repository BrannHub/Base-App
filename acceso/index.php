<!-- === DATOS DE LA PAGINA === -->
<?php
  $titulo = "Acceso Administrativo | Garpa Facil";
?>
<!DOCTYPE html>
<html lang="es" dir="index.php">
  <head>
    <meta charset="utf-8">
    <?php include('php/head.php'); ?>
  </head>
  <body class="bg-dark">

      <div class="login-box">
        <div class="login-logo col-md-12 mt-5">
          <img src="https://i.imgur.com/oOvdOr7.png" alt="Garpa Fácil logo" class="img-fluid" style="width:20%;">
          <span>Garpa Fácil</span>
        </div>
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body login-card-body">
          <p class="login-box-msg" style="color:black;">Inicie sesión para acceder al sistema</p>

          <form method="post">
            <div class="form-group has-feedback">
              <input type="email" name="correo" class="form-control" placeholder="Correo electrónico">
            </div>
            <div class="form-group has-feedback">
              <input type="password" name="pass" class="form-control" placeholder="Contraseña">
            </div>
            <div class="row">
              <div class="col-12">
                <button type="submit" name="ingresar" class="btn btn-primary btn-block btn-flat"><i class="fa fa-arrow-right"></i> Acceder</button>
                <a href="registro.php" class="btn btn-primary btn-block btn-flat"><i class="fa fa-user-plus"></i> Registrarse</a>
                <a href="recuperar.php" class="btn btn-dark btn-block btn-flat">Olvidaste la contraseña</a>

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

  <?php include('php/footer.php'); ?>

</html>
