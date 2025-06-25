<?php
if ($_SESSION["rol"] != "admin") {
    header("Location: ?pid=" . base64_encode("presentacion/noAutorizado.php"));
    exit();
}

?>
<style>
    .glass {
        background: rgba(50, 30, 80, 0.85);
        border-radius: 1rem;
        box-shadow: 0 8px 24px rgba(120, 50, 220, 0.3);
        backdrop-filter: blur(10px);
        color: #f0e6ff;
    }

    .table-custom {
        background-color: #2A1A40;
        border-collapse: collapse;
        color: #f5f0ff;
    }

    .table-custom th {
        background-color: #6A0DAD;
        color: #ffffff;
        border-bottom: 2px solid #B388EB;
        text-align: center;
    }

    .table-custom td {
        background-color: #3D2B56;
        color: #f5f0ff;
        border-top: 1px solid #6A0DAD;
        vertical-align: middle;
    }

    .table-custom tr:hover {
        background-color: #5C4B89;
        transition: background-color 0.3s ease;
    }
</style>

<body>
    <?php
    include("presentacion/fondo.php");
    include("presentacion/admin/menuAdmin.php");
    ?>

    <div class="text-center py-3 hero-text">
        <div class="container glass py-3">
            <h1 class="display-6">Listado de Dueños</h1>

            <div class="mb-4 text-center">
                <input type="text" id="filtro" class="form-control w-50 mx-auto"
                    placeholder="Buscar dueño por nombre, correo o teléfono...">
            </div>

            <div class="table-responsive" id="resultados">
                
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $("#filtro").keyup(function () {
                if ($("#filtro").val().length > 2) {
                    var ruta = "buscarDueñoAjax.php?filtro=" + $("#filtro").val().replaceAll(" ", "%20");
                    $("#resultados").load(ruta);
                }
            });
        });
    </script>
</body>