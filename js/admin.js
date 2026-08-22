document.addEventListener('DOMContentLoaded', () => {

    const filtroEstado = document.getElementById('filtroEstado');
    const filtroTexto = document.getElementById('filtroTexto');

    const filas = document.querySelectorAll(
        '#tablaReportes tbody tr'
    );


 
    function aplicarFiltros() {

        const estado = filtroEstado.value;

        const texto = filtroTexto.value
            .trim()
            .toLowerCase();


        filas.forEach(fila => {

            const coincideEstado =
                !estado ||
                fila.dataset.estado === estado;


            const coincideTexto =
                fila.textContent
                    .toLowerCase()
                    .includes(texto);


            if (
                coincideEstado &&
                coincideTexto
            ) {

                fila.style.display = '';

            } else {

                fila.style.display = 'none';

            }

        });

    }


    filtroEstado.addEventListener(
        'change',
        aplicarFiltros
    );


    filtroTexto.addEventListener(
        'input',
        aplicarFiltros
    );


  
    document
        .querySelectorAll('.form-estado')
        .forEach(form => {

            form.addEventListener(
                'submit',
                (e) => {

                    const select =
                        form.querySelector(
                            'select[name="nuevo_estado"]'
                        );


                    const nuevoEstado =
                        select.options[
                            select.selectedIndex
                        ].text;


                    const confirmado = confirm(
                        `¿Confirmás que querés cambiar el estado a "${nuevoEstado}"?`
                    );


                    /*
                     * SOLO cancelamos el envío
                     * si el usuario dice NO.
                     */

                    if (!confirmado) {

                        e.preventDefault();

                    }

                }
            );

        });

});