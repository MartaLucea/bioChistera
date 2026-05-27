<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/tutorialsProductes.css">
    <title>BioChistera</title>
</head>

<body>
<?php include_once '../layout/header.php'; ?>

<main>
    <p class="ods-hero__breadcrumb">
        <a href="/index.php">Inici</a> › Productes
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
        <p> || </p>
        <button class="price-tab actiu" data-preu="tots">Tots</button>
        <button class="price-tab" data-preu="donacio">Donació</button>
        <button class="price-tab" data-preu="pagament">Amb preu</button>
    </div>

</main>

<section class="tutorials" id="productes"></section>

<?php include_once '../layout/footer.html'; ?>

<script>

let totsProductes = [];

let categoriaActual = "totes";
let textActual = "";
let preuActual = "tots";

document.addEventListener("DOMContentLoaded", async () => {

    await carregarTot();

    const botonsCat = document.querySelectorAll(".faq-tab");

    const botonsPreu = document.querySelectorAll(".price-tab");

    // CERCA
    document.getElementById('faq-search').addEventListener('input', (e) => {
        textActual = e.target.value.toLowerCase().trim();
        aplicarFiltres();
    });

    // CATEGORIES
    botonsCat.forEach(boto => {
        boto.addEventListener("click", () => {

            categoriaActual = boto.dataset.cat;

            botonsCat.forEach(btn => btn.classList.remove("actiu"));
            boto.classList.add("actiu");

            aplicarFiltres();
        });
    });

    // PREU
    botonsPreu.forEach(boto => {
        boto.addEventListener("click", () => {

            preuActual = boto.dataset.preu;

            botonsPreu.forEach(btn => btn.classList.remove("actiu"));
            boto.classList.add("actiu");

            aplicarFiltres();
        });
    });

});

async function carregarTot() {

    try {
        const response = await fetch("http://localhost:3001/productes");

        if (!response.ok) throw new Error("Error");

        totsProductes = await response.json();

        mostrarProductes(totsProductes);

    } catch (error) {
        console.error("Error:", error);
    }
}

function aplicarFiltres() {

    const filtrats = totsProductes.filter(p => {

        const coincideixCat =
            categoriaActual === "totes" ||
            p.categoria === categoriaActual;

        const coincideixText =
            textActual === "" ||
            (p.nom + " " + p.descripcio).toLowerCase().includes(textActual);

        const esDonacio = p.preu <= 0;

        const coincideixPreu =
            preuActual === "tots" ||
            (preuActual === "donacio" && esDonacio) ||
            (preuActual === "pagament" && !esDonacio);

        return coincideixCat && coincideixText && coincideixPreu;
    });

    mostrarProductes(filtrats);
}

function mostrarProductes(articles) {

    const container = document.querySelector(".tutorials");
    container.innerHTML = "";

    if (articles.length === 0) {
        container.innerHTML = "<p>No s’han trobat productes.</p>";
        return;
    }

    articles.forEach(article => {

        const mostra = article.preu > 0
            ? `${article.preu} €`
            : "Donació";

        const card = document.createElement("div");
        card.classList.add("article");

        card.addEventListener("click", () => {
            window.location.href = `detall.php?id=${article.id}`;
        });

        card.innerHTML = `
            <img src="${article.imatge}" alt="${article.nom}">
            <h3>${article.nom}</h3>
            <p>${article.descripcio}</p>
            <p><strong>Categoria:</strong> ${article.categoria}</p>
            <p><strong>${mostra}</strong></p>
        `;

        container.appendChild(card);
    });
}

</script>

</body>
</html>