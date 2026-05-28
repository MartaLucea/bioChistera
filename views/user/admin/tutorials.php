<?php
require_once __DIR__ . "/../../auth/validar.php";


$token = $_COOKIE["token"];
$parts = explode(".", $token);

$payload = json_decode(base64_decode($parts[1]), true);

if ($payload['rol'] !== "admin") {
    header("Location: ../../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../public/css/administrar.css">
    <title>BioChistera</title>
</head>

<body>
    <?php include_once '../../layout/header.php'; ?>
    <main>
        <div class="container">
            <div class="hero">
                <h1>Administrar tutorials</h1>
            </div>

            <div class="grid" id="tutorials"></div>

        </div>
    </main>
    <script>
        const id = <?php echo json_encode($payload["id"]); ?>;

        async function carregarUsuari() {
            try {
                const response = await fetch(`http://localhost:3001/tutorials`);

                if (!response.ok) {
                    throw new Error("Error al obtenir tots els tutorials");
                }

                const tot = await response.json();

                console.log(tot);

                const grid = document.getElementById('tutorials');

                if (!tot.length) return;
                grid.innerHTML = tot.map(t => `
                    <div class="card" onclick="window.location.href='../../tutorials/detall.php?id=${t.id}'">

                        <div class="card-content">

                            <div class="card-header">
                                <span class="card-cat cat-${t.categoria.toLowerCase()}">
                                    ${t.categoria}
                                </span>

                                <span class="card-date">
                                    ${t.data_publicacio ?? ''}
                                </span>
                            </div>

                            <h3 class="card-title">
                                ${t.titol}
                            </h3>

                            <p class="card-user">
                                👤 ${t.usuari_nom ?? 'Desconegut'}
                            </p>

                            <div class="card-footer">
                                <span>${t.durada_minuts} min</span>
                            </div>

                        </div>

                        <div class="botons">
                            <p onclick="event.stopPropagation(); window.location.href='../tutorials/modificar.php?id=${t.id}'">
                                Modificar
                            </p>

                            <p onclick="event.stopPropagation(); eliminar(${t.id}, 'tutorials', this.closest('.card'))">
                                Eliminar
                            </p>
                        </div>

                    </div>
                `).join('');

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
    <?php include_once '../../layout/footer.html'; ?>
</body>

</html>