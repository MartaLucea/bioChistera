<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/tutorials.css">
    <title>BioChistera</title>
</head>
<body>
    <?php include_once '../layout/header.php'; ?>
<main class="contenidor">

    <div id="loading">
        <p>Carregant tutorial...</p>
    </div>

    <div id="error" style="display:none">
        <h1>Tutorial no trobat</h1>
        <a href="tutorials.php">← Tornar</a>
    </div>

    <section id="tutorial" style="display:none">

        <p class="ods-hero__breadcrumb">
            <a href="/index.php">Inici</a> ›
            <a href="tutorials.php">Tutorials</a> ›
            <span id="bc-titol"></span>
        </p>

        <h1 id="titol"></h1>

        <div class="meta">
            <span id="usuari"></span> ·
            <span id="data"></span> ·
            <span id="durada"></span>
        </div>

        <div class="video">
            <iframe
                id="video"
                frameborder="0"
                allowfullscreen>
            </iframe>
        </div>

        <div class="card">
            <h3>Descripció</h3>
            <p id="descripcio"></p>
        </div>

        <div class="card">
            <h3>Informació</h3>

            <p><strong>Categoria:</strong> <span id="categoria"></span></p>
        </div>

    </section>

</main>

<?php include_once '../layout/footer.html'; ?>

<script>
const params = new URLSearchParams(window.location.search);
const id = params.get('id');

function formatData(data) {
    return new Date(data).toLocaleDateString('ca-ES');
}

async function carregarTutorial() {

    if (!id) {
        mostrarError();
        return;
    }

    try {

        const res = await fetch(`http://localhost:3001/tutorials/${id}`);

        if (!res.ok) {
            throw new Error();
        }

        const t = await res.json();

        document.getElementById('loading').style.display = 'none';
        document.getElementById('tutorial').style.display = 'block';

        document.title = t.titol;

        document.getElementById('bc-titol').textContent = t.titol;

        document.getElementById('titol').textContent = t.titol;

        document.getElementById('usuari').textContent = t.usuari;

        document.getElementById('data').textContent =
            formatData(t.data_publicacio);

        document.getElementById('durada').textContent =
            `${t.durada_minuts} min`;

        document.getElementById('video').src = t.video_url;

        document.getElementById('descripcio').textContent =
            t.descripcio;

        document.getElementById('categoria').textContent =
            t.categoria;

    } catch (e) {
        mostrarError();
    }
}

function mostrarError() {
    document.getElementById('loading').style.display = 'none';
    document.getElementById('error').style.display = 'block';
}

carregarTutorial();
</script>