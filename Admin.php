<?php
/**
 * admin.php - Panel de administración de reportes
 * ------------------------------------------------
 * Sin base de datos / sin SQL: los reportes se guardan en un archivo
 * JSON local (reportes.json). Si tú ya tienes tu propia fuente de datos
 * (otro archivo, una API, sesión, etc.) reemplaza únicamente las
 * funciones "cargarReportes()" y "guardarReportes()" de más abajo,
 * el resto del panel (filtros, tabla, formulario) sigue igual.
 */

session_start();

// =====================================================
// "BASE DE DATOS" EN ARCHIVO JSON (sin SQL)
// =====================================================
$archivoDatos = __DIR__ . '/reportes.json';

function cargarReportes(string $archivo): array {
    if (!file_exists($archivo)) {
        // Datos de ejemplo iniciales si el archivo aún no existe
        $inicial = [
            ['id' => 1, 'categoria' => 'Bache en la vía',        'ubicacion' => 'Calle 5, San José',      'estado' => 'pendiente'],
            ['id' => 2, 'categoria' => 'Alumbrado público',      'ubicacion' => 'Barrio Escalante',       'estado' => 'proceso'],
            ['id' => 3, 'categoria' => 'Fuga de agua',           'ubicacion' => 'Av. Central',            'estado' => 'resuelto'],
        ];
        file_put_contents($archivo, json_encode($inicial, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        return $inicial;
    }

    $contenido = file_get_contents($archivo);
    $datos = json_decode($contenido, true);
    return is_array($datos) ? $datos : [];
}

function guardarReportes(string $archivo, array $reportes): void {
    file_put_contents($archivo, json_encode($reportes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

$reportes = cargarReportes($archivoDatos);

// =====================================================
// MANEJO DEL FORMULARIO (cambiar estado de un reporte)
// =====================================================
$mensaje = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reporte_id'], $_POST['nuevo_estado'])) {
    $id = (int) $_POST['reporte_id'];
    $estadosValidos = ['pendiente', 'proceso', 'resuelto'];
    $nuevoEstado = in_array($_POST['nuevo_estado'], $estadosValidos, true)
        ? $_POST['nuevo_estado']
        : 'pendiente';

    foreach ($reportes as &$r) {
        if ((int) $r['id'] === $id) {
            $r['estado'] = $nuevoEstado;
            break;
        }
    }
    unset($r);

    guardarReportes($archivoDatos, $reportes);

    // Evita reenvío del formulario al recargar
    header('Location: admin.php?ok=1');
    exit;
}

if (isset($_GET['ok'])) {
    $mensaje = 'Estado actualizado correctamente.';
}

// Conteos rápidos para las tarjetas resumen
$totales = ['pendiente' => 0, 'proceso' => 0, 'resuelto' => 0];
foreach ($reportes as $r) {
    $e = $r['estado'] ?? 'pendiente';
    if (isset($totales[$e])) $totales[$e]++;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Panel de Administración · Reportes</title>
<style>
    :root {
        --bg: #0f172a;
        --panel: #ffffff;
        --panel-alt: #f8fafc;
        --border: #e2e8f0;
        --text: #1e293b;
        --text-muted: #64748b;
        --primary: #4f46e5;
        --primary-dark: #4338ca;
        --pendiente: #f59e0b;
        --pendiente-bg: #fef3c7;
        --proceso: #3b82f6;
        --proceso-bg: #dbeafe;
        --resuelto: #10b981;
        --resuelto-bg: #d1fae5;
        --shadow: 0 1px 3px rgba(0,0,0,0.06), 0 1px 2px rgba(0,0,0,0.04);
        --shadow-lg: 0 10px 25px -5px rgba(0,0,0,0.08), 0 8px 10px -6px rgba(0,0,0,0.04);
    }

    * { box-sizing: border-box; }

    body {
        margin: 0;
        font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        background: linear-gradient(180deg, #eef2ff 0%, #f8fafc 260px, #f8fafc 100%);
        color: var(--text);
        min-height: 100vh;
        padding-bottom: 60px;
    }

    .admin-header {
        background: linear-gradient(135deg, var(--bg) 0%, #1e293b 100%);
        color: #fff;
        padding: 28px 40px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: var(--shadow-lg);
    }

    .admin-header h1 {
        margin: 0;
        font-size: 22px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .admin-header p {
        margin: 4px 0 0;
        font-size: 13px;
        color: #cbd5e1;
    }

    .admin-container {
        max-width: 1100px;
        margin: -30px auto 0;
        padding: 0 24px;
    }

    /* Alerta de confirmación */
    .admin-alerta {
        background: var(--resuelto-bg);
        color: #065f46;
        border: 1px solid #a7f3d0;
        padding: 12px 18px;
        border-radius: 10px;
        margin-bottom: 20px;
        font-size: 14px;
        font-weight: 500;
        box-shadow: var(--shadow);
    }

    /* Tarjetas resumen */
    .admin-resumen {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin-bottom: 24px;
    }

    .tarjeta {
        background: var(--panel);
        border-radius: 14px;
        padding: 18px 20px;
        box-shadow: var(--shadow);
        border: 1px solid var(--border);
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .tarjeta .icono {
        width: 42px;
        height: 42px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
    }

    .tarjeta.pendiente .icono { background: var(--pendiente-bg); color: var(--pendiente); }
    .tarjeta.proceso .icono { background: var(--proceso-bg); color: var(--proceso); }
    .tarjeta.resuelto .icono { background: var(--resuelto-bg); color: var(--resuelto); }

    .tarjeta .num { font-size: 22px; font-weight: 700; line-height: 1; }
    .tarjeta .lbl { font-size: 12px; color: var(--text-muted); margin-top: 2px; }

    /* Panel principal */
    .admin-panel {
        background: var(--panel);
        border-radius: 16px;
        box-shadow: var(--shadow-lg);
        border: 1px solid var(--border);
        overflow: hidden;
    }

    .admin-filtros {
        display: flex;
        gap: 12px;
        padding: 20px 24px;
        border-bottom: 1px solid var(--border);
        background: var(--panel-alt);
        flex-wrap: wrap;
    }

    .admin-filtros select,
    .admin-filtros input {
        padding: 10px 14px;
        border-radius: 10px;
        border: 1px solid var(--border);
        font-size: 14px;
        background: #fff;
        color: var(--text);
        outline: none;
        transition: border-color .15s, box-shadow .15s;
    }

    .admin-filtros select:focus,
    .admin-filtros input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(79,70,229,0.15);
    }

    .admin-filtros select { min-width: 180px; cursor: pointer; }
    .admin-filtros input { flex: 1; min-width: 220px; }

    /* Tabla */
    .admin-tabla-wrap { overflow-x: auto; }

    .admin-tabla {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
    }

    .admin-tabla thead th {
        text-align: left;
        padding: 14px 24px;
        background: var(--panel-alt);
        color: var(--text-muted);
        font-weight: 600;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: .04em;
        border-bottom: 1px solid var(--border);
    }

    .admin-tabla tbody tr {
        border-bottom: 1px solid var(--border);
        transition: background .12s;
    }

    .admin-tabla tbody tr:hover { background: #f8fafc; }
    .admin-tabla tbody tr:last-child { border-bottom: none; }

    .admin-tabla td {
        padding: 14px 24px;
        vertical-align: middle;
    }

    .admin-tabla td[data-label="Categoría"] { font-weight: 600; }
    .admin-tabla td[data-label="Ubicación"] { color: var(--text-muted); }

    /* Badges de estado */
    .estado {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 600;
        text-transform: capitalize;
    }

    .estado::before {
        content: "";
        width: 7px;
        height: 7px;
        border-radius: 50%;
    }

    .estado.pendiente { background: var(--pendiente-bg); color: #92400e; }
    .estado.pendiente::before { background: var(--pendiente); }

    .estado.proceso { background: var(--proceso-bg); color: #1e40af; }
    .estado.proceso::before { background: var(--proceso); }

    .estado.resuelto { background: var(--resuelto-bg); color: #065f46; }
    .estado.resuelto::before { background: var(--resuelto); }

    /* Formulario de cambio de estado */
    .form-estado {
        display: flex;
        gap: 8px;
        align-items: center;
        margin: 0;
    }

    .form-estado select {
        padding: 7px 10px;
        border-radius: 8px;
        border: 1px solid var(--border);
        font-size: 13px;
        background: #fff;
        cursor: pointer;
    }

    .btn {
        padding: 7px 14px;
        border: none;
        border-radius: 8px;
        background: var(--primary);
        color: #fff;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: background .15s, transform .1s;
    }

    .btn:hover { background: var(--primary-dark); }
    .btn:active { transform: scale(0.97); }

    .sin-resultados {
        text-align: center;
        padding: 48px 24px;
        color: var(--text-muted);
        font-size: 14px;
    }

    /* Responsive: tabla tipo tarjetas en móvil */
    @media (max-width: 720px) {
        .admin-header { padding: 22px; }
        .admin-container { padding: 0 14px; }
        .admin-resumen { grid-template-columns: 1fr; }

        .admin-tabla thead { display: none; }
        .admin-tabla, .admin-tabla tbody, .admin-tabla tr, .admin-tabla td {
            display: block;
            width: 100%;
        }
        .admin-tabla tr {
            padding: 14px 18px;
            border-bottom: 8px solid var(--panel-alt);
        }
        .admin-tabla td {
            padding: 8px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
        }
        .admin-tabla td::before {
            content: attr(data-label);
            font-weight: 600;
            color: var(--text-muted);
            font-size: 12px;
            text-transform: uppercase;
        }
        .form-estado { flex: 1; justify-content: flex-end; }
    }
</style>
</head>
<body>

<header class="admin-header">
    <div>
        <h1>🛠️ Panel de Administración</h1>
        <p>Gestión de reportes ciudadanos</p>
    </div>
</header>

<div class="admin-container">

    <?php if ($mensaje): ?>
        <div class="admin-alerta">✅ <?php echo htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8'); ?></div>
    <?php endif; ?>

    <div class="admin-resumen">
        <div class="tarjeta pendiente">
            <div class="icono">⏳</div>
            <div>
                <div class="num"><?php echo $totales['pendiente']; ?></div>
                <div class="lbl">Pendientes</div>
            </div>
        </div>
        <div class="tarjeta proceso">
            <div class="icono">⚙️</div>
            <div>
                <div class="num"><?php echo $totales['proceso']; ?></div>
                <div class="lbl">En proceso</div>
            </div>
        </div>
        <div class="tarjeta resuelto">
            <div class="icono">✅</div>
            <div>
                <div class="num"><?php echo $totales['resuelto']; ?></div>
                <div class="lbl">Resueltos</div>
            </div>
        </div>
    </div>

    <div class="admin-panel">
        <div class="admin-filtros">
            <select id="filtroEstado">
                <option value="">Todos los estados</option>
                <option value="pendiente">Pendiente</option>
                <option value="proceso">En proceso</option>
                <option value="resuelto">Resuelto</option>
            </select>
            <input type="text" id="filtroTexto" placeholder="🔎 Buscar por categoría o ubicación...">
        </div>

        <div class="admin-tabla-wrap">
            <table class="admin-tabla" id="tablaReportes">
                <thead>
                    <tr>
                        <th>Categoría</th>
                        <th>Ubicación</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reportes as $reporte): ?>
                    <tr data-estado="<?php echo htmlspecialchars($reporte['estado'] ?? 'pendiente'); ?>">
                        <td data-label="Categoría"><?php echo htmlspecialchars($reporte['categoria'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td data-label="Ubicación"><?php echo htmlspecialchars($reporte['ubicacion'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td data-label="Estado">
                            <span class="estado <?php echo htmlspecialchars($reporte['estado'] ?? 'pendiente', ENT_QUOTES, 'UTF-8'); ?>">
                                <?php echo htmlspecialchars($reporte['estado'] ?? 'Pendiente', ENT_QUOTES, 'UTF-8'); ?>
                            </span>
                        </td>
                        <td data-label="Acción">
                            <form method="POST" action="admin.php" class="form-estado">
                                <input type="hidden" name="reporte_id" value="<?php echo (int) $reporte['id']; ?>">
                                <select name="nuevo_estado">
                                    <option value="pendiente" <?php echo ($reporte['estado'] ?? '') === 'pendiente' ? 'selected' : ''; ?>>Pendiente</option>
                                    <option value="proceso" <?php echo ($reporte['estado'] ?? '') === 'proceso' ? 'selected' : ''; ?>>En proceso</option>
                                    <option value="resuelto" <?php echo ($reporte['estado'] ?? '') === 'resuelto' ? 'selected' : ''; ?>>Resuelto</option>
                                </select>
                                <button type="submit" class="btn">Guardar</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($reportes)): ?>
                    <tr>
                        <td colspan="4" class="sin-resultados">No hay reportes registrados todavía.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <p class="sin-resultados" id="sinResultadosJS" style="display:none;">No se encontraron reportes con esos filtros.</p>
        </div>
    </div>
</div>

<script>
(function () {
    const filtroEstado = document.getElementById('filtroEstado');
    const filtroTexto = document.getElementById('filtroTexto');
    const filas = Array.from(document.querySelectorAll('#tablaReportes tbody tr[data-estado]'));
    const mensajeVacio = document.getElementById('sinResultadosJS');

    function normalizar(texto) {
        return texto.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '');
    }

    function aplicarFiltros() {
        const estado = filtroEstado.value;
        const texto = normalizar(filtroTexto.value.trim());
        let visibles = 0;

        filas.forEach((fila) => {
            const filaEstado = fila.getAttribute('data-estado');
            const categoria = normalizar(fila.querySelector('[data-label="Categoría"]')?.textContent || '');
            const ubicacion = normalizar(fila.querySelector('[data-label="Ubicación"]')?.textContent || '');

            const coincideEstado = !estado || filaEstado === estado;
            const coincideTexto = !texto || categoria.includes(texto) || ubicacion.includes(texto);

            const mostrar = coincideEstado && coincideTexto;
            fila.style.display = mostrar ? '' : 'none';
            if (mostrar) visibles++;
        });

        mensajeVacio.style.display = visibles === 0 ? 'block' : 'none';
    }

    filtroEstado.addEventListener('change', aplicarFiltros);
    filtroTexto.addEventListener('input', aplicarFiltros);
})();
</script>

</body>
</html>
