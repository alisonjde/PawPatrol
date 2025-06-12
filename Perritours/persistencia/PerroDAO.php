<?php
class PerroDAO {
    private $idPerro;
    private $nombre;
    private $foto;
    private $idTamaño;
    private $idDueño;
    
    public function __construct($idPerro = 0, $nombre = "", $foto = "", $idTamaño = "", $idDueño = 0) {
        $this->idPerro = $idPerro;
        $this->nombre = $nombre;
        $this->foto = $foto;
        $this->idTamaño = $idTamaño;
        $this->idDueño = $idDueño;
    }
    
    public function consultarTodos() {
        return "SELECT p.idPerro, p.nombre, p.tamaño_idTamaño, p.foto, d.nombre as nombre_dueño
                FROM perro p
                JOIN dueño d ON p.dueño_idDueño = d.idDueño
                ORDER BY p.nombre";
    }
    
    public function consultarPorDueño($idDueño) {
        return "SELECT p.idPerro, p.nombre, p.tamaño_idTamaño, p.foto, d.nombre as nombre_dueño
                FROM perro p
                JOIN dueño d ON p.dueño_idDueño = d.idDueño
                WHERE p.dueño_idDueño = $idDueño
                ORDER BY p.nombre";
    }

    public function consultarCantidad() {
        return "SELECT COUNT(idPerro) 
                FROM perro 
                WHERE dueño_idDueño = " . $this ->idDueño;
    }

    public function crear() {
        return "INSERT INTO perro (idPerro, nombre, foto, tamaño_idTamaño, dueño_idDueño)
            VALUES ('" . $this->idPerro . "',
                    '" . $this->nombre . "',
                    '" . $this->foto . "',
                     '" . $this->idTamaño . "',
                    " . $this->idDueño . ")";
    }
}
?>