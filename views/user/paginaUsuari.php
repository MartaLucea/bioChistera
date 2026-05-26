<?php
require_once __DIR__ . "/../../proc/validar.php";


$token = $_COOKIE["token"];
$parts = explode(".", $token);

if (count($parts) !== 3) {
  return null;
}

$payload = json_decode(base64_decode($parts[1]), true);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/paginaUsuari.css">
    <title>BioChistera</title>
</head>
<body>
    <?php include_once '../layout/header.php'; ?>
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
      <button class="btn-add" id="tutorial" onclick="window.location.href='../tutorials/crear.php'">+ Afegir tutorial</button>
    </div>
    <div class="grid" id="grid-tutorials"></div>

    <div class="section-header">
      <h2>Els meus materials</h2>
      <button class="btn-add" id="material" onclick="window.location.href='../productes/crear.php'">+ Afegir material</button>
    </div>
    <div class="grid" id="llista-materials"></div>

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
      <div class="card" onclick="window.location.href='../views/tutorials/detall.php?id=${t.id}'">
        <span class="card-cat cat-${t.categoria.toLowerCase()}">${t.categoria}</span>
        <h3>${t.titol}</h3>
        <div class="card-meta">
          <span>${t.durada_minuts} min</span>
        </div>
        <div class="botons">
            <p onclick="window.location.href='../views/tutorials/modificar.php?id=${t.id}'">Modificar</p>
            <p onclick="event.stopPropagation(); eliminar(${t.id}, 'tutorial', this.closest('.card'))">
              Eliminar
            </p>
          </div>
      </div>
    `).join('');

    const materials = document.getElementById('llista-materials');

    if (tot.productes.length) {
      materials.innerHTML = tot.productes.map(p => `
        <div class="card" onclick="window.location.href='../views/productes/detall.php?id=${p.id}'">
          <h3>${p.nom}</h3>
          <p>${p.descripcio}</p>
          <div class="botons">
            <p onclick="window.location.href='../views/productes/modificar.php?id=${p.id}'">Modificar</p>
            <p onclick="event.stopPropagation(); eliminar(${p.id}, 'producte', this.closest('.card'))">
              Eliminar
            </p>
          </div>
        </div>
      `).join('');
    }

  } catch (error) {
    console.error("Error:", error);
  }
}

function eliminar(id, tipus, element) {

  const confirmar = confirm(`Segur que vols eliminar aquest ${tipus}?`);

  if (!confirmar) return;

  fetch(`http://localhost:3001/${tipus}/${id}`, {
    method: "DELETE"
  })
  .then(res => res.json())
  .then(() => {
    element.remove();
  })
  .catch(err => console.error(err));
}


carregarUsuari();
</script>
<?php include_once '../layout/footer.html'; ?>
</body>

</html>