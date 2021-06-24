<?php 
session_start();
if(isset($_SESSION['usuario'])){

	?>


	<!DOCTYPE html>
	<html>
	<head>
		<title>Usuarios</title>
		<?php require_once "menu.php"; ?>
	</head>
	<body>
		<div class="container">
			<h1>Usuarios</h1>
			<div class="row">
				<div class="col-sm-4">
					<form id="frmUsuarios">
						<label>Nombre</label>
						<input type="text" class="form-control input-sm" id="nombre" name="nombre">
						<label>Apellido</label>
						<input type="text" class="form-control input-sm" id="apellido" name="apellido">
						<label>Usuario</label>
						<input type="text" class="form-control input-sm" id="usuario" name="usuario">
						<label>Contraseña</label>
						<input type="text" class="form-control input-sm" id="password" name="password">
						<p></p>
						<span class="btn btn-primary" id="btnAgregarUsuario">Agregar</span>
					</form>
				</div>
				<div class="col-sm-8">
					<div id="tablaUsuariosLoad"></div>
				</div>
			</div>
		</div>

		<!-- Button trigger modal -->


		<!-- Modal -->
		<div class="modal fade" id="actualizaUsuarioModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Actualizar Usuario</h4>
					</div>
					<div class="modal-body">
						<form id="frmUsuariosU">
							<input type="text" hidden="" id="idusuario" name="idusuario">
							<label>Nombre</label>
							<input type="text" class="form-control input-sm" id="nombreU" name="nombreU">
							<label>Apellido</label>
							<input type="text" class="form-control input-sm" id="apellidoU" name="apellidoU">
							<label>Usuario</label>
							<input type="text" class="form-control input-sm" id="usuarioU" name="usuarioU">
						</form>
					</div>
					<div class="modal-footer">
						<button id="btnAgregarUsuarioU" type="button" class="btn btn-primary" data-dismiss="modal">Actualizar</button>

					</div>
				</div>
			</div>
		</div>

	</body>
	</html>

	<script type="text/javascript">
		function agregaDatosUsuario(idusuario){

			$.ajax({
				type:"POST",
				data:"idusuario=" + idusuario,
				url:"../procesos/usuarios/obtenDatosUsuario.php",
				success:function(r){
					dato=jQuery.parseJSON(r);
					$('#idusuario').val(dato['idusuario']);
					$('#nombreU').val(dato['nombre']);
					$('#apellidosU').val(dato['apellido']);
					$('#usuarioU').val(dato['usuario']);
					$('#passwordU').val(dato['password']);

				}
			});
		}

		function eliminarUsuario(idusuario){
			alertify.confirm('¿Desea eliminar este cliente?', function(){ 
				$.ajax({
					type:"POST",
					data:"idusuario=" + idusuario,
					url:"../procesos/usuarios/eliminarUsuario.php",
					success:function(r){
						if(r==1){
							$('#tablaUsuariosLoad').load("usuarios/tablaUsuarios.php");
							alertify.success("Eliminado con exito!!");
						}else{
							alertify.error("No se pudo eliminar :(");
						}
					}
				});
			}, function(){ 
				alertify.error('Cancelo !')
			});
		}
	</script>

	<script type="text/javascript">
		$(document).ready(function(){

			$('#tablaUsuariosLoad').load("usuarios/tablaUsuarios.php");

			$('#btnAgregarUsuario').click(function(){

				vacios=validarFormVacio('frmUsuarios');

				if(vacios > 0){
					alertify.alert("Debes llenar todos los campos!!");
					return false;
				}

				datos=$('#frmUsuarios').serialize();

				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/usuarios/agregaUsuario.php",
					success:function(r){

						if(r==1){
							$('#frmUsuarios')[0].reset();
							$('#tablaUsuariosLoad').load("usuarios/tablaUsuarios.php");
							alertify.success("Usuario agregado con exito");
						}else{
							alertify.error("No se pudo agregar Usuario");
						}
					}
				});
			});
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#btnAgregarUsuarioU').click(function(){
				datos=$('#frmUsuariosU').serialize();

				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/usuarios/actualizaUsuario.php",
					success:function(r){

						if(r==1){
							$('#frmUsuarios')[0].reset();
							$('#tablaUsuariosLoad').load("usuarios/tablaUsuarios.php");
							alertify.success("Usuario actualizado con exito");
						}else{
							alertify.error("No se pudo actualizar Usuario");
						}
					}
				});
			})
		})
	</script>


	<?php 
}else{
	header("location:../index.php");
}
?>