<?php include_once '../include/head.php'; ?>

<main>
    <p class="ods-hero__breadcrumb">
        <a href="../index.php">Inici</a> › Productes
    </p>

    <h1>MATERIALS</h1>

    <div id="faq-search-wrap">
        <input type="search" id="faq-search" placeholder="Cerca productes..." aria-label="Cerca productes">
    </div>

    <div id="faq-tabs" role="tablist">
        <button class="faq-tab actiu" data-cat="totes">Totes</button>
        <button class="faq-tab" data-cat="Magia">Magia</button>
        <button class="faq-tab" data-cat="Clown">Clown</button>
        <button class="faq-tab" data-cat="Circ">Circ</button>
    </div>
</main>

<section class="tutorials" id="productes"></section>

<?php include_once '../include/footer.html'; ?>

<script>

document.addEventListener("DOMContentLoaded", async () => {

    await carregarTot();

    const botons = document.querySelectorAll(".faq-tab");

    document.getElementById('faq-search')
        .addEventListener('input', filtrarProductes);

    botons.forEach(boto => {

        boto.addEventListener("click", async function () {

            const categoria = boto.dataset.cat;

            botons.forEach(btn => btn.classList.remove("actiu"));
            boto.classList.add("actiu");

            if (categoria === "totes") {
                carregarTot();
                return;
            }

            try {
                const response = await fetch(
                    `http://localhost:3001/productes/categoria/${categoria}`
                );

                if (!response.ok) {
                    throw new Error("Error al obtenir els productes");
                }

                const articles = await response.json();
                mostrarProductes(articles);

            } catch (error) {
                console.error("Error:", error);
            }

        });

    });

});


function mostrarProductes(articles) {

    const container = document.querySelector(".tutorials");
    container.innerHTML = "";

    articles.forEach(article => {

        const card = document.createElement("div");
        card.classList.add("article");

        card.addEventListener("click", function () {
            window.location.href = `infoProducte.php?id=${article.id}`;
        });

        card.innerHTML = `
            <img src="${article.imatge}" alt="${article.nom}">
            <h3>${article.nom}</h3>
            <p>${article.descripcio}</p>
            <p><strong>Categoria:</strong> ${article.categoria}</p>
        `;

        container.appendChild(card);

    });

}


async function carregarTot() {

    try {

        const response = await fetch("http://localhost:3001/productes");

        if (!response.ok) {
            throw new Error("Error al obtenir els productes");
        }

        const articles = await response.json();
        mostrarProductes(articles);

    } catch (error) {
        console.error("Error:", error);
    }

}


function filtrarProductes() {

    const cat = document.querySelector('.faq-tab.actiu').dataset.cat;

    const text = document
        .getElementById('faq-search')
        .value
        .toLowerCase()
        .trim();

    let visibles = 0;

    document.querySelectorAll('.article').forEach(article => {

        const contingut = article.textContent.toLowerCase();

        const coincideixCat =
            cat === 'totes' ||
            contingut.includes(cat.toLowerCase());

        const coincideixText =
            text === '' ||
            contingut.includes(text);

        if (coincideixCat && coincideixText) {
            article.style.display = 'block';
            visibles++;
        } else {
            article.style.display = 'none';
        }

    });

    const buit = document.getElementById('faq-buit');

    if (buit) {
        buit.style.display = visibles === 0 ? 'block' : 'none';
    }
}

</script>

</body>
</html>