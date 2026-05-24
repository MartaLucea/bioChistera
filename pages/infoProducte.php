<?php include_once '../include/head.php'; ?>

<main class="contenidor">

    <div id="loading">
        <p>Carregant producte...</p>
    </div>

    <div id="error" style="display:none">
        <h1>Producte no trobat</h1>
        <a href="productes.php">← Tornar</a>
    </div>

    <section id="producte" style="display:none">

        <p class="ods-hero__breadcrumb">
            <a href="../index.php">Inici</a> ›
            <a href="productes.php">Productes</a> ›
            <span id="bc-nom"></span>
        </p>

        <h1 id="nom"></h1>

        <div class="meta">
            <span id="estat"></span> ·
            <span id="data"></span> ·
            <span id="usuari"></span>
        </div>

        <div class="imatge">
            <img id="imatge" alt="Imatge del producte" style="max-width:100%; height:auto;">
        </div>

        <div class="card">
            <h3>Descripció</h3>
            <p id="descripcio"></p>
        </div>

        <div class="card">
            <h3>Informació</h3>

            <p><strong>Categoria:</strong> <span id="categoria"></span></p>
            <p><strong>Subcategoria:</strong> <span id="subcategoria"></span></p>
        </div>

    </section>

</main>

<?php include_once '../include/footer.html'; ?>

<script>
const params = new URLSearchParams(window.location.search);
const id = params.get('id');

function formatData(data) {
    return new Date(data).toLocaleDateString('ca-ES');
}

async function carregarProducte() {

    if (!id) {
        mostrarError();
        return;
    }

    try {

        const res = await fetch(`http://localhost:3001/productes/${id}`);

        if (!res.ok) {
            throw new Error();
        }

        const p = await res.json();

        document.getElementById('loading').style.display = 'none';
        document.getElementById('producte').style.display = 'block';

        document.title = p.nom;

        document.getElementById('bc-nom').textContent = p.nom;
        document.getElementById('nom').textContent = p.nom;

        document.getElementById('estat').textContent = p.estat || 'Sense estat';

        document.getElementById('data').textContent =
            p.data_publicacio ? formatData(p.data_publicacio) : '';

        document.getElementById('usuari').textContent =
            p.id_usuari ? `${p.usuari}` : '';

        document.getElementById('imatge').src = p.imatge || '';

        document.getElementById('descripcio').textContent =
            p.descripcio || '';

        document.getElementById('categoria').textContent =
            p.categoria || '';

        document.getElementById('subcategoria').textContent =
            p.subcategoria || '';

    } catch (e) {
        mostrarError();
    }
}

function mostrarError() {
    document.getElementById('loading').style.display = 'none';
    document.getElementById('error').style.display = 'block';
}

carregarProducte();
</script>