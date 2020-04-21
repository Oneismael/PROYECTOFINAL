<?php session_start();
include 'Usuario.php';
?>
<html>
<head>
<meta charset="UTF-8" />
<link rel="stylesheet" type="text/css" href="css/estiloregistro.css" />
<title>Modificar usuario</title>
</head>
<body id="main_body" >
	<div id="contenedor">
		<h1><a>Aplicación de Ismael Herrera</a></h1>
		<hr>
		<form method="post" action="">
				<h2>Modificar usuario</h2>
            <br>				
            <p>Estas conectado como <?php echo $_SESSION['nombreusuario']?></p>
                <br>	
			<p>
                                <label>Correo </label>
                                <input name="correo" type="text" maxlength="255" value="" REQUIRED/> <br><br>
                                <label>Contraseña </label><input  name="contrasenia" type="password" maxlength="255" value="" REQUIRED/> <br><br>
                                <label>Fecha de nacimiento </label>
                                <span>
                                <input type="date" name="fechanacimiento" REQUIRED><br><br>
                                <label>Género </label>
                                <select name="genero" REQUIRED> 
                                <option value="" selected="selected"></option>
                                <?php 
                                $opciones=array('H','M');
                                foreach ($opciones as $r) {
                                    ?>
                                    <option value="<?php echo $r ?>" ><?php echo $r ?></option>
                                    <?php
				}
				?>
			</select> <br><br>
            </p>
            <p>
                <input  class="boton1" type="submit" name="modificar" value="Modificar usuario"/>
                <?php
                if (isset($_POST['modificar'])){
                Usuario::guardarUsuario($_SESSION['nombreusuario'],$_POST['correo'],$_POST['contrasenia'],$_POST['fechanacimiento'],$_POST['genero']);
                $_SESSION['genero']=$_POST['genero'];
                ?> 
                <p>Se ha actualizado el usuario</p>
                <?php
                }?>
            </p>
            <p>
                <a href="./menu.php" class="enlace">Volver al menu principal</a>
            </p>
		</form>	
	</div>
	</body>
</html>