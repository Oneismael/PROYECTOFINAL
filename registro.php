<?php 
session_start();
include 'Usuario.php';
?>
<html>
<head>
<meta charset="UTF-8" />
<link rel="stylesheet" type="text/css" href="css/estiloregistro.css" />
<title>Registro de usuarios</title>
</head>
<body id="main_body" ><?php
if (isset($_POST['Enviar'])){
$nombreusuario= (isset($_POST['nombreusuario']))?$_POST['nombreusuario']:'';
$correo= (isset($_POST['correo']))?$_POST['correo']:'';
$contrasenia= (isset($_POST['contrasenia']))?$_POST['contrasenia']:'';
$fechanacimiento= (isset($_POST['fechanacimiento']))?$_POST['fechanacimiento']:'';
$genero= (isset($_POST['genero']))?$_POST['genero']:'';
$_SESSION['nombreusuario']=$_POST['nombreusuario'];
$_SESSION['correo']=$_POST['correo'];
$_SESSION['contrasenia']=$_POST['contrasenia'];
$_SESSION['fechanacimiento']=$_POST['fechanacimiento'];
$_SESSION['genero']=$_POST['genero'];
$comprobar= Usuario::buscarPorNombre($_SESSION['nombreusuario']);
if ($comprobar==true){
	?>
	<div id="contenedor">
	<h1><a>Aplicación de Ismael Herrera</a></h1>
		<hr>
		
			<div class="formulario">
				<h2>Registro de usuarios</h2>
			</div>			<br><br><br>	
			<p><h2>Ese nombre de usuario ya está en uso</h2></p><br><br><br><br><br>	
			<br>
			<a href="index.php" class="enlace2">Volver</a>
			</div>
			<?php
}else{
Usuario::anadirUsuario($_SESSION['nombreusuario'],$_SESSION['correo'],$_SESSION['contrasenia'],$_SESSION['fechanacimiento'],$_SESSION['genero']);
?>
<div id="contenedor">
		<h1><a>Aplicación de Ismael Herrera</a></h1>
		<hr>
		
			<div class="formulario">
				<h2>Registro de usuarios</h2>
			</div>			<br><br><br>	
			<p><h2>Usuario registrado correctamente</h2></p><br><br><br><br><br>		
			<a href="menu.php" class="enlace2">Ir a al menú principal</a>
			<br>
			</div>
<?php }
}else{ ?>
	<div id="contenedor">
		<h1><a>Aplicación de Ismael Herrera</a></h1>
		<hr>
		<form method="post" action="">
			<div class="formulario">
				<h2>Registro de usuarios</h2>
			</div>						
			<label class="etiqueta">Nombre de usuario </label>
			<div>
				<input name="nombreusuario" type="text" maxlength="255" value="" REQUIRED/> 
			</div><br>
			<label class="etiqueta">Correo electrónico </label>
			<div>
				<input name="correo" type="text" maxlength="255" value="" REQUIRED/> 
			</div><br> 
			<label class="etiqueta">Contraseña </label>
			<div>
				<input  name="contrasenia" type="password" maxlength="255" value="" REQUIRED/> 
			</div><br> 
			<label class="etiqueta">Fecha de nacimiento </label><br>
			<span>
				<input type="date" name="fechanacimiento" REQUIRED><br><br>
			<label class="etiqueta">Género</label>
			
			<select name="genero"> 
				<option value="" selected="selected"></option>
				<?php 
				$opciones=array('H','M');
				foreach ($opciones as $r) {
					?>
					<option value="<?php echo $r ?>" ><?php echo $r ?></option>
					<?php
				}
				?>
			</select>
			 <br><br>
				<input type="checkbox" value="aceptado" REQUIRED />Acepto el tratamiento de mis datos
			 <br><br>
					<input class="boton1" type="submit" name="Enviar" value="Registarme" />
					<input class="boton1" type="reset" name="Limpiar" value="Limpiar" />
			<a class="volver" href="index.php">Volver atrás</a>
		</form>	
			</div><?php } ?>
	</body>
</html>