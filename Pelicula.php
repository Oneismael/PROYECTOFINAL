<?php 

require_once 'Conexion.php';

 class Pelicula { 
    private $titulo;
    private $generoPelicula;
    private $duracion;
    private $fechaLanzamiento;
    private $director;
    const TABLA = 'pelicula';
    public function getTitulo() {
        return $this->titulo;
     }
     public function getGeneroPelicula() {
        return $this->generoPelicula;
     }
     public function getDuracion() {
        return $this->duracion;
     }
     public function getFechaLanzamiento() {
        return $this->fechaLanzamiento;
     }
     public function getdirector() {
        return $this->director;
     }

     public function setTitulo($titulo) {
        $this->titulo = $titulo;
     }
     public function setGeneroPelicula($generoPelicula) {
        $this->generoPelicula = $generoPelicula;
     }
     public function setduracion($duracion) {
        $this->duracion = $duracion;
     }
     public function setfechaLanzamiento($fechaLanzamiento) {
        $this->fechaLanzamiento = $fechaLanzamiento;
     }
     public function setdirector($director) {
        $this->director = $director;
     }
    /*public function __construct($titulo, $generoPelicula, $duracion, $fechaLanzamiento, $director) {
        $this->titulo = $titulo;
        $this->generoPelicula = $generoPelicula;
        $this->duracion = $duracion;
        $this->fechaLanzamiento = $fechaLanzamiento;
        $this->director = $director;
     }*/
     public function __construct(){
         
     }
     public static function eliminarPelicula($titulo){
        $conexion = new Conexion();
        $consulta = $conexion->prepare('DELETE FROM ' . self::TABLA . ' WHERE titulo = :titulo');
        $consulta->bindParam(':titulo',$titulo);
        $consulta->execute();
        $conexion = null;
     }
     public static function guardarPelicula($titulo, $generoPelicula, $duracion, $fechaLanzamiento, $director){
        $conexion = new Conexion();
        if($titulo){
           $consulta = $conexion->prepare('UPDATE ' . self::TABLA .' SET generoPelicula = :generoPelicula, duracion = :duracion, fechaLanzamiento = :fechaLanzamiento, director = :director WHERE titulo = :titulo');
           $consulta->bindParam(':generoPelicula', $generoPelicula);
           $consulta->bindParam(':duracion', $duracion);
           $consulta->bindParam(':fechaLanzamiento', $fechaLanzamiento);
           $consulta->bindParam(':director', $director);
           $consulta->bindParam(':titulo', $titulo);
           $consulta->execute();
           $conexion = null;
        }}
           public static function anadirPelicula($titulo, $generoPelicula, $duracion, $fechaLanzamiento, $director){
            $conexion = new Conexion();
           $consulta = $conexion->prepare('INSERT INTO ' . self::TABLA .' (titulo, generoPelicula, duracion, fechaLanzamiento, director) VALUES(:titulo, :generoPelicula, :duracion, :fechaLanzamiento, :director)');
           $consulta->bindParam(':titulo', $titulo);
           $consulta->bindParam(':generoPelicula', $generoPelicula);
           $consulta->bindParam(':duracion', $duracion);
           $consulta->bindParam(':fechaLanzamiento', $fechaLanzamiento);
           $consulta->bindParam(':director', $director);
           $consulta->execute();
        $conexion = null;
        }
        public static function buscarPorTitulo($titulo){
         $conexion = new Conexion();
         $consulta = $conexion->prepare('SELECT titulo FROM ' . self::TABLA . ' WHERE titulo = :titulo');
         $consulta->bindParam(':titulo', $titulo);
         $consulta->execute();
         $registro = $consulta->fetch();
         if($registro){
            return true;
         }else{
            return false;
         }
         $conexion = null;
      }
      public static function mostrarPelicula($parametro){
         $conexion = new Conexion();
         $consulta = $conexion->prepare('SELECT * FROM ' . self::TABLA . ' ORDER BY '. $parametro);
         $consulta->execute();
         $consulta->setFetchMode(PDO::FETCH_CLASS, 'Pelicula');
         return $obj = $consulta->fetchAll();
        /* $obj = $consulta->fetchAll();
         foreach ($obj as $f) {
             echo $f->titulo."\n";
         }*/
         $conexion = null;
      }
      public static function mostrarPorTitulo($parametro,$orden){
        $conexion = new Conexion();
        $consulta = $conexion->prepare("SELECT * FROM " . self::TABLA . " WHERE titulo LIKE '%".$parametro."%' ORDER BY ".$orden);
        $consulta->execute();
        $consulta->setFetchMode(PDO::FETCH_CLASS, 'Pelicula');
        return $obj = $consulta->fetchAll();
       /* $obj = $consulta->fetchAll();
        foreach ($obj as $f) {
            echo $f->titulo."\n";
        }*/
        $conexion = null;
     }
     public static function mostrarPorGenero($parametro,$orden){
        $conexion = new Conexion();
        $consulta = $conexion->prepare("SELECT * FROM " . self::TABLA . " WHERE generoPelicula LIKE '%".$parametro."%' ORDER BY ".$orden);
        $consulta->execute();
        $consulta->setFetchMode(PDO::FETCH_CLASS, 'Pelicula');
        return $obj = $consulta->fetchAll();
       /* $obj = $consulta->fetchAll();
        foreach ($obj as $f) {
            echo $f->titulo."\n";
        }*/
        $conexion = null;
     }
      
     }
 
?>