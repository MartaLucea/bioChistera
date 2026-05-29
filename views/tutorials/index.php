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
<p class="ods-hero__breadcrumb" id="tutorials"><a href="/index.php">Inici</a> › Tutorials</a>

<h1>TUTORIALS</h1>

<div id="faq-search-wrap">
    <input type="search" id="faq-search" placeholder="Cerca tutorials..." aria-label="Cerca tutorials">
</div>

<div id="faq-tabs" role="tablist">
    <button class="faq-tab actiu" data-cat="totes">Totes</button>
    <button class="faq-tab" data-cat="Magia">Magia</button>
    <button class="faq-tab" data-cat="Clown">Clown</button>
    <button class="faq-tab" data-cat="Circ">Circ</button>
</div>
</main>
<section class="tutorials"></section>

<?php include_once '../layout/footer.html'; ?>

<script>

document.addEventListener("DOMContentLoaded", async () => {

    await carregarTot();

    const botons = document.querySelectorAll(".faq-tab");
    
    document.getElementById('faq-search').addEventListener('input', filtrarTutorials);
    botons.forEach(boto => {
        boto.class="faq-tab"
        boto.addEventListener("click", async function () {

            const categoria = boto.dataset.cat;
            botons.forEach(btn => {
                btn.classList.remove("actiu");
            });

            boto.classList.add("actiu");
            if (categoria === "totes") {
                carregarTot();
                return;
            }

            try {

                const response = await fetch(`http://localhost:3001/tutorials/categoria/${categoria}`);

                if (!response.ok) {
                    throw new Error("Error al obtenir els tutorials");
                }

                const articles = await response.json();

                mostrarTutorials(articles);

            } catch (error) {
                console.error("Error:", error);
            }

        });

    });

});

function mostrarTutorials(articles) {

    const container = document.querySelector(".tutorials");

    container.innerHTML = "";

    articles.forEach(article => {

        const card = document.createElement("div");

        card.classList.add("article");

        card.addEventListener("click", function () {
            window.location.href = `/views/tutorials/detall.php?id=${article.id}`;
        });

        const videoHTML = comprovarVideo(article.video_url, article.titol);

        card.innerHTML = `
            ${videoHTML}
            <h3>${article.titol}</h3>
            <p>${article.descripcio}</p>
            <p><strong>Categoria:</strong> ${article.categoria}</p>
        `;

        container.appendChild(card);

    });

}

function comprovarVideo(url, nom) {

    if (!url) return "";

    if (url.includes("youtube.com/embed")) {

        return `
            <iframe
                src="${url}"
                frameborder="0"
                allowfullscreen>
            </iframe>
        `;
    }

    if (url.includes("youtube.com") || url.includes("youtu.be")) {

        let videoId = "";

        if (url.includes("youtu.be")) {
            videoId = url.split("/").pop();
        } else {
            videoId = new URL(url).searchParams.get("v");
        }

        return `
            <iframe
                src="https://www.youtube.com/embed/${videoId}"
                frameborder="0"
                allowfullscreen>
            </iframe>
        `;
    }
    return `<a href="${url}" target="_blank">${nom}</a>`;

}

async function carregarTot() {

    try {

        const response = await fetch("http://localhost:3001/tutorials");

        if (!response.ok) {
            throw new Error("Error al obtenir els tutorials");
        }

        const articles = await response.json();

        mostrarTutorials(articles);

    } catch (error) {

        console.error("Error:", error);

    }

}

function filtrarTutorials() {

    const cat = document.querySelector('.faq-tab.actiu').dataset.cat;

    const text = document
        .getElementById('faq-search')
        .value
        .toLowerCase()
        .trim();

    let visibles = 0;

    document.querySelectorAll('.article').forEach(article => {

        const categoria = article.querySelector("strong")
            .parentElement
            .textContent
            .toLowerCase();

        const contingut = article.textContent.toLowerCase();

        const coincideixCat =
            cat === 'totes' ||
            categoria.includes(cat.toLowerCase());

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