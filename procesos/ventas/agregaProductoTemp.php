<?php 
	session_start();
	require_once "../../clases/Conexion.php";

	$c= new conectar();
	$conexion=$c->conexion();

	$idcliente=$_POST['clienteVenta'];
	$idproducto=$_POST['productoVenta'];
	$autor=$_POST['autorV'];
	$cantidad=$_POST['cantidadV'];
	$precio=$_POST['precioV'];

	$sql="SELECT nombre,apellido 
			from clientes 
			where id_cliente='$idcliente'";
	$result=mysqli_query($conexion,$sql);

	$c=mysqli_fetch_row($result);

	$ncliente=$c[1]." ".$c[0];

	$sql="SELECT titulo 
			from articulos 
			where id_producto='$idproducto'";
	$result=mysqli_query($conexion,$sql);

	$nombreproducto=mysqli_fetch_row($result)[0];

	$articulo=$idproducto."||".
				$nombreproducto."||".
				$autor."||".
				$precio."||".
				$ncliente."||".
				$idcliente;

	$_SESSION['tablaComprasTemp'][]=$articulo;

 ?>