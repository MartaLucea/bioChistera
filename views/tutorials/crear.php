<?php
require_once __DIR__ . "/../../proc/validar.php";

$token = $_COOKIE["token"] ?? null;
$userId = null;

if ($token) {
    $parts = explode(".", $token);
    if (count($parts) === 3) {
        $payload = json_decode(base64_decode($parts[1]), true);
        $userId = $payload["id"] ?? null;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/css/modificar.css">
    <title>BioChistera</title>
</head>

<body>
    <?php include_once '../layout/header.php'; ?>

    <main class="form-main">
        <h2>Crear tutorial</h2>
        <p style="color:red;" id="resultat"></p>

        <form>
            <div>
                <label for="nom">Títol *</label>
                <input type="text" id="nom" required>
            </div>

            <div>
                <label for="categoria">Categoria *</label>
                <select id="categoria" required>
                    <option value="">Tria una categoria</option>
                    <option value="Magia">Màgia</option>
                    <option value="Circ">Circ</option>
                    <option value="Clown">Clown</option>
                </select>
            </div>

            <div>
                <label for="subcategoria">Subcategoria</label>
                <input type="text" id="subcategoria">
            </div>

            <div>
                <label for="descripcio">Descripció</label>
                <textarea id="descripcio" rows="4"></textarea>
            </div>

            <div>
                <label for="durada">Durada (minuts)</label>
                <input type="number" id="durada" min="0">
            </div>

            <div>
                <label for="url">URL del vídeo *</label>
                <input type="url" id="url" required>
            </div>

            <button class="submit" type="submit">Crear tutorial →</button>
        </form>
    </main>

    <script>
        function validar(nom, categoria, url, durada) {
            if (!nom) return "El títol és obligatori.";
            if (nom.length < 3) return "El títol ha de tenir mínim 3 caràcters.";
            if (!categoria) return "Tria una categoria.";
            if (!url) return "La URL del vídeo és obligatòria.";
            if (durada < 0 || isNaN(durada)) return "La durada no pot ser negativa.";
            return null;
        }

        document.querySelector("form").addEventListener("submit", async (e) => {
            e.preventDefault();

            const nom = document.getElementById("nom").value.trim();
            const categoria = document.getElementById("categoria").value;
            const subcategoria = document.getElementById("subcategoria").value.trim();
            const descripcio = document.getElementById("descripcio").value.trim();
            const durada = parseInt(document.getElementById("durada").value) || 0;
            const url = document.getElementById("url").value.trim();
            const resultat = document.getElementById("resultat");

            const error = validar(nom, categoria, url, durada);
            if (error) {
                resultat.textContent = error;
                return;
            }

            try {
                const res = await fetch(`http://localhost:3001/tutorials`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        titol: nom,
                        categoria,
                        subcategoria,
                        descripcio,
                        durada,
                        url,
                        id_usuari: <?= json_encode($userId) ?>
                    })
                });

                const data = await res.json();

                if (res.ok) {
                    window.location.assign("/views/tutorials/index.php");
                } else {
                    resultat.textContent = data.error;
                }

            } catch (err) {
                resultat.textContent = "Error de connexió.";
                console.error(err);
            }
        });
    </script>

    <?php include_once __DIR__ . "/../layout/footer.html"; ?>
</body>

</html>