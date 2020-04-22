<?php session_start();
require_once 'Opinion.php';
require_once 'Pelicula.php';
$host = "localhost";
        $user = "root";
        $pwd = "2asir";
        $nombreBD="ismaelbd";
        $enlace= mysqli_connect($host, $user, $pwd);
        mysqli_select_db($enlace, $nombreBD);
?>
<html>
<head>
<meta charset="UTF-8" />
<link rel="stylesheet" type="text/css" href="css/estiloregistro.css" />
<title>Mi Filmoteca</title>
</head>
<body id="main_body" >
	<div id="contenedor1">
		<h1><a>Aplicación de Ismael Herrera</a></h1>
        <hr>
        <div id="peliculas">
		<form class="pelis" method="post" action="">
				<h2 id="titulo2">Mi Filmoteca</h2><br>	
            <p>
                <span class="ordenar"><input type="radio" name="ordenar2" class="ordenar" value="peliculaTitulo" REQUIRED/>Título </span>
                <span class="ordenar"><input type="radio" name="ordenar2" class="ordenar" value="fechaVisionado"/>Fecha de visionado </span>
                <span class="ordenar"><input type="radio" name="ordenar2" class="ordenar" value="puntuacion"/>Puntuación </span>
                <input type="submit" class="boton4" name="ordenado" value="Ordenar" />
            </p>
            
            <?php 
            if (isset($_POST['buscarpornombre'])){

                ?>
                <p><table cellpading="6" cellspacing="0" border="1">
                
                <th id="th1">Título</th><th id="th2">Fecha Visionado</th><th id="th3">Puntuación</th><th id="th4">Descripción</th></p>
                <?php 
                $obj=Opinion::mostrarPorTitulo($_POST['buscarportitulo'],$_POST['ordenar2']);
                    foreach ($obj as $f) {
                        ?><tr>
                        <td><?php echo $f->getpeliculaTitulo()?></td><td><?php echo $f->getfechaVisionado()?></td><td><?php echo $f->getpuntuacion()?></td><td><?php echo $f->getdescripcion()?></td>
                        <tr>
                            <?php
                    } ?>
                </tr>
            </table></p><?php
            }elseif(isset($_POST['eliminarpornombre'])){
                Opinion::eliminarOpinion($_POST['eliminarportitulo']);
                ?>
                <p><table cellpading="6" cellspacing="0" border="1">
                
                <th id="th1">Título</th><th id="th2">Fecha Visionado</th><th id="th3">Puntuación</th><th id="th4">Descripción</th></p>
                <?php 
                $_SESSION['ordenar2']=$_POST['ordenar2'];
                $obj=Opinion::mostrarOpinion1($_SESSION['ordenar2'],$_SESSION['nombreusuario']);
                    foreach ($obj as $f) {
                        ?><tr>
                    <td><?php echo $f->getpeliculaTitulo()?></td><td><?php echo $f->getfechaVisionado()?></td><td><?php echo $f->getpuntuacion()?></td><td><?php echo $f->getdescripcion()?></td>
                    <tr>
                        <?php
                } ?>
                </tr>
            </table></p>
                <?php
        }else{ 
           if(isset($_POST['ordenado'])){
            $_SESSION['ordenar2']=$_POST['ordenar2'];
            ?>
            <p><table cellpading="6" cellspacing="0" border="1">
                
            <th id="th1">Título</th><th id="th2">Fecha Visionado</th><th id="th3">Puntuación</th><th id="th4">Descripción</th></p>
            <?php 
            $obj=Opinion::mostrarOpinion1($_SESSION['ordenar2'],$_SESSION['nombreusuario']);
                foreach ($obj as $f) {
                    ?><tr>
                    <td><?php echo $f->getpeliculaTitulo()?></td><td><?php echo $f->getfechaVisionado()?></td><td><?php echo $f->getpuntuacion()?></td><td><?php echo $f->getdescripcion()?></td>
                    <tr>
                        <?php
                } ?>
            </tr>
        </table></p>
        <?php
        }else{?>
           <p><table cellpading="6" cellspacing="0" border="1">
           <th id="th1">Título</th><th id="th2">Fecha Visionado</th><th id="th3">Puntuación</th><th id="th4">Descripción</th></p>
                <?php 
                $obj=Opinion::mostrarOpinion1($_SESSION['ordenar2'],$_SESSION['nombreusuario']);
                    foreach ($obj as $f) {
                        ?><tr>
                    <td><?php echo $f->getpeliculaTitulo()?></td><td><?php echo $f->getfechaVisionado()?></td><td><?php echo $f->getpuntuacion()?></td><td><?php echo $f->getdescripcion()?></td>
                    <tr>
                        <?php
                } ?>
            </tr>
            </table></p>
                <?php }     
            }?>
            <p>
            <hr id="hrlargo"> <br>
                <input type="submit" class="boton3" name="buscarpornombre" value="Buscar película" /> <input type="text" name="buscarportitulo"/>
                <br><br>
                <input type="submit" class="boton3" name="eliminarpornombre" value="Eliminar película" /> <input type="text" name="eliminarportitulo"/>
                <br><br>
            </p>
            <hr id="hrlargo">
            <p>
            <br>
            </form>
            <form method="post" action="">
                <input type="submit" class="boton3" name="desplegable" value="¿Quieres añadir o modificar una película?"/>
                </form>	
                <?php 
                if(isset($_POST['anadir'])){
                    $comprobante2= Opinion::buscarPorTitulo($_POST['peliculaTitulo'],$_SESSION['nombreusuario']);
$comprobante=Pelicula::buscarPorTitulo($_POST['peliculaTitulo']);
if($comprobante==true and $comprobante2==false ){
    Opinion::anadirOpinion(null,$_SESSION['nombreusuario'],$_POST['peliculaTitulo'],$_POST['fechaVisionado'],$_POST['descripcion'],$_POST['puntuacion']);
    echo '<script language="javascript">alert("Pelicula añadida con éxito");</script>';
    ?>
<br><p><form action="./mifilmoteca.php" method="post"></p><br>
<input type="submit" class="boton3" name="desplegable" value="Pulsame para ver los cambios"/>
</form>
<?php
}elseif($comprobante2==true){
    echo '<script language="javascript">alert("Esa pelicula ya ha sido añadida");</script>';
}
else{
    echo '<script language="javascript">alert("Esa pelicula no esta registrada en la base de datos");</script>';}
}elseif(isset($_POST['modificar'])){
    Opinion::guardarOpinion($_SESSION['nombreusuario'],$_POST['peliculaTitulo'],$_POST['fechaVisionado'],$_POST['descripcion'],$_POST['puntuacion']);
    echo '<script language="javascript">alert("Pelicula actualizada con éxito");</script>';
    ?>
    <br><p><form action="./mifilmoteca.php" method="post"></p><br>
    <input type="submit" class="boton3" name="desplegable" value="Pulsame para ver los cambios"/>
    </form>
    <?php
}?>
                <?php
                        if (isset($_POST['desplegable'])){
                            ?>
                            <br>
                            <form method="post" action="">
                                <label>Título </label>
                                <input name="peliculaTitulo" type="text" maxlength="255" value="" REQUIRED/> <br><br>
                                <label>Fecha de visionado </label>
                                <span>
                                <input type="date" name="fechaVisionado" REQUIRED>
                                <br><br>
                                <label>Puntuación </label>
                                <select name="puntuacion"> 
                                    <option value="" selected="selected"></option>
                                    <?php 
                                    for($i=0; $i < 11; $i++){
                                        ?>
                                        <option value="<?php echo $i ?>" ><?php echo $i ?></option>
                                        <?php
                                    }
                                    ?>
                                </select><br><br>
                                <label>Descrpción</label>
                                <span>
                               <textarea name="descripcion" placeholder="Máximo 255 carácteres"></textarea>
                                <br><br>
                                <input class="boton3" type="submit" name="anadir" value="Añadir película" />
                                <input class="boton3" type="submit" name="modificar" value="Modificar película" />
                                <?php
                            }
                        ?>
                        <hr id="hrlargo">
                        <a class="enlace" href="menu.php">Volver al menú</a>
            </p>
</div>
	</div>
	</body>
</html>