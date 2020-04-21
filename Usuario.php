<?php 

require_once 'Conexion.php';

 class Usuario { 
    private $nombreusuario;
    private $correo;
    private $contrasenia;
    private $fechanacimiento;
    private $generousuario;
    const TABLA = 'usuario';
    public function getNombreUsuario() {
        return $this->nombreusuario;
     }
     public function getCorreo() {
        return $this->correo;
     }
     public function getContrasenia() {
      return $this->contrasenia;
   }
     public function getFechaNacimiento() {
        return $this->fechanacimiento;
     }
     public function getGeneroUsuario() {
        return $this->generousuario;
     }
     public function setGeneroUsuario($genero) {
      $this->generousuario = $genero;
   }
   public function setCorreo($correo) {
      $this->correo = $correo;
   }
   public function setFechaNacimiento($fechanacimiento) {
      $this->fechanacimiento = $fechanacimiento;
   }
    public function __construct($nombreusuario, $correo, $contrasenia, $fechanacimiento, $generousuario) {
        $this->nombreusuario = $nombreusuario;
        $this->correo = $correo;
        $this->contrasenia = $contrasenia;
        $this->fechanacimiento = $fechanacimiento;
        $this->generousuario = $generousuario;
     }
     public static function eliminarUsuario($nombre){
        $conexion = new Conexion();
        $consulta = $conexion->prepare('DELETE FROM ' . self::TABLA . ' WHERE nombreUsuario = :nombreusuario');
        $consulta->bindParam(':nombreusuario',$nombre);
        $consulta->execute();
        $conexion = null;
     }
     public static function guardarUsuario($nombreusuario,$correo,$contrasenia,$fechanacimiento,$generousuario){
        $conexion = new Conexion();
        if($nombreusuario){
           $consulta = $conexion->prepare('UPDATE ' . self::TABLA .' SET correo = :correo, contrasenia = :contrasenia, fechanacimiento = :fechanacimiento, generousuario = :generousuario WHERE nombreusuario = :nombreusuario');
           $consulta->bindParam(':correo', $correo);
           $consulta->bindParam(':contrasenia', $contrasenia);
           $consulta->bindParam(':fechanacimiento', $fechanacimiento);
           $consulta->bindParam(':generousuario', $generousuario);
           $consulta->bindParam(':nombreusuario', $nombreusuario);
           $consulta->execute();
           $conexion = null;
        }}
           public static function anadirUsuario($nombreusuario,$correo,$contrasenia,$fechanacimiento,$generousuario){
            $conexion = new Conexion();
           $consulta = $conexion->prepare('INSERT INTO ' . self::TABLA .' (nombreusuario, correo, contrasenia, fechanacimiento, generousuario) VALUES(:nombreusuario, :correo, :contrasenia, :fechanacimiento, :generousuario)');
           $consulta->bindParam(':nombreusuario', $nombreusuario);
           $consulta->bindParam(':correo', $correo);
           $consulta->bindParam(':contrasenia', $contrasenia);
           $consulta->bindParam(':fechanacimiento', $fechanacimiento);
           $consulta->bindParam(':generousuario', $generousuario);
           $consulta->execute();
        $conexion = null;
        }
        public static function buscarPorNombre($nombre){
         $conexion = new Conexion();
         $consulta = $conexion->prepare('SELECT nombreusuario FROM ' . self::TABLA . ' WHERE nombreusuario = :nombre');
         $consulta->bindParam(':nombre', $nombre);
         $consulta->execute();
         $registro = $consulta->fetch();
         if($registro){
            return true;
         }else{
            return false;
         }
         $conexion = null;
      }
      public static function buscarContrasenia($nombre){
         $conexion = new Conexion();
         $consulta = $conexion->prepare('SELECT * FROM ' . self::TABLA . ' WHERE nombreusuario = :nombre');
         $consulta->bindParam(':nombre', $nombre);
         $consulta->execute();
         $registro = $consulta->fetch();
         if($registro){
         return ($registro['contrasenia']);
         }else{
            return false;
         }
         $conexion = null;
      }
      
      public static function buscarGenero($nombre){
         $conexion = new Conexion();
         $consulta = $conexion->prepare('SELECT * FROM ' . self::TABLA . ' WHERE nombreusuario = :nombre');
         $consulta->bindParam(':nombre', $nombre);
         $consulta->execute();
         $registro = $consulta->fetch();
         if($registro){
         return ($registro['generoUsuario']);
         }else{
            return false;
         }
         $conexion = null;
      }
     }
 
?>