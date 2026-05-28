<?php
require_once __DIR__ . "/../auth/validar.php";

$id = $_GET["id"] ?? null;
if (!$id) {
    header("Location: /views/tutorials/index.php");
    exit;
}

$token = $_COOKIE["token"] ?? null;
$userId = null;
$userRol = null;

if ($token) {
    $parts = explode(".", $token);
    if (count($parts) === 3) {
        $payload = json_decode(base64_decode($parts[1]), true);
        $userId = $payload["id"] ?? null;
        $userRol = $payload["rol"] ?? null;
    }
}
?>
<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/css/modificar.css">
    <title>Editar Tutorial - BioChistera</title>
</head>

<body>
    <?php include_once '../layout/header.php'; ?>

    <main class="form-main">
        <h2>Editar tutorial</h2>
        <p id="resultat-global"></p>

        <form id="editForm" novalidate>
            <div>
                <label for="nom">Títol *</label>
                <input type="text" id="nom" required minlength="3">
                <span id="error-nom" class="error-message"></span>
            </div>

            <div>
                <label for="categoria">Categoria *</label>
                <select id="categoria" required>
                    <option value="">Tria una categoria</option>
                    <option value="Magia">Màgia</option>
                    <option value="Circ">Circ</option>
                    <option value="Clown">Clown</option>
                </select>
                <span id="error-categoria" class="error-message"></span>
            </div>

            <div>
                <label for="descripcio">Descripció</label>
                <textarea id="descripcio" rows="4"></textarea>
                <span id="error-descripcio" class="error-message"></span>
            </div>

            <div>
                <label for="durada">Durada (minuts)</label>
                <input type="number" id="durada" min="0">
                <span id="error-durada" class="error-message"></span>
            </div>

            <div>
                <label for="url">URL del vídeo *</label>
                <input type="url" id="url" required>
                <span id="error-url" class="error-message"></span>
            </div>

            <button class="submit" type="submit" id="btnGuardar">Guardar canvis →</button>
            <a href="index.php" style="display:block; text-align:center; margin-top:15px; color:#666;">Cancel·lar</a>
        </form>
    </main>

    <script>
        let id_usuari_propietari = null;
        const id_tutorial = <?= json_encode($id) ?>;
        const id_sessio = <?= json_encode($userId) ?>;
        const rol_sessio = <?= json_encode($userRol) ?>;

        const form = document.getElementById("editForm");

        async function carregarTutorial() {
            try {
                const res = await fetch(`http://localhost:3001/tutorials/${id_tutorial}`);
                
                if (!res.ok) throw new Error("No s'ha pogut carregar el tutorial");

                const tutorial = await res.json();
                id_usuari_propietari = tutorial.id_usuari;

                if (id_usuari_propietari !== id_sessio && rol_sessio !== "admin") {
                    alert("No tens permís per editar aquest tutorial.");
                    window.location.assign("index.php");
                    return;
                }

                document.getElementById("nom").value = tutorial.titol || ""; 
                document.getElementById("categoria").value = tutorial.categoria || "";
                document.getElementById("descripcio").value = tutorial.descripcio || "";
                document.getElementById("durada").value = tutorial.durada_minuts || "0";
                document.getElementById("url").value = tutorial.video_url || "";

            } catch (err) {
                console.error(err);
                alert("Error carregant les dades.");
                window.location.assign("index.php");
            } finally {
                document.body.classList.remove("is-loading");
            }
        }
        function marcarError(id, msg) {
            const input = document.getElementById(id);
            const span = document.getElementById(`error-${id}`);
            input.classList.add("error-input");
            span.textContent = msg;
        }

        function netejarErrors() {
            document.querySelectorAll(".error-message").forEach(s => s.textContent = "");
            document.querySelectorAll("input, select, textarea").forEach(i => i.classList.remove("error-input"));
            document.getElementById("resultat-global").textContent = "";
        }

        function validar() {
            let esValid = true;
            const nom = document.getElementById("nom").value.trim();
            const categoria = document.getElementById("categoria").value;
            const url = document.getElementById("url").value.trim();
            const durada = document.getElementById("durada").value;

            if (nom.length < 3) {
                marcarError("nom", "El títol ha de tenir mínim 3 caràcters.");
                esValid = false;
            }

            if (!categoria) {
                marcarError("categoria", "Has de triar una categoria.");
                esValid = false;
            }

            const urlPattern = /^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/;
            if (!urlPattern.test(url)) {
                marcarError("url", "Introdueix una URL vàlida.");
                esValid = false;
            }

            if (durada < 0) {
                marcarError("durada", "La durada no pot ser negativa.");
                esValid = false;
            }

            return esValid;
        }

        form.addEventListener("submit", async (e) => {
            e.preventDefault();
            netejarErrors();

            if (!validar()) {
                document.getElementById("resultat-global").textContent = "Revisa els errors del formulari.";
                document.getElementById("resultat-global").style.color = "red";
                return;
            }

            try {
                const res = await fetch(`http://localhost:3001/tutorials/${id_tutorial}`, {
                    method: "PUT",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({
                        titol: document.getElementById("nom").value.trim(),
                        categoria: document.getElementById("categoria").value,
                        descripcio: document.getElementById("descripcio").value.trim(),
                        durada_minuts: parseInt(document.getElementById("durada").value) || 0,
                        video_url: document.getElementById("url").value.trim(),
                        id_usuari: id_usuari_propietari // Mantenim el propietari original
                    })
                });

                if (res.ok) {
                    document.getElementById("resultat-global").style.color = "green";
                    document.getElementById("resultat-global").textContent = "Canvis guardats correctament!";
                    setTimeout(() => window.location.assign("/views/tutorials/index.php"), 1200);
                } else {
                    const data = await res.json();
                    document.getElementById("resultat-global").textContent = data.error || "Error en l'actualització.";
                }
            } catch (err) {
                document.getElementById("resultat-global").textContent = "Error de connexió amb el servidor.";
            }
        });
        carregarTutorial();
    </script>

    <?php include_once __DIR__ . "/../layout/footer.html"; ?>
</body>
</html>