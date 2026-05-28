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
        <main  class="login-main">
            <h2 id="login-h2">Iniciar sesión</h2>

            <form>
                <p style="color:red; margin-bottom:1rem;" id="resultat"></p>
                <div>
                    <label for="usuari">Nombre de usuario</label>
                    <input type="text" id="usuari" name="usuari" required placeholder="Tu nombre de usuario">
                </div>

                <div>
                    <label for="contrasenya">Contraseña</label>
                    <input type="password" id="contrasenya" name="contrasenya" required placeholder="••••••••">
                    <button type="button" id="togglePass">👁️</button>
                </div>

                <button class="submit" type="submit">Entrar →</button>
            </form>

            <p class="no-registrar" style="text-align:center; margin-top:1rem;">
                ¿No tienes cuenta?
                <a class="registrar" href="register.php">Regístrate aquí</a>
            </p>
        </main>
        <script>
            const input = document.getElementById("contrasenya");
            const boton = document.getElementById("togglePass");

            boton.addEventListener("click", () => {
                if (input.type === "password") {
                    input.type = "text";
                } else {
                    input.type = "password";
                }
            });
            const formulari = document.querySelector("form");
            const resultat = document.getElementById("resultat");

            formulari.addEventListener("submit", async function(e) {

                e.preventDefault();

                const dades = {
                    usuari: document.getElementById("usuari").value,
                    contrasenya: document.getElementById("contrasenya").value,
                };

                try {

                    const resposta = await fetch("/controller/UsuariController.php?accio=login", {

                        method: "POST",

                        headers: {
                            "Content-Type": "application/json"
                        },

                        body: JSON.stringify(dades)

                    });

                    const final = await resposta.json();

                    if (final.token) {

                        window.location.assign("/views/user/paginaUsuari.php");

                    } else {

                        resultat.textContent = final.error;

                    }

                } catch (error) {

                    resultat.textContent = "Error en el login";

                    console.error(error);

                }

            });

            </script>
            <?php include_once __DIR__ . "/../layout/footer.html"; ?>
    </body>
    </html>