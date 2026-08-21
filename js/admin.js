document.addEventListener('DOMContentLoaded', () => {

    const filtroEstado = document.getElementById('filtroEstado');
    const filtroTexto = document.getElementById('filtroTexto');
    const filas = document.querySelectorAll('#tablaReportes tbody tr');

    function aplicarFiltros() {
        const estado = filtroEstado.value;
        const texto = filtroTexto.value.trim().toLowerCase();

        filas.forEach(fila => {
            const coincideEstado = !estado || fila.dataset.estado === estado;
            const coincideTexto = fila.textContent.toLowerCase().includes(texto);
            fila.style.display = (coincideEstado && coincideTexto) ? '' : 'none';
        });
    }

    filtroEstado.addEventListener('change', aplicarFiltros);
    filtroTexto.addEventListener('input', aplicarFiltros);

    // Confirmar antes de cambiar el estado de un reporte
    document.querySelectorAll('.form-estado').forEach(form => {
        form.addEventListener('submit', (e) => {
            const select = form.querySelector('select[name="nuevo_estado"]');
            const nuevoEstado = select.options[select.selectedIndex].text;

            const confirmado = confirm(`¿Confirmás que querés marcar este reporte como "${nuevoEstado}"?`);

            if (!confirmado) {
                e.preventDefault();
            }
        });
    });

});