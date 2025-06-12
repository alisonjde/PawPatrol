<style>
.dropdown-item:hover {
    background-color: #3A3A72 !important; */
    color: #ffffff !important;
}
</style>

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #1A1A2E;">
    <div class="container">
        <a class="navbar-brand fs-4" href="?pid=<?php echo base64_encode("presentacion/sesionDueño.php") ?>">🐾 Perritours</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarDueñoContent"
            aria-controls="navbarDueñoContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarDueñoContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <!--Menú mis perritos-->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Mis Perritos
                    </a>
                    <ul class="dropdown-menu" style="background-color: #23234A;">
                        <li><a class="dropdown-item text-light" href="?pid=<?php echo base64_encode("presentacion/perro/consultarPorDueño.php") ?>">Consultar</a></li>
                        <li><a class="dropdown-item text-light" href="?pid=<?php echo base64_encode("presentacion/perro/crearPerro.php") ?>">Agregar</a></li>
                    </ul>
                </li>

                <!--Menú paseos-->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Paseos
                    </a>
                    <ul class="dropdown-menu" style="background-color: #23234A;">
                        <li><a class="dropdown-item text-light" href="#">Agendar Paseo</a></li>
                        <a class="dropdown-item text-light" href="?pid=<?php echo base64_encode("presentacion/paseito/consultarPaseo.php") ?>">Consultar paseos</a>
                    </ul>
                </li>
            </ul>
            <a href="?pid=<?php echo base64_encode("presentacion/autenticar.php") ?>&sesion=false"
                class="btn btn-outline-light" type="submit">Cerrar Sesión</a>
        </div>
    </div>
</nav>
