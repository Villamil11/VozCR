<div class="admin-filtros">
    <select id="filtroEstado">
        <option value="">Todos los estados</option>
        <option value="pendiente">Pendiente</option>
        <option value="proceso">En proceso</option>
        <option value="resuelto">Resuelto</option>
    </select>

    <input type="text" id="filtroTexto" placeholder="🔎 Buscar por categoría o ubicación...">
</div>

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
                <span class="estado <?php echo $reporte['estado'] ?? 'pendiente'; ?>">
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
    </tbody>
</table>