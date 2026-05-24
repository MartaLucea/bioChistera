<?php

$token = $_COOKIE["token"] ?? null;

if ($token) {
    $parts = explode(".", $token);

    if (count($parts) === 3) {
        header("Location: paginaUsuari.php");
        exit;
    }
}

include_once __DIR__ . "/../include/head.php";
?>
    <main  class="login-main">
        <h2 id="login-h2">Registrar-se</h2>

        <form action="/proc/login.proc.php" method="POST">
            <input type="hidden" name="anterior" value="<?= $_GET['anterior'] ?? 'ranking' ?>">

            <div>
                <label for="correu">Correu</label>
                <input type="email" id="correu" name="correu" required placeholder="Correu electronic">
            </div>

            <div>
                <label for="usuari">Nom de usuari</label>
                <input type="text" id="usuari" name="usuari" required placeholder="Tu nombre de usuario">
            </div>

            <div>
                <label for="contrasenya">Contraseña</label>
                <input type="password" id="contrasenya" name="contrasenya" required placeholder="••••••••">
            </div>

            <button class="submit" type="submit">Registrar-se →</button>

            <p class="no-registrar" style="text-align:center; margin-top:1rem;">
            ¿Tens compte?
            <a class="registrar" href="/views/login.php">Login aquí</a>
        </p>
        </form>
       
    </main>
     <?php include_once __DIR__ . "/../include/footer.html"; ?>
</body>

</html>