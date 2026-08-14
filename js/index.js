const cards = document.querySelectorAll(".card");

console.log("Cantidad de cards:", cards.length);

cards.forEach(card => {

    card.addEventListener("click", function() {

        this.classList.toggle("active");

        console.log("Card seleccionada");

    });

});




const categorias = document.querySelectorAll(".categoria");

categorias.forEach(categoria => {

    categoria.addEventListener("click", function() {

        // Cerramos todas las demás categorías
        categorias.forEach(otraCategoria => {

            if (otraCategoria !== this) {
                otraCategoria.classList.remove("active");
            }

        });

        // Abrimos o cerramos la categoría seleccionada
        this.classList.toggle("active");

    });

});



// ---------- Buscador de categorías ----------

const buscador = document.getElementById("buscadorCategorias");

buscador.addEventListener("input", function() {

    const texto = this.value.toLowerCase();

    categorias.forEach(categoria => {

        const nombre = categoria
            .querySelector("span")
            .textContent
            .toLowerCase();

        if (nombre.includes(texto)) {

            categoria.style.display = "block";

        } else {

            categoria.style.display = "none";

        }

    });

});


// ---------- Estadísticas ----------

const numeros = document.querySelectorAll(".numero");

numeros.forEach(numero => {

    const meta = Number(numero.dataset.meta);

    let actual = 0;

    const contador = setInterval(() => {

        actual++;

        numero.textContent = actual;

        if (actual >= meta) {

            clearInterval(contador);

        }

    }, 20);

});