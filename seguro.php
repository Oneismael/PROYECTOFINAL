<?php 
session_start();
include 'Usuario.php';
?>
<html>
<head>
<meta charset="UTF-8" />
<link rel="stylesheet" type="text/css" href="css/estiloregistro.css" />
<title>Menú principal</title>
</head>
<body id="main_body" >
	<div id="contenedor">
		<h1><a>Aplicación de Ismael Herrera</a></h1>
		<hr>
		<form method="post" action="">
				<h2>Menú principal</h2>
            <br>				
            <p id="F">¿Segur<?php if ($_SESSION['genero']=="H"){
                echo "o";
            }elseif($_SESSION['genero']=="M"){
                echo "a";
            }else{
                echo "o/a";
            }?> que quieres eliminar la cuenta de 
            <?php echo $_SESSION['nombreusuario']?>?</p>
                <br>	<br><br>
                <div id="botonF2"><input class="boton1" type="submit" name="no" value="No" /></div>
					<div id="botonF1"><input class="boton1" type="submit" name="si" value="Si" /></div>
                    <?php 
                    if (isset($_POST['no'])){
                        header('Location: ./menu.php');
                    }
                    if (isset($_POST['si'])){
                        Usuario::eliminarusuario($_SESSION['nombreusuario']);
                        header('Location: ./index.php');
                    }
                    ?>
            <a class="volver" href="menu.php">Volver</a>
		</form>	
	</div>
	</body>
</html>