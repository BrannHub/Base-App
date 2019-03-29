<!-- === DATOS DE LA PAGINA === -->
<?php
  session_start();
  include("../php/conexion.php");

  if(isset($_SESSION['user'])) {
    header("Location: paginas/inicio.php");
  }

  $titulo = "Acceso Administrativo | Garpa Fácil";
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
              <input type="text" name="nombre" class="form-control" placeholder="Nombre" required>
            </div>
            <div class="form-group has-feedback">
              <input type="text" name="apellido" class="form-control" placeholder="Apellido" required>
            </div>
            <div class="form-group has-feedback">
              <input type="email" name="correo" class="form-control" placeholder="Correo electrónico" required>
            </div>
            <div class="form-group has-feedback">
              <input type="text" name="direccion" class="form-control" placeholder="Dirección" required>
              <small class="text-dark">Formato: Calle, numero, localidad, provincia</small>
            </div>
            <div class="form-group has-feedback">
              <input type="text" name="numero" class="form-control" placeholder="Numero de telefono ej: 5493517717990" required>
              <small class="text-dark">Formato: código de área + número sin 15</small>
            </div>
            <div class="form-group has-feedback">
              <input type="password" name="pass" class="form-control" placeholder="Contraseña" required>
            </div>
            <div class="row">
              <div class="col-12">
                <button type="submit" name="ingresar" class="btn btn-primary btn-block btn-flat"><i class="fa fa-user-plus"></i> Registrarse</button>
                <a href="index.php" class="btn btn-dark btn-block btn-flat"><i class="fa fa-arrow-left"></i> Volver</a>

              </div>
              <!-- /.col -->
            </div>

            <?php
              if(isset($_POST['ingresar'])) {
                $nombre = utf8_decode($_POST['nombre']);
                $apellido = utf8_decode($_POST['apellido']);
                $correo = $_POST['correo'];
                $direccion = utf8_decode($_POST['direccion']);
                $numero = $_POST['numero'];
                $contra = $_POST['pass'];
                if(preg_match("/^[0-9a-zA-Z]+$/", $nombre)
                || preg_match("/^[0-9a-zA-Z]+$/", $apellido)
                || preg_match("/^[0-9a-zA-Z]+$/", $correo)
                || preg_match("/^[0-9a-zA-Z]+$/", $direccion)
                || is_numeric($numero)
                || preg_match("/^[0-9a-zA-Z]+$/", $contra)) {
                  if($nombre != '' || $apellido != '' || $correo != '' || $direccion != '' | $numero != '' || $contra != '') {
                    $ucon = $conexion->query("SELECT * FROM usuarios WHERE correo='".$correo."'");
                    if(mysqli_num_rows($ucon) == 0) {
                      $conexion->query("INSERT INTO usuarios (nombre, apellido, correo, contrasena, direccion, numero, deposito, foto, rango, conectado) VALUES ('$nombre', '$apellido', '$correo', '$contra', '$direccion', '$numero', '0', 'https://', '0', '0')");
                      $_SESSION['user'] = $correo;
                      $conexion->query("UPDATE usuarios SET conectado='1' WHERE correo='$correo'");
                      header("Location: paginas/inicio.php");
                    } else {
                      echo '<div class="fixed-bottom">
                          <div class="alert alert-danger alert-dismissible fade show float-right" role="alert">
                            Correo electrónico ya existe
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                        </div>';
                    }
                  } else {
                    echo '<div class="fixed-bottom">
                        <div class="alert alert-danger alert-dismissible fade show float-right" role="alert">
                          Faltan campos por completar
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                      </div>';
                  }
                } else {
                  echo '<div class="fixed-bottom">
                      <div class="alert alert-danger alert-dismissible fade show float-right" role="alert">
                        Datos no validos
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    </div>';
                }
              }
            ?>

          </form>


        </div>
        <!-- /.login-card-body -->
      </div>
    </div>
    <!-- /.login-box -->

  </body>

  <?php include('php/footer.php'); ?>

</html>
