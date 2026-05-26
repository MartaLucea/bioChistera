<?php
require_once __DIR__ . "/../../proc/validar.php";
include_once __DIR__ . "/../layout/head.php";

$id = $_GET["id"] ?? null;
if (!$id) { header("Location: /views/tutorials/index.php"); exit; }


?>

<main class="form-main">
    <h2>Editar tutorial</h2>
    <p style="color:red;" id="resultat"></p>

    <form>
        <div>
            <label for="titol">Títol *</label>
            <input type="text" id="titol" required>
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
            <label for="durada">Durada (minuts) *</label>
            <input type="number" id="durada" required min="1">
        </div>

        <div>
            <label for="video_url">URL del vídeo *</label>
            <input type="url" id="video_url" required>
        </div>

        <button class="submit" type="submit">Guardar canvis →</button>
    </form>
</main>

<script>
    const id = <?= json_encode($id) ?>;

    async function carregarTutorial() {
        const res = await fetch(`http://localhost:3001/tutorials/${id}`);
        const t = await res.json();

        if (t.id_usuari !== payload.id && payload.rol !== "admin") {
            window.location.assign("index.php");
            return;
        }

        document.getElementById("titol").value        = t.titol ?? "";
        document.getElementById("categoria").value    = t.categoria ?? "";
        document.getElementById("subcategoria").value = t.subcategoria ?? "";
        document.getElementById("descripcio").value   = t.descripcio ?? "";
        document.getElementById("durada").value       = t.durada_minuts ?? "";
        document.getElementById("video_url").value    = t.video_url ?? "";
    }

    function validar(titol, categoria, durada, video_url) {
        if (!titol)     return "El títol és obligatori.";
        if (titol.length < 3) return "El títol ha de tenir mínim 3 caràcters.";
        if (!categoria) return "Tria una categoria.";
        if (!durada || durada < 1) return "La durada ha de ser un número positiu.";
        if (!video_url) return "La URL del vídeo és obligatòria.";
        if (!video_url.startsWith("http")) return "La URL no és vàlida.";
        return null;
    }

    document.querySelector("form").addEventListener("submit", async (e) => {
        e.preventDefault();

        const titol        = document.getElementById("titol").value.trim();
        const categoria    = document.getElementById("categoria").value;
        const subcategoria = document.getElementById("subcategoria").value.trim();
        const descripcio   = document.getElementById("descripcio").value.trim();
        const durada       = parseInt(document.getElementById("durada").value);
        const video_url    = document.getElementById("video_url").value.trim();
        const resultat     = document.getElementById("resultat");

        const error = validar(titol, categoria, durada, video_url);
        if (error) { resultat.textContent = error; return; }

        try {
            const res = await fetch(`http://localhost:3001/tutorials/${id}`, {
                method: "PATCH",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ titol, categoria, subcategoria, descripcio, durada_minuts: durada, video_url })
            });

            const data = await res.json();

            if (res.ok) {
                window.location.assign("/views/user/paginaUsuari.php");
            } else {
                resultat.textContent = data.error;
            }

        } catch (err) {
            resultat.textContent = "Error de connexió.";
            console.error(err);
        }
    });

    carregarTutorial();
</script>

<?php include_once __DIR__ . "/../layout/footer.html"; ?>
</body>
</html>