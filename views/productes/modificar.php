<?php
require_once __DIR__ . "/../../proc/validar.php";

$id = $_GET["id"] ?? null;
if (!$id) { header("Location: /views/productes/index.php"); exit; }
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
    <?php include_once 'header.php'; ?>
<main class="form-main">
    <h2>Editar producte</h2>
    <p style="color:red;" id="resultat"></p>

    <form>
        <div>
            <label for="nom">Nom *</label>
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
            <label for="estat">Estat *</label>
            <select id="estat" required>
                <option value="">Tria l'estat</option>
                <option value="nou">Nou</option>
                <option value="bon_estat">Bon estat</option>
                <option value="usat">Usat</option>
                <option value="per_peces">Per peces</option>
            </select>
        </div>

        <div>
            <label for="imatge">URL de la imatge</label>
            <input type="url" id="imatge">
        </div>

        <button class="submit" type="submit">Guardar canvis →</button>
    </form>
</main>

<script>
    const id = <?= json_encode($id) ?>;

    async function carregarProducte() {
        const res = await fetch(`http://localhost:3001/productes/${id}`);
        const p = await res.json();

        if (p.id_usuari !== payload.id && payload.rol !== "admin") {
            window.location.assign("index.php");
            return;
        }

        document.getElementById("nom").value          = p.nom ?? "";
        document.getElementById("categoria").value    = p.categoria ?? "";
        document.getElementById("subcategoria").value = p.subcategoria ?? "";
        document.getElementById("descripcio").value   = p.descripcio ?? "";
        document.getElementById("estat").value        = p.estat ?? "";
        document.getElementById("imatge").value       = p.imatge ?? "";
    }

    function validar(nom, categoria, estat) {
        if (!nom)       return "El nom és obligatori.";
        if (nom.length < 3) return "El nom ha de tenir mínim 3 caràcters.";
        if (!categoria) return "Tria una categoria.";
        if (!estat)     return "Tria l'estat del producte.";
        return null;
    }

    document.querySelector("form").addEventListener("submit", async (e) => {
        e.preventDefault();

        const nom          = document.getElementById("nom").value.trim();
        const categoria    = document.getElementById("categoria").value;
        const subcategoria = document.getElementById("subcategoria").value.trim();
        const descripcio   = document.getElementById("descripcio").value.trim();
        const estat        = document.getElementById("estat").value;
        const imatge       = document.getElementById("imatge").value.trim();
        const resultat     = document.getElementById("resultat");

        const error = validar(nom, categoria, estat);
        if (error) { resultat.textContent = error; return; }

        try {
            const res = await fetch(`http://localhost:3001/productes/${id}`, {
                method: "PATCH",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ nom, categoria, subcategoria, descripcio, estat, imatge })
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

    carregarProducte();
</script>

<?php include_once __DIR__ . "/../layout/footer.html"; ?>
</body>
</html>