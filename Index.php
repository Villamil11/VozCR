<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VozCR | Inicio</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>
    <h1>VozCR</h1>
    <p>Plataforma Inteligente de Transparencia y Reporte Ciudadano</p>
</header>

<nav>
    <a href="index.php">Inicio</a>
    <a href="reportar.php">Reportar</a>
    <a href="reportes.php">Reportes</a>
    <a href="admin.php">Administrador</a>
</nav>

<section class="hero">
    <h2>Construyamos comunidades más transparentes</h2>

    <p>
        VozCR es una plataforma que permite a cualquier ciudadano reportar
        problemas de infraestructura y servicios públicos mediante fotografías,
        ubicación y descripciones, facilitando la comunicación con las instituciones
        responsables.
    </p>

    <a href="reportar.php" class="btn">Reportar incidente</a>
</section>

<section class="info">

    <h2>¿Por qué nace VozCR?</h2>

    <p>
        Muchas comunidades enfrentan problemas como huecos en carretera,
        basura acumulada, alumbrado público dañado y otros incidentes que afectan
        la calidad de vida. Sin una herramienta adecuada, estos reportes suelen perderse
        o tardar demasiado en ser atendidos.
    </p>

</section>

<section class="cards">

    <h2>¿Cómo funciona VozCR?</h2>

<div class="card">
    <h3>📍 Reportar incidentes</h3>
    <p>Registrar problemas de forma rápida y sencilla.</p>

    <div class="card-extra">
        <p>
            Los ciudadanos pueden registrar problemas de infraestructura
            o servicios públicos desde la plataforma.
        </p>
    </div>
</div>

<div class="card">
    <h3>📷 Adjuntar evidencia</h3>
    <p>Agregar imágenes y descripción del incidente.</p>

    <div class="card-extra">
        <p>
            El usuario puede proporcionar fotografías y detalles que
            ayuden a identificar correctamente el problema.
        </p>
    </div>
</div>

<div class="card">
    <h3>📊 Dar seguimiento</h3>
    <p>Consultar el estado del reporte en cualquier momento.</p>

    <div class="card-extra">
        <p>
            Los ciudadanos pueden consultar el progreso de los reportes
            realizados y conocer su estado actual.
        </p>
    </div>
</div>

<div class="card">
    <h3>🏛️ Transparencia</h3>
    <p>Mejor comunicación entre ciudadanos e instituciones.</p>

    <div class="card-extra">
        <p>
            La plataforma facilita la comunicación y permite dar mayor
            visibilidad a los problemas de las comunidades.
        </p>
    </div>
</div>

</section>

<section class="estadisticas">

    <h2>VozCR en números</h2>

    <div class="estadisticas-container">

        <div class="estadistica">
            <span class="numero" data-meta="125">0</span>
            <p>Reportes registrados</p>
        </div>

        <div class="estadistica">
            <span class="numero" data-meta="87">0</span>
            <p>Reportes atendidos</p>
        </div>

        <div class="estadistica">
            <span class="numero" data-meta="42">0</span>
            <p>Ciudadanos participantes</p>
        </div>

    </div>

</section>

<section class="categorias">

    <h2>Categorías disponibles</h2>

        <input 
        type="text" 
        id="buscadorCategorias" 
        placeholder="🔎 Buscar categoría..."
    >

<ul class="lista-categorias">

    <li class="categoria">
        <span>🚧 Huecos en carretera</span>
        <div class="categoria-info">
            Reportes relacionados con calles dañadas, baches y problemas
            en la superficie de las carreteras.
        </div>
    </li>

    <li class="categoria">
        <span>🗑️ Basura acumulada</span>
        <div class="categoria-info">
            Reportes sobre acumulación de basura, residuos en espacios
            públicos y problemas de recolección.
        </div>
    </li>

    <li class="categoria">
        <span>💡 Alumbrado público</span>
        <div class="categoria-info">
            Reportes sobre postes dañados, luminarias apagadas o problemas
            con el alumbrado de las calles.
        </div>
    </li>

    <li class="categoria">
        <span>🚓 Seguridad</span>
        <div class="categoria-info">
            Reportes relacionados con situaciones que puedan representar
            un problema para la seguridad de la comunidad.
        </div>
    </li>

    <li class="categoria">
        <span>🏗️ Daños en infraestructura</span>
        <div class="categoria-info">
            Reportes sobre parques, aceras, edificios públicos y otras
            estructuras que presenten daños.
        </div>
    </li>

</ul>

</section>

<section class="beneficios">

    <h2>Beneficios</h2>

    <ul>
        <li>✔ Mayor transparencia.</li>
        <li>✔ Mejor comunicación con las municipalidades.</li>
        <li>✔ Participación ciudadana.</li>
        <li>✔ Seguimiento de reportes.</li>
        <li>✔ Mejor planificación de recursos.</li>
    </ul>

</section>

<footer>
    <p>VozCR © 2026 | Proyecto Universitario - Universidad Fidélitas</p>
</footer>

    <script src="js/index.js"></script>

</body>
</html>