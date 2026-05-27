<?php
require_once __DIR__ . "/../../proc/validar.php";
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
        <h2>Crear producte</h2>
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
                <label for="imatge">URL de la imatge</label>
                <input type="url" id="imatge">
            </div>

            <div>
                <label for="donacio">Donació *</label>
                <select id="donacio" required>
                    <option value="si">Sí</option>
                    <option value="no">No</option>
                </select>
            </div>

            <div>
                <label for="preu">Preu</label>
                <input type="number" id="preu">
            </div>

            <button class="submit" type="submit">Crear producte →</button>
        </form>
    </main>

    <script>
        document.getElementById("donacio").addEventListener("change", (e) => {
            const preu = document.getElementById("preu");

            if (e.target.value === "si") {
                preu.value = 0;
                preu.disabled = true;
            } else {
                preu.disabled = false;
            }
        });

        function validar(nom, categoria, donacio, preu) {
            if (!nom) return "El nom és obligatori.";
            if (nom.length < 3) return "El nom ha de tenir mínim 3 caràcters.";
            if (!categoria) return "Tria una categoria.";
            if (!donacio) return "Tria si el producte és donació.";
            if (donacio === "no" && preu <= 0) return "Si no és donació necessita un preu";
            return null;
        }

        document.querySelector("form").addEventListener("submit", async (e) => {
            e.preventDefault();

            const nom = document.getElementById("nom").value.trim();
            const categoria = document.getElementById("categoria").value;
            const subcategoria = document.getElementById("subcategoria").value.trim();
            const descripcio = document.getElementById("descripcio").value.trim();
            const imatge = document.getElementById("imatge").value.trim();
            const resultat = document.getElementById("resultat");
            const donacio = document.getElementById("donacio").value;
            const preu = parseFloat(document.getElementById("preu").value) || 0;

            const error = validar(nom, categoria, donacio, preu);
            if (error) {
                resultat.textContent = error;
                return;
            }

            try {
                const res = await fetch(`http://localhost:3001/productes`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        nom,
                        categoria,
                        subcategoria,
                        descripcio,
                        imatge,
                        id_usuari: payload.id,
                        donacio,
                        preu,
                    })
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
    </script>

    <?php include_once __DIR__ . "/../layout/footer.html"; ?>
</body>

</html>