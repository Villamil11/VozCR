<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VozCR | Reportar</title>
    <link rel="stylesheet" href="CSS/Style.css">
</head>

<body>

<header>
    <h1>VozCR</h1>
    <p>Plataforma Inteligente de Transparencia y Reporte Ciudadano</p>
</header>

<nav>
    <a href="Index.php">Inicio</a>
    <a href="Reportar.php">Reportar</a>
    <a href="Informes.php">Reportes</a>
    <a href="Admin.php">Administrador</a>
</nav>

<section class="hero">

    <h2>Reportar un incidente</h2>

    <p>
        Complete el siguiente formulario para informar sobre un problema en su comunidad.
        Su reporte ayudará a mejorar la atención de las instituciones responsables.
    </p>

</section>

<section class="info">

    <h2>Formulario de Reporte</h2>

    <form method="POST">

        <p>
            <label>Nombre completo</label><br>
            <input type="text" name="nombre" required>
        </p>

        <p>
            <label>Correo electrónico</label><br>
            <input type="email" name="correo" required>
        </p>

        <p>
            <label>Categoría</label><br>

            <select name="categoria">

                <option>Huecos en carretera</option>
                <option>Basura acumulada</option>
                <option>Alumbrado público</option>
                <option>Seguridad</option>
                <option>Daños en infraestructura</option>

            </select>

        </p>

        <p>
            <label>Ubicación</label><br>
            <input type="text" name="ubicacion" required>
        </p>

        <p>
            <label>Descripción del incidente</label><br>

            <textarea
                name="descripcion"
                rows="6"
                required></textarea>

        </p>

        <p>
            <label>Fotografía (Opcional)</label><br>
            <input type="file" name="imagen">
        </p>

        <br>

        <input type="submit" value="Enviar Reporte" class="btn">

    </form>

</section>

<?php

if(isset($_POST["nombre"])){

    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $categoria = $_POST["categoria"];
    $ubicacion = $_POST["ubicacion"];
    $descripcion = $_POST["descripcion"];

?>

<section class="cards">

    <h2>Reporte recibido</h2>

    <div class="card">

        <h3>Información enviada</h3>

        <p><strong>Nombre:</strong> <?php echo $nombre; ?></p>

        <p><strong>Correo:</strong> <?php echo $correo; ?></p>

        <p><strong>Categoría:</strong> <?php echo $categoria; ?></p>

        <p><strong>Ubicación:</strong> <?php echo $ubicacion; ?></p>

        <p><strong>Descripción:</strong> <?php echo $descripcion; ?></p>

        <p><strong>Estado:</strong> Pendiente de revisión.</p>

    </div>

</section>

<?php
}
?>

<footer>

    <p>VozCR © 2026 | Proyecto Universitario - Universidad Fidélitas</p>

</footer>

</body>
</html>