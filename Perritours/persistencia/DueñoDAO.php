<?php

class DueñoDAO {
    private $id;
    private $nombre;
    private $apellido;
    private $foto;
    private $correo;
    private $telefono;
    private $clave;
    
    
    public function __construct($id = "", $nombre = "", $apellido = "", $foto = "", $correo = "", $telefono = 0, $clave = "") {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->foto = $foto;
        $this->correo = $correo;
        $this->telefono = $telefono;
        $this->clave = $clave;
    }
    
    public function autenticar() {
        return "SELECT idDueño
                FROM dueño
                WHERE correo = '" . $this->correo . "' AND clave = '" . md5($this->clave) . "'";
    }
    
    public function consultar() {
        return "SELECT nombre, correo, telefono
                FROM dueño
                WHERE idDueño = '" . $this->id . "'";
    }
    
    public function consultarTodos() {
        return "SELECT idDueño, nombre, apellido, correo, telefono FROM dueño";
    }
        


}