<?php
 require_once 'Pelicula.php';
$hola='hoyo';
 $obj=Pelicula::mostrarPorTitulo($hola);
 foreach ($obj as $f) {
     ?><tr>
     <td><?php echo $f->getTitulo()?></td><td><?php echo $f->getgeneroPelicula()?></td><td><?php echo $f->getDuracion()?></td><td><?php echo $f->getFechaLanzamiento()?></td><td><?php echo $f->getdirector()?></td>
     <tr>
         <?php
 }
?>