<?php
require("logica/Paseador.php");

$filtro = isset($_GET['filtro']) ? trim($_GET['filtro']) : '';


$paseador = new Paseador();
$paseadores = $paseador->buscar($filtro);

$resultados = [];


if (count($paseadores) > 0) {
    foreach ($paseadores as $p) {
        echo '
        <div class="col-md-4 mb-4">
          <a href="#" class="text-decoration-none text-dark">
            <div class="card h-100 shadow">
              <img src="' . $p->getFoto() . '" class="card-img-top" alt="Foto de ' . $p->getNombre() . '">
              <div class="card-body">
                <h5 class="card-title">' . resaltarCoincidencias($p->getNombre() . ' ' . $p->getApellido(), $filtro) . '</h5>
                <p class="card-text"><strong>Correo:</strong> ' . resaltarCoincidencias($p->getCorreo(), $filtro) . '</p>
                <p class="card-text"><strong>Teléfono:</strong> ' . resaltarCoincidencias($p->getTelefono(), $filtro) . '</p>
                <p class="card-text"><strong>Descripción:</strong> ' . resaltarCoincidencias($p->getDescripcion(), $filtro) . '</p>

              </div>
            </div>
          </a>
        </div>';
    }
} else {
    echo "<div class='alert alert-warning text-center w-100' role='alert'>No se encontraron paseadores.</div>";
}


function resaltarCoincidencias($texto, $filtro)
{
    $palabras = explode(" ", trim($filtro));
    foreach ($palabras as $palabra) {
        if (stripos($texto, $palabra) !== false) {
            $texto = preg_replace("/(" . preg_quote($palabra, '/') . ")/i", "<strong>$1</strong>", $texto);
        }
    }
    return $texto;
}
