<?php session_start();
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
<title>Base de datos de películas</title>
</head>
<body id="main_body" >
	<div id="contenedor1">
		<h1><a>Aplicación de Ismael Herrera</a></h1>
        <hr>
        <div id="peliculas">
		<form class="pelis" method="post" action="">
				<h2 id="titulo2">Base de datos de películas</h2><br>	
            <p>
                <span class="ordenar"><input type="radio" name="ordenar1" class="ordenar" value="titulo" checked/>Título </span>
                <span class="ordenar"><input type="radio" name="ordenar1" class="ordenar" value="generoPelicula"/>Género </span>
                <span class="ordenar"><input type="radio" name="ordenar1" class="ordenar" value="duracion"/>Duración </span>
                <span class="ordenar"><input type="radio" name="ordenar1" class="ordenar" value="fechaLanzamiento"/>Fecha de Lanzamiento </span>
                <span class="ordenar"><input type="radio" name="ordenar1" class="ordenar" value="director"/>Director </span>
                <input type="submit" class="boton4" name="ordenado" value="Ordenar" />
            </p>
            
            <?php 
            if (isset($_POST['buscarpornombre'])){

                ?>
                <p><table cellpading="6" cellspacing="0" border="1">
                
                <th id="th1">Título</th><th id="th2">Género</th><th id="th3">Duración</th><th id="th4">Fecha de Lanzamiento</th><th id="th5">Director</th></p>
                <?php 
                $obj=Pelicula::mostrarPorTitulo($_POST['buscarportitulo']);
                    foreach ($obj as $f) {
                        ?><tr>
                        <td><?php echo $f->getTitulo()?></td><td><?php echo $f->getgeneroPelicula()?></td><td><?php echo $f->getDuracion()?></td><td><?php echo $f->getFechaLanzamiento()?></td><td><?php echo $f->getdirector()?></td>
                        <tr>
                            <?php
                    } ?>
                </tr>
            </table></p><?php
            }elseif (isset($_POST['eliminarpornombre'])){
                Pelicula::eliminarPelicula($_POST['eliminarportitulo']);
                ?>
                <p><table cellpading="6" cellspacing="0" border="1">
                
                <th id="th1">Título</th><th id="th2">Género</th><th id="th3">Duración</th><th id="th4">Fecha de Lanzamiento</th><th id="th5">Director</th></p>
                <?php 
                $_SESSION['ordenar1']=$_POST['ordenar1'];
                $obj=Pelicula::mostrarPelicula($_SESSION['ordenar1']);
                    foreach ($obj as $f) {
                        ?><tr>
                        <td><?php echo $f->getTitulo()?></td><td><?php echo $f->getgeneroPelicula()?></td><td><?php echo $f->getDuracion()?></td><td><?php echo $f->getFechaLanzamiento()?></td><td><?php echo $f->getdirector()?></td>
                        <tr>
                            <?php
                    } ?>
                </tr>
            </table></p>
                <?php
        }elseif (isset($_POST['buscarporgenero'])){

                






            ?>
            <p><table cellpading="6" cellspacing="0" border="1">
            
            <th id="th1">Título</th><th id="th2">Género</th><th id="th3">Duración</th><th id="th4">Fecha de Lanzamiento</th><th id="th5">Director</th></p>
            <?php 
            $obj=Pelicula::mostrarPorGenero($_POST['generopelicula']);
                foreach ($obj as $f) {
                    ?><tr>
                    <td><?php echo $f->getTitulo()?></td><td><?php echo $f->getgeneroPelicula()?></td><td><?php echo $f->getDuracion()?></td><td><?php echo $f->getFechaLanzamiento()?></td><td><?php echo $f->getdirector()?></td>
                    <tr>
                        <?php
                } ?>
            </tr>
        </table></p><?php





        }
        else{ 
           if(isset($_POST['ordenado'])){
            $_SESSION['ordenar1']=$_POST['ordenar1'];
            ?>
            <p><table cellpading="6" cellspacing="0" border="1">
                
            <th id="th1">Título</th><th id="th2">Género</th><th id="th3">Duración</th><th id="th4">Fecha de Lanzamiento</th><th id="th5">Director</th></p>
            <?php 
            $obj=Pelicula::mostrarPelicula($_SESSION['ordenar1']);
                foreach ($obj as $f) {
                    ?><tr>
                    <td><?php echo $f->getTitulo()?></td><td><?php echo $f->getgeneroPelicula()?></td><td><?php echo $f->getDuracion()?></td><td><?php echo $f->getFechaLanzamiento()?></td><td><?php echo $f->getdirector()?></td>
                    <tr>
                        <?php
                } ?>
            </tr>
        </table></p>
        <?php
        }else{?>
           <p><table cellpading="6" cellspacing="0" border="1">
                <th id="th1">Título</th><th id="th2">Género</th><th id="th3">Duración</th><th id="th4">Fecha de Lanzamiento</th><th id="th5">Director</th></p>
                <?php 
                $obj=Pelicula::mostrarPelicula($_SESSION['ordenar1']);
                    foreach ($obj as $f) {
                        ?><tr>
                        <td><?php echo $f->getTitulo()?></td><td><?php echo $f->getgeneroPelicula()?></td><td><?php echo $f->getDuracion()?></td><td><?php echo $f->getFechaLanzamiento()?></td><td><?php echo $f->getdirector()?></td>
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
                <input type="submit" class="boton3" name="buscarporgenero" value="Buscar por género" /> <select name="generopelicula">
                                    <option value=" ">
                                    <?php 
                                    mysqli_select_db ($enlace,$nombreBD);
                                    $consultagenero="SELECT * from genero";
                                    $resultado=mysqli_query($enlace,$consultagenero);
                                    if(mysqli_num_rows($resultado)>0){
                                    while ($fila = mysqli_fetch_array($resultado)){
                                    ?>  
                                            <option value=<?php echo $fila[0]?>><?php echo $fila[0]?></option>
                                    <?php
                                    }
                                    }
                                    ?>
                                </select>
                                <br> <br>
                <input type="submit" class="boton3" name="eliminarpornombre" value="Eliminar película" /> <input type="text" name="eliminarportitulo"/>
                <br><br>
            </p>
            <hr id="hrlargo">
            <p>
            <br>
                <input type="submit" class="boton3" name="desplegable" value="¿Quieres añadir o modificar una película?"/>
                </form>	
                <?php 
                if(isset($_POST['anadir'])){
$comprobante=Pelicula::buscarPorTitulo($_POST['titulo']);
if($comprobante){
    echo "Esa pelicula ya existe";
}else{
Pelicula::anadirPelicula($_POST['titulo'],$_POST['generopelicula'],$_POST['duracion'],$_POST['fechalanzamiento'],$_POST['director']);
?>
<br><p><form action="./datospeliculas.php" method="post"></p><br>
<p>Pelicula añadida con éxito</p><br>
<input type="submit" class="boton3" name="desplegable" value="Actualizar"/>
</form>
<?php
}
} ?>
                <?php
                        if (isset($_POST['desplegable'])){
                            ?>
                            <br>
                            <form method="post" action="">
                                <label>Título </label>
                                <input name="titulo" type="text" maxlength="255" value="" REQUIRED/> <br><br>
                                <label>Género </label>
                                <select name="generopelicula" REQUIRED>
                                    <option value=" ">
                                    <?php 
                                    mysqli_select_db ($enlace,$nombreBD);
                                    $consultagenero="SELECT * from genero";
                                    $resultado=mysqli_query($enlace,$consultagenero);
                                    if(mysqli_num_rows($resultado)>0){
                                    while ($fila = mysqli_fetch_array($resultado)){
                                    ?>  
                                            <option value=<?php echo $fila[0]?>><?php echo $fila[0]?></option>
                                    <?php
                                    }
                                    }
                                    ?>
                                </select><br><br>
                                <label>Duración </label>
                                <input name="duracion" type="text" maxlength="255" value="" REQUIRED/> <br><br>
                                <label>Fecha de lanzamiento </label>
                                <span>
                                <input type="date" name="fechalanzamiento" REQUIRED><br><br>
                                <label>Director </label>
                                <input name="director" type="text" maxlength="255" value="" REQUIRED/> <br><br>
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