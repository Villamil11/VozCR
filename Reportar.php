
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reportar Incidente</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>
    <h1>VozCR</h1>
</header>

<nav>
    <a href="index.php">Inicio</a>
    <a href="reportar.php">Reportar</a>
    <a href="reportes.php">Reportes</a>
    <a href="admin.php">Administrador</a>
</nav> 

<!-- Main de reportes-->



<main>

<div class="formulario-reportar">

<h2>Reportar Incidente</h2>

<form action="#" method="post">

<div class="form-group">
<label>Título</label>
<input type="text" name="titulo">
</div>

<div class="form-group">
<label>Categoría</label>
<select name="categoria">
<option>Baches</option>
<option>Basura</option>
<option>Alumbrado</option>
<option>Parques</option>
<option>Seguridad</option>
</select>
</div>

<div class="form-group">
<label>Descripción</label>
<textarea name="descripcion"></textarea>
</div>

<div class="form-group">
<label>Ubicación</label>
<input type="text" name="ubicacion">
</div>

<button class="boton-enviar" type="submit">
Enviar Reporte
</button>

</form>

</div>

</main>

