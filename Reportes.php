<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reportes</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>
    <h1>VozCR</h1>
     <p>Reportes Ciudadanos</p>
</header>

<nav>
    <a href="index.php">Inicio</a>
    <a href="reportar.php">Reportar</a>
    <a href="reportes.php">Reportes</a>
    <a href="admin.php">Administrador</a>
</nav>



<main>
    <main>

<section class="lista-reportes">

    <h2>Todos los Reportes</h2>

    <div class="reporte-card">

        <h3>Hueco en la Calle Principal</h3>

        <p><strong>Categoría:</strong> Infraestructura</p>

        <p><strong>Ubicación:</strong> Frente al Parque Central</p>

        <p><strong>Estado:</strong>
            <span class="estado pendiente">Pendiente</span>
        </p>

        <a href="detalle_reporte.php" class="btn">
            Ver Detalles
        </a>

    </div>

    <div class="reporte-card">

        <h3>Lámpara Dañada</h3>

        <p><strong>Categoría:</strong> Alumbrado Público</p>

        <p><strong>Ubicación:</strong> Barrio San José</p>

        <p><strong>Estado:</strong>
            <span class="estado proceso">En Proceso</span>
        </p>

        <a href="detalle_reporte.php" class="btn">
            Ver Detalles
        </a>

    </div>

    <div class="reporte-card">

        <h3>Basura Acumulada</h3>

        <p><strong>Categoría:</strong> Limpieza</p>

        <p><strong>Ubicación:</strong> Avenida Central</p>

        <p><strong>Estado:</strong>
            <span class="estado resuelto">Resuelto</span>
        </p>

        <a href="detalle_reporte.php" class="btn">
            Ver Detalles
        </a>

    </div>

</section>

</main>

<footer>
    <p>&copy; 2026 VozCR - Municipalidad</p>
</footer>

</body>
</html>
