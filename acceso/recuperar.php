<!-- === DATOS DE LA PAGINA === -->
<?php
  session_start();
  include("../php/conexion.php");

  if(isset($_SESSION['user'])) {
    header("Location: paginas/inicio.php");
  }

  require("../phpmailers/class.phpmailer.php");
	require("../phpmailers/class.smtp.php");

  $titulo = "Restablecer contraseña | Garpa Facil";
?>
<!DOCTYPE html>
<html lang="es" dir="index.php">
  <head>
    <meta charset="utf-8">
    <?php include('php/head.php'); ?>
  </head>
  <body class="bg-info">

      <div class="login-box">
        <div class="login-logo col-md-12 mt-5">
          <img src="https://i.imgur.com/oOvdOr7.png" alt="Garpa Fácil logo" class="img-fluid" style="width:20%;">
          <span>Garpa Fácil</span>
        </div>
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body login-card-body">
          <p class="login-box-msg" style="color:black;">Restablecer contraseña</p>
          <?php if(!isset($_GET) || empty($_GET)) { ?>
            <form method="post">
              <div class="form-group has-feedback">
                <input type="email" name="correo" class="form-control" placeholder="Correo electrónico registrado">
              </div>
              <div class="row">
                <div class="col-12">
                  <button type="submit" name="restablecer" class="btn btn-primary btn-block btn-flat mb-3 mt-3"><i class="fa fa-arrow-right"></i> Recuperar</button>
                  <a href="index.php" class="btn btn-dark btn-block btn-flat"><i class="fa fa-arrow-left"></i> Volver</a>
                </div>
                <!-- /.col -->
              </div>

              <?php
                if(isset($_POST['restablecer'])) {
                  $correo = $_POST['correo'];

                  $ucon = $conexion->query("SELECT * FROM usuarios WHERE correo='".$correo."'");
                  if(mysqli_num_rows($ucon)>0) {
                    $traera = mysqli_fetch_array($ucon);

                    $iden = rand(0, 50000000);

                    $nombre = $traera['nombre'];
                    $apellido = $traera['apellido'];

                    $mail = new PHPMailer();

                  	$mail->IsSMTP();
                  	$mail->SMTPAuth = true;
                  	$mail->Host = "mail.brannar.com"; // SMTP a utilizar. Por ej. smtp.elserver.com aca ya sabes Si lo se :v ahora se donde esta todo xd
                  	$mail->Username = "garpafacil@brannar.com"; // Correo completo a utilizar
                  	$mail->Password = "gonzalo293"; // Contraseña
                  	$mail->Port = 25; // Puerto a utilizar

                  	$mail->From = "garpafacil@brannar.com"; // Desde donde enviamos (Para mostrar)
                  	$mail->FromName = "GarpaFacil - Notificación";

                  	$mail->AddAddress($correo); // Esta es la dirección a donde enviamos
                  	$mail->AddCC("garpafacil@brannar.com"); // Copia
                  	$mail->AddBCC("garpafacil@brannar.com"); // Copia oculta
                  	$mail->IsHTML(true); // El correo se envía como HTML

                  	$mail->Subject = "GarpaFacil hola ".$nombre.""; // Este es el titulo del email.

                    $body = "<center><img style='width:100%;' src='https://i.imgur.com/4y89vUr.png'></center>";
                    $body .= "<h3 style='color: #0695d6;'>Hola ".$nombre." ".$apellido."</h3>";
                  	$body .= "<h5>Has solicitado una recuperacion de contraseña</h5>";
                    $body .= "<p>Ingrese a este enlace para recuperar su clave, si no lo solicito, solo ignore este correo electronico.</p>";
                  	$body .= "<p>Link: http://garpafacil.brannar.com/acceso/recuperar.php?correo=".$correo."&token=".$iden."</p>";


                  	$mail->Body = $body; // Mensaje a enviar
                  	$mail->AltBody = "GarpaFacil hola ".$nombre." ".$apellido.""; // Texto sin html
                  	//$mail->AddAttachment("imagenes/imagen.jpg", "imagen.jpg");
                  	$exito = $mail->Send(); // Envía el correo.

                  	if($exito) {
                      $conexion->query("INSERT INTO recuperar (correo, iden) VALUES ('$correo', '$iden')");
                      echo '<div class="fixed-bottom">
                           <div class="alert alert-success alert-dismissible fade show float-right" role="alert">
                             El correo fue enviado correctamente.
                             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                             </button>
                           </div>
                         </div>';
                  	} else {
                       echo '<div class="fixed-bottom">
                           <div class="alert alert-danger alert-dismissible fade show float-right" role="alert">
                             Hubo un inconveniente. Contacta a un administrador.
                             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                             </button>
                           </div>
                         </div>';
                  	}

                  } else {
                    echo '<div class="fixed-bottom">
                        <div class="alert alert-danger alert-dismissible fade show float-right" role="alert">
                          Correo electrónico ingresado no esta en nuestra base de datos.
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                      </div>';
                  }
                }
              ?>

            </form>
          <?php } else if(isset($_GET['correo']) || isset($_GET['token'])) { ?>
            <?php
              $rcon = $conexion->query("SELECT * FROM recuperar WHERE correo='".$_GET['correo']."' AND iden='".$_GET['token']."'");
              if(mysqli_num_rows($rcon) == 0) {
                header("Location: index.php");
              }
              $rinfo = mysqli_fetch_array($rcon);
            ?>
            <form method="post">
              <div class="form-group has-feedback">
                <input type="password" name="contra" class="form-control" placeholder="Contraseña nueva">
              </div>
              <div class="form-group has-feedback">
                <input type="password" name="ccontra" class="form-control" placeholder="Confirmar contraseña nueva">
              </div>

              <div class="row">
                <div class="col-12">
                  <button type="submit" name="cambiar" class="btn btn-primary btn-block btn-flat mb-3 mt-3">Cambiar</button>
                </div>
              </div>

              <?php
                if(isset($_POST['cambiar'])) {
                  $contra = $_POST['contra'];
                  $contra2 = $_POST['ccontra'];

                  if($contra == $contra2) {
                    $conexion->query("UPDATE usuarios SET contrasena='$contra' WHERE correo='".$_GET['correo']."'");
                    $conexion->query("DELETE FROM recuperar WHERE correo='".$_GET['correo']."' AND iden='".$_GET['token']."'");
                    echo '<div class="fixed-bottom">
                      <div class="alert alert-success alert-dismissible fade show float-right" role="alert">
                        La contraseña fue cambiada con exito.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    </div>';
                    header("Refresh: 1; URL=index.php");
                  } else {
                    echo '<div class="fixed-bottom">
                      <div class="alert alert-danger alert-dismissible fade show float-right" role="alert">
                        Las contraseñas no coinciden.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    </div>';
                  }
                }
              ?>
            </form>
          <?php } ?>
        </div>
        <!-- /.login-card-body -->
      </div>
    </div>
    <!-- /.login-box -->

  </body>

  <?php include('php/footer.php'); ?>

</html>
