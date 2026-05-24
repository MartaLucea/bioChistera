<?php
include_once __DIR__ . "/../include/head.php";
require_once __DIR__ . "/../proc/validar.php";

$token = $_COOKIE["token"];
$parts = explode(".", $token);

if (count($parts) !== 3) {
  return null;
}

$payload = json_decode(base64_decode($parts[1]), true);
?>
<main>
  <div class="container">
    <div class="hero">
      <div class="avatar" id="avatar"><?php echo $payload["nom"][0]  ?></div>
      <div class="hero-info">
        <h1 id="hero-name"><?php echo $payload["nom"]  ?></h1>
      </div>
    </div>

    <div class="section-header">
      <h2>Els meus tutorials</h2>
      <button class="btn-add" id="tutorial">+ Afegir tutorial</button>
    </div>
    <div class="grid" id="grid-tutorials"></div>

    <div class="section-header">
      <h2>Els meus materials</h2>
      <button class="btn-add" id="material">+ Afegir material</button>
    </div>
    <div class="mat-list" id="llista-materials"></div>

  </div>
</main>
<script>
const id = <?php echo json_encode($payload["id"]); ?>;

async function carregarUsuari() {
  try {
    const response = await fetch(`http://localhost:3001/usuari/${id}`);

    if (!response.ok) {
      throw new Error("Error al obtenir el material de usuari");
    }

    const tot = await response.json();

    console.log(tot);

    const grid = document.getElementById('grid-tutorials');

    if (!tot.tutorials.length) return;

    grid.innerHTML = tot.tutorials.map(t => `
      <div class="card">
        <span class="card-cat cat-${t.categoria.toLowerCase()}">${t.categoria}</span>
        <h3>${t.titol}</h3>
        <div class="card-meta">
          <span>${t.durada_minuts} min</span>
        </div>
      </div>
    `).join('');

    const materials = document.getElementById('llista-materials');

    if (tot.productes.length) {
      materials.innerHTML = tot.productes.map(p => `
        <div class="card">
          <h3>${p.nom}</h3>
          <p>${p.descripcio}</p>
        </div>
      `).join('');
    }

  } catch (error) {
    console.error("Error:", error);
  }
}

carregarUsuari();
</script>
</script>
</body>

</html>