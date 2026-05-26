<?php
$token = $_COOKIE["token"] ?? null;
if ($token) {
    $parts = explode(".", $token);
    if (count($parts) === 3) {
        header("Location: /views/user/paginaUsuari.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/login.css">
    <title>BioChistera</title>
</head>
<body>
    <?php include_once '../layout/header.php'; ?>
<main class="login-main">
    <h2 id="login-h2">Registrar-se</h2>

    <p style="color:red; margin-bottom:1rem;" id="resultat"></p>

    <form>
        <div>
            <label for="correu">Correu</label>
            <input type="email" id="correu" name="correu" required placeholder="Correu electrònic">
        </div>

        <div>
            <label for="usuari">Nom d'usuari</label>
            <input type="text" id="usuari" name="usuari" required placeholder="Nom d'usuari">
        </div>

        <div>
            <label for="contrasenya">Contrasenya</label>
            <input type="password" id="contrasenya" name="contrasenya" required placeholder="••••••••">
            <button type="button" id="togglePass">👁️</button>
        </div>

        <button class="submit" type="submit">Registrar-se →</button>

        <p class="no-registrar" style="text-align:center; margin-top:1rem;">
            Tens compte?
            <a class="registrar" href="/views/auth/login.php">Login aquí</a>
        </p>
    </form>
</main>

<script>
    document.getElementById("togglePass").addEventListener("click", () => {
        const input = document.getElementById("contrasenya");
        input.type = input.type === "password" ? "text" : "password";
    });

    function validar(nom, correu, contrasenya) {
        if (!nom || !correu || !contrasenya) return "Tots els camps són obligatoris.";
        if (nom.length < 3)                  return "El nom ha de tenir mínim 3 caràcters.";
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(correu)) return "Format de correu no vàlid.";
        if (contrasenya.length < 6)          return "La contrasenya ha de tenir mínim 6 caràcters.";
        return null;
    }

    document.querySelector("form").addEventListener("submit", async function(e) {
        e.preventDefault();

        const nom         = document.getElementById("usuari").value.trim();
        const correu      = document.getElementById("correu").value.trim();
        const contrasenya = document.getElementById("contrasenya").value.trim();
        const resultat    = document.getElementById("resultat");

        const error = validar(nom, correu, contrasenya);
        if (error) {
            resultat.textContent = error;
            return;
        }

        try {
            const resposta = await fetch("/controller/UsuariController.php?accio=register", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ usuari: nom, correu, contrasenya })
            });

            const final = await resposta.json();

            if (final.token) {
                window.location.assign("/views/user/paginaUsuari.php");
            } else {
                resultat.textContent = final.error;
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