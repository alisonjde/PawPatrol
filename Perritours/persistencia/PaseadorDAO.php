<?php
class PaseadorDAO
{
    private $id;
    private $nombre;
    private $apellido;
    private $foto;
    private $correo;
    private $telefono;
    private $clave;
    private $descripcion;
    private $disponibilidad;


    public function __construct($id = 0, $nombre = "", $apellido = "", $foto = "", $correo = "", $telefono = 0, $clave = "", $descripcion = "", $disponibilidad = "")
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->foto = $foto;
        $this->correo = $correo;
        $this->telefono = $telefono;
        $this->clave = $clave;
        $this->descripcion = $descripcion;
        $this->disponibilidad = $disponibilidad;
    }


    public function autenticar()
    {
        return "SELECT idPaseador
                FROM paseador
                WHERE correo = '" . $this->correo . "' AND clave = '" . $this->clave . "'";
    }

    public function consultar()
    {
        return "SELECT nombre, correo, telefono, foto
                FROM paseador
                WHERE idPaseador = '" . $this->id . "'";
    }

    public function consultarTodos()
    {
        return "SELECT idPaseador, nombre, apellido, foto, correo, telefono, descripcion, disponibilidad
            FROM paseador
            ORDER BY nombre";
    }


    public function crear()
    {
        return "INSERT INTO paseador 
    (idPaseador, nombre, apellido, foto, correo, telefono, clave, descripcion, disponibilidad)
    VALUES 
    ('" . $this->id . "',
     '" . $this->nombre . "',
     '" . $this->apellido . "',
     '" . $this->foto . "',
     '" . $this->correo . "',
     '" . $this->telefono . "',
     '" . $this->clave . "',
     '" . $this->descripcion . "',
     '" . $this->disponibilidad . "')";
    }


    public function actualizar()
    {
        return "UPDATE paseador SET
            nombre = '" . $this->nombre . "',
            apellido = '" . $this->apellido . "',
            foto = '" . $this->foto . "',
            correo = '" . $this->correo . "',
            telefono = " . $this->telefono . ",
            WHERE idPaseador = '" . $this->id . "'";
    }


    public function actualizarClave()
    {
        return "UPDATE paseador SET
            clave = '" . md5($this->clave) . "'
            WHERE idPaseador = '" . $this->id . "'";
    }

    public function eliminar()
    {
        return "DELETE FROM paseador WHERE idPaseador = '" . $this->id . "'";
    }


    public function buscar($filtro)
    {
        $palabras = array_filter(explode(" ", trim($filtro)));


        $condiciones = [];
        foreach ($palabras as $palabra) {
            $palabra = trim($palabra);
            $condiciones[] = "(nombre LIKE '%$palabra%' 
                          OR apellido LIKE '%$palabra%' 
                          OR correo LIKE '%$palabra%' 
                          OR telefono LIKE '%$palabra%' 
                          OR disponibilidad LIKE '%$palabra%')";
        }


        $where = count($condiciones) > 0 ? "WHERE " . implode(" AND ", $condiciones) : "";


        $sql = "SELECT idPaseador, nombre, apellido, foto, correo, telefono, descripcion, disponibilidad 
            FROM paseador
            $where
            ORDER BY nombre ASC";

        return $sql;
    }
}
