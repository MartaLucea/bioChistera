<?php
require_once __DIR__ . "/../auth/validar.php";

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
                <input type="text" id="nom">
            </div>

            <div>
                <label for="categoria">Categoria *</label>
                <select id="categoria">
                    <option value="">Tria una categoria</option>
                    <option value="Magia">Màgia</option>
                    <option value="Circ">Circ</option>
                    <option value="Clown">Clown</option>
                </select>
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
                <label for="url">URL del vídeo</label>
                <input type="url" id="url">
            </div>

            <button class="submit" type="submit">Crear tutorial →</button>
        </form>
    </main>

    <script>
        const form = document.getElementById("tutorialForm");
        
        function netejarErrors() {
            document.querySelectorAll('.error-message').forEach(el => el.textContent = "");
            document.querySelectorAll('input, select').forEach(el => el.classList.remove('error-input'));
            document.getElementById("resultat-global").textContent = "";
        }

        function validarFormulari(dades) {
            let errors = 0;

            if (dades.nom.length < 3) {
                marcarError("nom", "El títol ha de tenir almenys 3 caràcters.");
                errors++;
            }

            if (!dades.categoria) {
                marcarError("categoria", "Has de seleccionar una categoria.");
                errors++;
            }

            if (dades.durada <= 0 || isNaN(dades.durada)) {
                marcarError("durada", "La durada ha de ser un número positiu.");
                errors++;
            }

            const urlPattern = /^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/;
            if (!urlPattern.test(dades.url)) {
                marcarError("url", "Introdueix una adreça URL vàlida (http://...).");
                errors++;
            }

            return errors === 0;
        }

        function marcarError(id, missatge) {
            const input = document.getElementById(id);
            const span = document.getElementById(`error-${id}`);
            input.classList.add('error-input');
            span.textContent = missatge;
        }

        form.addEventListener("submit", async (e) => {
            e.preventDefault();
            netejarErrors();

            const dades = {
                nom: document.getElementById("nom").value.trim(),
                categoria: document.getElementById("categoria").value,
                descripcio: document.getElementById("descripcio").value.trim(),
                durada: parseInt(document.getElementById("durada").value),
                url: document.getElementById("url").value.trim()
            };

            const esValid = validarFormulari(dades);

            if (!esValid) {
                document.getElementById("resultat-global").textContent = "Si us plau, corregeix els errors del formulari.";
                document.getElementById("resultat-global").style.color = "red";
                return;
            }

            try {
                const res = await fetch(`http://localhost:3001/tutorials`, {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({
                        titol: dades.nom,
                        categoria: dades.categoria,
                        descripcio: dades.descripcio,
                        durada_minuts: dades.durada,
                        video_url: dades.url,
                        id_usuari: <?= json_encode($userId) ?>
                    })
                });

                const data = await res.json();

                if (res.ok) {
                    document.getElementById("resultat-global").style.color = "green";
                    document.getElementById("resultat-global").textContent = "Tutorial creat amb èxit! Redirigint...";
                    setTimeout(() => window.location.assign("/views/tutorials/index.php"), 1500);
                } else {
                    document.getElementById("resultat-global").style.color = "red";
                    document.getElementById("resultat-global").textContent = data.error || "Error en guardar.";
                }

            } catch (err) {
                document.getElementById("resultat-global").textContent = "Error crític de connexió.";
                console.error(err);
            }
        });
    </script>

    <?php include_once __DIR__ . "/../layout/footer.html"; ?>
</body>

</html>