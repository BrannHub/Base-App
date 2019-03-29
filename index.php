<?php include('php/head.php'); ?>
<?php $titulo = "Inicio - Garpa Fácil"; ?>
<?php $active_home = "active"; ?>

<title><?php echo $titulo; ?></title>

<body>

	<header><?php include('php/nav.php'); ?></header>

<section class="jumbotron parallax" id="" style="background-image:url('https://i.imgur.com/PGgYVv5.png'); min-height:70%;">
  <div class="jumbotron_bar" style="  min-height:70%;">
    <div class="container wow fadeInUp"  data-wow-duration="1.3s">
      <br><br>
			<center>
      <img src="https://i.imgur.com/wdcQthI.png" alt="Logo garpa facil" style="width:90%;">
			</center>
      <br><br>
    </div>
  </div>
</section>
<div class="jumbotron funciones bg-info">
		<div class="container">
			<div class="row">
				<div class="col-md-9">
					<h2>Registrese gratis!<br><small><p>Y viva esta nueva experiencia.</p></small></h2>
				</div>
				<div class="col-md-2"><br>
					<a href="acceso/registro.php" class="btn btn-primary btn-block">Registrarse</a>
				</div>
			</div>
		</div>
</div>
<br>
<div class="container">
    <br><br>
    <div class="row panels-row">

      <div class="col-md-4 wow slideInUp" data-wow-delay="0.4s">
				<a class="panel panel-default " href="#">
				 <div class="panel-body">
					 <div class="media">
						 <div class="media-left padding-5">
							 <i class="icono-arg-documento fa-fw fa-3x text-secondary"></i>
						 </div>
						 <div class="media-body">
							 <h3>Impresión de facturas</h3>
							 <p>Reciba sus facturas a su domicilio.</p>
						 </div>
					 </div>
				 </div>
			 </a>
      </div>

			<div class="col-md-4 wow slideInUp" data-wow-delay="0.6s">
				<a class="panel panel-default " href="#">
				 <div class="panel-body">
					 <div class="media">
						 <div class="media-left padding-5">
							 <i class="icono-arg-factor-pago fa-fw fa-3x text-secondary"></i>
						 </div>
						 <div class="media-body">
							 <h3>Gestione sus facturas</h3>
							 <p>Administración de todos sus servicios</p>
						 </div>
					 </div>
				 </div>
			 </a>
      </div>

			<div class="col-md-4 wow slideInUp" data-wow-delay="0.8s">
				<a class="panel panel-default " href="#">
				 <div class="panel-body">
					 <div class="media">
						 <div class="media-left padding-5">
							 <i class="icono-arg-envio-terrestre_1 fa-fw fa-3x text-secondary"></i>
						 </div>
						 <div class="media-body">
							 <h3>Envio express</h3>
							 <p>Envio rápido a su domicilio en maximo 2 días.</p>
						 </div>
					 </div>
				 </div>
			 </a>
      </div>

    </div>
		<br><br>
</div>

<div class="jumbotron funciones bg-dark wow fadeInUp parallax" style="background-image:url('https://i.imgur.com/NAcIAiN.png');">
	<center><h2>Funciones principales</h2></center>
</div>
<br><br>
<div class="container">

	<div class="row panels-row">

		<div class="col-md-4 wow slideInUp" data-wow-delay="0.4s">
			<a class="panel panel-default panel-icon panel-secondary" href="#">
	      <div class="panel-heading"><br><i class="icono-arg-tecnovigilancia"></i></div>
	      <div class="panel-body">
	        <h3><b>Control total</b></h3>
	        <p>Gestione sus servicios de manera cómoda y segura.</p>
	      </div>
	    </a>
		</div>

		<div class="col-md-4 wow slideInUp" data-wow-delay="0.6s">
			<a class="panel panel-default panel-icon panel-secondary" href="#">
	      <div class="panel-heading"><br><i class="icono-arg-pago"></i></div>
	      <div class="panel-body">
	        <h3><b>Pago seguro</b></h3>
	        <p>Puede abonar nuestros servicios mediante tarjeta de débito, crédito o en efectivo de manera presencial o por Pago Fácil o Rapipago.</p>
	      </div>
	    </a>
		</div>

		<div class="col-md-4 wow slideInUp" data-wow-delay="0.8s">
			<a class="panel panel-default panel-icon panel-secondary" href="#">
	      <div class="panel-heading"><br><i class="icono-arg-pesos"></i></div>
	      <div class="panel-body">
	        <h3><b>Abono de servicios</b></h3>
	        <p>Deposite dinero en su cuenta y abone los servicios que desee*.</p>
					<small>Suele tardar 24 a 48 horas hábiles.</small>
	      </div>
	    </a>
		</div>

	</div>


	<br>
</div>
</body>


<?php include('php/footer.php') ?>
