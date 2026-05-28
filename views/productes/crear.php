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
        <h2>Crear producte</h2>
        <p style="color:red;" id="resultat"></p>

        <form>
            <div>
                <label for="nom">Nom</label>
                <input type="text" id="nom" required>
            </div>

            <div>
                <label for="categoria">Categoria</label>
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
                <label for="imatge">URL de la imatge</label>
                <input type="url" id="imatge">
            </div>

            <div>
                <label for="donacio">Donació</label>
                <select id="donacio">
                    <option value="si">Sí</option>
                    <option value="no">No</option>
                </select>
            </div>

            <div>
                <label for="preu">Preu</label>
                <input type="number" id="preu" disabled=true value=0>
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

        function validar(dades) {
            const { nom, categoria, donacio, preu, imatge } = dades;

            if (!nom || nom.length < 3) {
                return "El nom és obligatori i ha de tenir almenys 3 caràcters.";
            }
            
            if (!categoria) {
                return "Has de seleccionar una categoria.";
            }

            if (donacio === "no") {
                if (isNaN(preu) || preu <= 0) {
                    return "Si no és una donació, el preu ha de ser superior a 0.";
                }
            }

            if (imatge !== "") {
                try {
                    new URL(imatge);
                } catch (_) {
                    return "La URL de la imatge no és vàlida.";
                }
            }

            return null;
        }

        document.querySelector("form").addEventListener("submit", async (e) => {
            e.preventDefault();

            const resultat = document.getElementById("resultat");
            const botoSubmit = e.target.querySelector(".submit");
            
            const dades = {
                nom: document.getElementById("nom").value.trim(),
                categoria: document.getElementById("categoria").value,
                descripcio: document.getElementById("descripcio").value.trim(),
                imatge: document.getElementById("imatge").value.trim(),
                donacio: document.getElementById("donacio").value,
                preu: parseFloat(document.getElementById("preu").value) || 0,
                id_usuari: <?= json_encode($userId) ?>
            };

            const error = validar(dades);
            if (error) {
                resultat.style.color = "red";
                resultat.textContent = error;
                window.scrollTo(0, 0); 
                return;
            }

            if (!dades.id_usuari) {
                resultat.textContent = "Sessió no vàlida. Torna a iniciar sessió.";
                return;
            }

            try {
                botoSubmit.disabled = true;
                botoSubmit.textContent = "Enviant...";
                resultat.textContent = "";

                const res = await fetch(`http://localhost:3001/productes`, {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify(dades)
                });

                const data = await res.json();

                if (res.ok) {
                    resultat.style.color = "green";
                    resultat.textContent = "Producte creat correctament! Redirigint...";
                    setTimeout(() => {
                        window.location.assign("/views/user/paginaUsuari.php");
                    }, 1500);
                } else {
                    throw new Error(data.error || "Error en el servidor");
                }

            } catch (err) {
                resultat.style.color = "red";
                resultat.textContent = err.message;
                botoSubmit.disabled = false;
                botoSubmit.textContent = "Crear producte →";
            }
        });
    </script>

    <?php include_once __DIR__ . "/../layout/footer.html"; ?>
</body>

</html>