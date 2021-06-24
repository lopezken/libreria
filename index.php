<!DOCTYPE html>
<html>

<head>
	<title>Login de usuario</title>
	<link rel="stylesheet" href="css/Style.css">
	<link rel="stylesheet" href="css/estilos.css">
	<link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Montez|Pathway+Gothic+One" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600|Open+Sans" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
	<script src="librerias/jquery-3.2.1.min.js"></script>
	<script src="js/funciones.js"></script>
</head>

<body>
	<?php

	require_once "clases/Conexion.php";
	$obj = new conectar();
	$conexion = $obj->conexion();

	$sql = "SELECT * from usuarios where email='admin'";
	$result = mysqli_query($conexion, $sql);
	$validar = 0;
	if (mysqli_num_rows($result) > 0) {
		header("location:index.php");
	}
	?>

	<style>
		body {
			background-image: url(img/back.jpg);
		}

		.boton {
			cursor: pointer;
		}

		#registro {
			text-align: center;
		}
	</style>
	<div class="contenedor">
		<header>
			<h1 class="title">Libreria</h1>
			<a href="#" id="btn-abrir-popup" class="btn-abrir-popup">Registrate</a>
		</header>
		<center>
			<div class="login">
				<article class="fondo">
					<img src="img/logo2.png" alt="User">
					<h3>Inicio de Sesión</h3>
					<form class="" id="frmLogin">
						<span class="icon-user"></span><input class="inp" type="text" name="usuario" id="usuario" value="" placeholder="Nombre de Usuario" required><br>
						<span class="icon-key"></span><input class="inp" type="password" name="password" id="password" value="" placeholder="Contraseña" required><br>
						<div class="demo">

						</div>
						<input class="boton" id="entrarSistema" value="Iniciar Sesión">
					</form>
				</article>
			</div>
	</div>
	</center>
	<div class="overlay" id="overlay">
		<div class="popup" id="popup">
			<a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup"><i class="fas fa-times"></i></a>
			<h3>REGISTRATE</h3>
			<form action="Registrar_Usuario.php" method="post">
				<div class="contenedor-inputs">
					<input type="text" placeholder="Nombre" name="Nombre" id="Nombre">
					<input type="text" placeholder="Apellido" name="Apellido" id="Apellido">
					<input type="text" placeholder="Usuario" name="Usuario" id="Usuario">
					<input type="password" placeholder="Contraseña" name="password" id="password">

				</div>
				<input type="submit" class="btn-submit" value="Registrate">
			</form>
		</div>
	</div>
	</div>
	<script src="js/popup.js"></script>
</body>

</html>

<script type="text/javascript">
	$(document).ready(function() {
		$('#entrarSistema').click(function() {

			vacios = validarFormVacio('frmLogin');

			if (vacios > 0) {
				alert("Debes llenar todos los campos!!");
				return false;
			}

			datos = $('#frmLogin').serialize();
			$.ajax({
				type: "POST",
				data: datos,
				url: "procesos/regLogin/login.php",
				success: function(r) {

					if (r == 1) {
						window.location = "vistas/inicio.php";
					} else {
						alert("No se pudo acceder :(");
					}
				}
			});
		});
	});
</script>