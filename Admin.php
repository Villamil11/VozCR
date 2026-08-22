<?php

require_once 'Config/database.php';

$database = new Database();
$db = $database->connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $reporte_id = (int) ($_POST['reporte_id'] ?? 0);
    $nuevo_estado = $_POST['nuevo_estado'] ?? '';

    $estados_validos = [
        'pendiente',
        'proceso',
        'resuelto'
    ];

    if (
        $reporte_id > 0 &&
        in_array($nuevo_estado, $estados_validos, true)
    ) {

        $sql = "UPDATE reportes
                SET estado = :estado
                WHERE id = :id";

        $stmt = $db->prepare($sql);

        $stmt->execute([
            ':estado' => $nuevo_estado,
            ':id' => $reporte_id
        ]);
    }
}



$sql = "SELECT * FROM reportes ORDER BY fecha_registro DESC";

$stmt = $db->prepare($sql);
$stmt->execute();

$reportes = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>VozCR | Administrador</title>

    <link rel="stylesheet" href="css/admin.css">

</head>

<body>



<header>

    <h1>VozCR</h1>

    <p>
        Panel de Administración
    </p>

</header>



<nav>

    <a href="index.php">
        Inicio
    </a>

    <a href="reportar.php">
        Reportar
    </a>

    <a href="reportes.php">
        Reportes
    </a>

    <a href="admin.php">
        Administrador
    </a>

    <a href="app/logout.php">
        Cerrar sesión
    </a>

</nav>



<main>

    <h2>
        Gestión de reportes
    </h2>

    <?php

$totalReportes = count($reportes);

$pendientes = 0;
$proceso = 0;
$resueltos = 0;

foreach ($reportes as $reporte) {

    $estado = $reporte['estado'] ?? 'pendiente';

    if ($estado === 'pendiente') {
        $pendientes++;
    }

    if ($estado === 'proceso') {
        $proceso++;
    }

    if ($estado === 'resuelto') {
        $resueltos++;
    }
}

?>

<section class="estadisticas-admin">

    <div class="estadistica-admin">
        <span><?php echo $totalReportes; ?></span>
        <p>Total de reportes</p>
    </div>

    <div class="estadistica-admin pendiente-box">
        <span><?php echo $pendientes; ?></span>
        <p>Pendientes</p>
    </div>

    <div class="estadistica-admin proceso-box">
        <span><?php echo $proceso; ?></span>
        <p>En proceso</p>
    </div>

    <div class="estadistica-admin resuelto-box">
        <span><?php echo $resueltos; ?></span>
        <p>Resueltos</p>
    </div>

</section>

<?php

$categorias = [
    'Huecos en carretera' => 0,
    'Basura acumulada' => 0,
    'Alumbrado público' => 0,
    'Seguridad' => 0,
    'Daños en infraestructura' => 0
];

foreach ($reportes as $reporte) {

    $categoria = $reporte['categoria'] ?? '';

    if (isset($categorias[$categoria])) {
        $categorias[$categoria]++;
    }
}

$totalCategorias = max($totalReportes, 1);

?>

<section class="categorias-admin">

    <h3>
        Reportes por categoría
    </h3>

    <?php foreach ($categorias as $categoria => $cantidad): ?>

        <?php
        $porcentaje = ($cantidad / $totalCategorias) * 100;
        ?>

        <div class="categoria-barra">

            <div class="categoria-info">

                <span>
                    <?php echo htmlspecialchars($categoria); ?>
                </span>

                <strong>
                    <?php echo $cantidad; ?>
                </strong>

            </div>

            <div class="barra-fondo">

                <div
                    class="barra-progreso"
                    style="width: <?php echo $porcentaje; ?>%;"
                ></div>

            </div>

        </div>

    <?php endforeach; ?>

</section>

    


    <div class="admin-filtros">

        <select id="filtroEstado">

            <option value="">
                Todos los estados
            </option>

            <option value="pendiente">
                Pendiente
            </option>

            <option value="proceso">
                En proceso
            </option>

            <option value="resuelto">
                Resuelto
            </option>

        </select>


        <input
            type="text"
            id="filtroTexto"
            placeholder="🔎 Buscar por categoría o ubicación..."
        >

    </div>


    <table
        class="admin-tabla"
        id="tablaReportes"
    >

        <thead>

            <tr>

                <th>
                    Categoría
                </th>

                <th>
                    Ubicación
                </th>

                <th>
                    Estado
                </th>

                <th>
                    Acción
                </th>

            </tr>

        </thead>


        <tbody>

            <?php foreach ($reportes as $reporte): ?>

                <?php

                $estado = $reporte['estado'] ?? 'pendiente';

                ?>

                <tr
                    data-estado="<?php echo htmlspecialchars($estado); ?>"
                >


                    <!-- CATEGORÍA -->

                    <td>

                        <?php

                        echo htmlspecialchars(
                            $reporte['categoria'],
                            ENT_QUOTES,
                            'UTF-8'
                        );

                        ?>

                    </td>


                    <!-- UBICACIÓN -->

                    <td>

                        <?php

                        echo htmlspecialchars(
                            $reporte['ubicacion'],
                            ENT_QUOTES,
                            'UTF-8'
                        );

                        ?>

                    </td>


                 

                    <td>

                        <span
                            class="estado <?php echo htmlspecialchars($estado); ?>"
                        >

                            <?php

                            if ($estado === 'pendiente') {

                                echo 'Pendiente';

                            } elseif ($estado === 'proceso') {

                                echo 'En proceso';

                            } elseif ($estado === 'resuelto') {

                                echo 'Resuelto';

                            }

                            ?>

                        </span>

                    </td>


                    <!-- ACCIÓN -->

                    <td>

                        <form
                            method="POST"
                            action="admin.php"
                            class="form-estado"
                        >


                            <!-- ID DEL REPORTE -->

                            <input
                                type="hidden"
                                name="reporte_id"
                                value="<?php echo (int) $reporte['id']; ?>"
                            >


                            <!-- SELECT DE ESTADO -->

                            <select name="nuevo_estado">


                                <option
                                    value="pendiente"

                                    <?php

                                    echo $estado === 'pendiente'
                                        ? 'selected'
                                        : '';

                                    ?>

                                >

                                    Pendiente

                                </option>


                                <option
                                    value="proceso"

                                    <?php

                                    echo $estado === 'proceso'
                                        ? 'selected'
                                        : '';

                                    ?>

                                >

                                    En proceso

                                </option>


                                <option
                                    value="resuelto"

                                    <?php

                                    echo $estado === 'resuelto'
                                        ? 'selected'
                                        : '';

                                    ?>

                                >

                                    Resuelto

                                </option>


                            </select>


                            <!-- BOTÓN -->

                            <button
                                type="submit"
                                class="btn"
                            >

                                Guardar

                            </button>


                        </form>

                    </td>

                </tr>


            <?php endforeach; ?>

        </tbody>

    </table>

</main>



<script src="js/admin.js"></script>


</body>

</html>