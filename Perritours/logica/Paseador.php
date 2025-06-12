<?php
require_once("persistencia/Conexion.php");
require_once("persistencia/PaseadorDAO.php");
require_once("logica/Persona.php");

class Paseador extends Persona {
    private $descripcion;
    
    public function __construct($id = "", $nombre="", $apellido="", $foto="", $correo="", $telefono="", $clave="", $descripcion="") {
        parent::__construct($id, $nombre, $apellido, $foto, $correo, $telefono, $clave);
        $this->descripcion= $descripcion;
    }
    
    public function getDescripcion(){
        return $this -> descripcion;
    }

    
    public function autenticar() {
        $conexion = new Conexion();
        $paseadorDAO = new PaseadorDAO("", "", "","",$this->correo, "", $this->clave);
        $conexion->abrir();
        $conexion->ejecutar($paseadorDAO->autenticar());
        if($conexion->filas() == 1) {
            $this->id = $conexion->registro()[0];
            $conexion->cerrar();
            return true;
        } else {
            $conexion->cerrar();
            return false;
        }
    }
    
    public function consultar() {
        $conexion = new Conexion();
        $paseadorDAO = new PaseadorDAO($this->id);
        $conexion->abrir();
        $conexion->ejecutar($paseadorDAO->consultar());
        $datos = $conexion->registro();
        $this->nombre = $datos[0];
        $this->correo = $datos[1];
        $this->telefono = $datos[2];
        $this->foto = $datos[3];
        $conexion->cerrar();
    }
    
    public function consultarTodos() {
        $conexion = new Conexion();
        $paseadorDAO = new PaseadorDAO();
        $conexion->abrir();
        $conexion->ejecutar($paseadorDAO->consultarTodos());
        $paseadores = array();
        while($datos = $conexion->registro()) {
            $paseador = new Paseador($datos[0], $datos[1], "",$datos[2], $datos[3], $datos[4]);
            array_push($paseadores, $paseador);
        }
        $conexion->cerrar();
        return $paseadores;
    }

    public function crear() {
        $conexion = new Conexion();
        $paseadorDAO = new PaseadorDAO(
            $this->id,
            $this->nombre,
            $this->apellido,
            $this->foto,
            $this->correo,
            $this->telefono,
            $this->clave
            );
        
        $conexion->abrir();

        try{
            $conexion->ejecutar("SELECT idPaseador FROM paseador WHERE idPaseador = '" . $this->id . "'");
            if($conexion->filas() > 0) {
                $conexion->cerrar();
                throw new Exception("El ID del paseador ya existe");
            }

            $conexion->ejecutar("SELECT idPaseador FROM paseador WHERE correo = '" . $this->correo . "'");
            if($conexion->filas() > 0) {
                $conexion->cerrar();
                throw new Exception("El correo electrónico ya está registrado");
            }
            $conexion->ejecutar($paseadorDAO->crear());
            $resultado = true;

        }catch(Exception){
            $resultado = false;

        }finally{
            $conexion->cerrar();
        }

        return $resultado;
    }

    public function actualizar() {
        $conexion = new Conexion();
        $paseadorDAO = new PaseadorDAO(
            $this->id,
            $this->nombre,
            $this->apellido,
            $this->foto,
            $this->correo,
            $this->telefono
            );
        
        $conexion->abrir();

        try{
            $conexion->ejecutar("SELECT idPaseador FROM paseador WHERE correo = '" . $this->correo . "' AND idPaseador != '" . $this->id . "'");
            if($conexion->filas() > 0) {
                $conexion->cerrar();
                throw new Exception("El correo electrónico ya está registrado en otro paseador");
            }
            $conexion->ejecutar($paseadorDAO->actualizar());
            $resultado = true;

        }catch(Exception){
            $resultado = false;

        }finally{
            $conexion->cerrar();

        }
        return $resultado;
    }
    
    public function actualizarClave($nuevaClave) {
        $conexion = new Conexion();
        $paseadorDAO = new PaseadorDAO($this->id, "", "", $nuevaClave);
        
        $conexion->abrir();

        try{
            $conexion->ejecutar($paseadorDAO->actualizarClave());
            $resultado = true;

        }catch(Exception){
            $resultado = false;

        }finally{
            $conexion->cerrar();
        }
        return $resultado;
    }

    public function eliminar() {
        $conexion = new Conexion();
        $paseadorDAO = new PaseadorDAO($this->id);
        
        $conexion->abrir();
        
        try{
            $conexion->ejecutar("SELECT foto FROM paseador WHERE idPaseador = '" . $this->id . "'");
            $foto = $conexion->registro()[0];
            
            $conexion->ejecutar($paseadorDAO->eliminar());
            $resultado = true;

        }catch(Exeption){
            $resultado = false;

        }finally{
            $conexion->cerrar();
        }
        if($resultado && $foto != 'img/default-profile.png' && file_exists($foto)) {
                unlink($foto); 
            }
        
        return $resultado;
    }
}
?>