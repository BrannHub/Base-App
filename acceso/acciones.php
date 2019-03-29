<?php
  session_start();
  include("../php/conexion.php");

  if(!isset($_SESSION['user'])) {
    header("Location: ../index.php");
  }

  if(empty($_GET) || !isset($_GET)) {
    header("Location: paginas/inicio.php");
  }

  date_default_timezone_set('America/Argentina/Buenos_Aires');

  $url = "paginas/inicio.php?vacio";

  if($info['rango'] == 0) {

    if(isset($_GET['aviso'])) {
      $url = "paginas/notificaciones.php";

      $conexion->query("DELETE FROM notificacion WHERE iden='".$_GET['aviso']."'");
    } else if(isset($_GET['cancelar'])) {
      $url = "paginas/pendientes-envios.php";

      $econ = $conexion->query("SELECT * FROM envio WHERE iden='".$_GET['cancelar']."'");
      $einfo = mysqli_fetch_array($econ);

      $ruta = "../".$lconfig['ruta_file'];
      $archivo = $einfo['archivo'];

      if( file_exists($ruta.$archivo) ) {
          unlink($ruta.$archivo);
      }

      $conexion->query("DELETE FROM envio WHERE iden='".$_GET['cancelar']."'");
    }

  } else {

    if(isset($_GET['deposito'])) {
      $url = "paginas/depositos-pendientes.php";

      $dcon = $conexion->query("SELECT * FROM deposito WHERE iden='".$_GET['deposito']."'");
      $dinfo = mysqli_fetch_array($dcon);

      $correo = $dinfo['correo'];

      $fecha = date("h:i")." ".date("j/n/Y");

      $iden = rand(0, 10000);

      if(isset($_GET['aceptar'])) {
        $conexion->query("UPDATE deposito SET estado='1' WHERE iden='".$_GET['deposito']."'");

        $pcon = $conexion->query("SELECT * FROM usuarios WHERE correo='$correo'");
        $pinfo = mysqli_fetch_array($pcon);

        $total = $dinfo['deposito'] + $pinfo['deposito'];

        $comicon = $conexion->query("SELECT * FROM monto WHERE monto='".$dinfo['deposito']."'");
        if(mysqli_num_rows($comicon)>0) {
          $cinfo = mysqli_fetch_array($comicon);

          $comision = $total - $cinfo['comision'];

          $formato = str_replace(".", ",", $cinfo['comision']);
          $formato2 = str_replace(".", ",", $comision);

          $mensaje = "Tu deposito de ".$dinfo['deposito']."$ fue aceptado, Comision de -".$formato."$ Total ".$formato2."$";

          $conexion->query("INSERT INTO notificacion (iden, correo, mensaje, fecha, estado) VALUES ('$iden','$correo', '$mensaje', '$fecha', '0')");

          $conexion->query("UPDATE usuarios SET deposito='$comision' WHERE correo='$correo'");
        }

      } else if(isset($_GET['rechazar'])) {
        $conexion->query("UPDATE deposito SET estado='2' WHERE iden='".$_GET['deposito']."'");

        $mensaje = "Tu deposito de ".$dinfo['deposito']."$ fue rechazado.";

        $conexion->query("INSERT INTO notificacion (iden, correo, mensaje, fecha, estado) VALUES ('$iden', '$correo', '$mensaje', '$fecha', '0')");
      }
    } else if(isset($_GET['envio'])) {
      $url = "paginas/envios-pendientes.php";
      if(isset($_GET['notificar'])) {
        $econ = $conexion->query("SELECT * FROM envio WHERE iden='".$_GET['envio']."'");
        $einfo = mysqli_fetch_array($econ);

        $conteo = explode(",", $einfo['servicio']);
        $ctotal = count($conteo);

        $correo = $einfo['correo'];

        $fecha = date("h:i")." ".date("j/n/Y");

        $iden = rand(0, 10000);

        $estilo = "esta";
        $estilo2 = "la";
        $estilo3 = "factura";
        $estilo4 = "Tu";

        if($ctotal > 0) {
          $estilo = "estan";
          $estilo2 = "las";
          $estilo3 = "facturas";
          $estilo4 = "Tus";
        }

        if($_GET['notificar'] == "entregado") {
          $mensaje = $estilo4." ".$estilo3." Ya ".$estilo." en tu domicilio";
        } else {
          $mensaje = "Ya ".$estilo." llegando ".$estilo2." ".$estilo3." a tu domicilio";
        }

        $conexion->query("INSERT INTO notificacion (iden, correo, mensaje, fecha, estado) VALUES ('$iden', '$correo', '$mensaje', '$fecha', '0')");
      } else {
        $econ = $conexion->query("SELECT * FROM envio WHERE iden='".$_GET['envio']."'");
        $einfo = mysqli_fetch_array($econ);

        $ruta = "../".$lconfig['ruta_file'];
        $archivo = $einfo['archivo'];

        if( file_exists($ruta.$archivo) ) {
            unlink($ruta.$archivo);
        }

        $conexion->query("DELETE FROM envio WHERE iden='".$_GET['envio']."'");
      }
    } else if(isset($_GET['pago'])) {
      $url = "paginas/pagos-pendientes.php";
      if(isset($_GET['aceptar'])) {
        $econ = $conexion->query("SELECT * FROM pagar WHERE iden='".$_GET['pago']."'");
        $einfo = mysqli_fetch_array($econ);

        $conteo = explode(",", $einfo['servicio']);
        $ctotal = count($conteo);

        $correo = $einfo['correo'];

        $fecha = date("h:i")." ".date("j/n/Y");

        $iden = rand(0, 10000);

        $estilo = "Tu";
        $estilo2 = "pago";
        $estilo3 = "fue";
        $estilo4 = "aceptado";


        if($ctotal > 0) {
          $estilo = "Tus";
          $estilo2 = "pagos";
          $estilo3 = "fueron";
          $estilo4 = "aceptados";
        }

        $mensaje = $estilo." ".$estilo2." ".$estilo3." ".$estilo4;

        $conexion->query("INSERT INTO notificacion (iden, correo, mensaje, fecha, estado) VALUES ('$iden', '$correo', '$mensaje', '$fecha', '0')");

        $conexion->query("UPDATE pagar SET estado='1' WHERE iden='".$_GET['pago']."'");
      } else {
        $econ = $conexion->query("SELECT * FROM pagar WHERE iden='".$_GET['pago']."'");
        $einfo = mysqli_fetch_array($econ);

        $conteo = explode(",", $einfo['servicio']);
        $ctotal = count($conteo);

        $correo = $einfo['correo'];

        $fecha = date("h:i")." ".date("j/n/Y");

        $iden = rand(0, 10000);

        $estilo = "Tu";
        $estilo2 = "pago";
        $estilo3 = "fue";
        $estilo4 = "cancelado";


        if($ctotal > 0) {
          $estilo = "Tus";
          $estilo2 = "pagos";
          $estilo3 = "fueron";
          $estilo4 = "cancelados";
        }

        $mensaje = $estilo." ".$estilo2." ".$estilo3." ".$estilo4;

        $conexion->query("INSERT INTO notificacion (iden, correo, mensaje, fecha, estado) VALUES ('$iden', '$correo', '$mensaje', '$fecha', '0')");

        $conexion->query("DELETE FROM pagar WHERE iden='".$_GET['pago']."'");
      }
    } else if(isset($_GET['servcio'])) {
      $url = "paginas/agregar-servicio.php";

      $conexion->query("DELETE FROM servicios WHERE id='".$_GET['servcio']."'");
    } else if(isset($_GET['miembro'])) {
      $url = "paginas/usuarios.php";

      $ucon2 = $conexion->query("SELECT * FROM usuarios WHERE correo='".$_GET['miembro']."'");
      $info2 = mysqli_fetch_array($ucon2);

      $ruta = "../".$lconfig['ruta_file'];
      $ffoto = $info2['foto'];

      if( file_exists($ruta.$ffoto) ) {
          unlink($ruta.$ffoto);
      }

      $econ = $conexion->query("SELECT * FROM envio WHERE correo='".$_GET['miembro']."'");

      $ruta = "../".$lconfig['ruta_file'];

      while($files = mysqli_fetch_array($econ)) {
        $archivo = $files['archivo'];
        if( file_exists($ruta.$archivo) ) {
            unlink($ruta.$archivo);
        }
      }

      $conexion->query("DELETE FROM usuarios WHERE correo='".$_GET['miembro']."'");
      $conexion->query("DELETE FROM deposito WHERE correo='".$_GET['miembro']."'");
      $conexion->query("DELETE FROM envio WHERE correo='".$_GET['miembro']."'");
      $conexion->query("DELETE FROM notificacion WHERE correo='".$_GET['miembro']."'");
      $conexion->query("DELETE FROM pagar WHERE correo='".$_GET['miembro']."'");
      $conexion->query("DELETE FROM reclamos WHERE correo='".$_GET['miembro']."'");
    } else if(isset($_GET['borrar'])) {
      $url = "paginas/depositos-pendientes.php";
      $dcon = $conexion->query("SELECT * FROM deposito WHERE iden='".$_GET['borrar']."'");
      if(mysqli_num_rows($dcon)>0) {
        $conexion->query("DELETE FROM deposito WHERE iden='".$_GET['borrar']."'");
      }
    } else if(isset($_GET['dborrar'])) {
      $url = "paginas/modificar-depositos.php";
      $dcon = $conexion->query("SELECT * FROM monto WHERE id='".$_GET['dborrar']."'");
      if(mysqli_num_rows($dcon)>0) {
        $conexion->query("DELETE FROM monto WHERE id='".$_GET['dborrar']."'");
      }
    }
  }

  header("Location: ".$url);

?>
