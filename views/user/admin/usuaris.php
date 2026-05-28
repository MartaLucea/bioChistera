<?php
require_once __DIR__ . "/../../auth/validar.php";

$token = $_COOKIE["token"];
$parts = explode(".", $token);
$payload = json_decode(base64_decode($parts[1]), true);

if ($payload['rol'] !== "admin") {
    header("Location: ../../../index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../../public/css/administrar.css">
    <title>BioChistera - Admin</title>
</head>
<body>
    <?php include_once '../../layout/header.php'; ?>
    <main>
        <div class="container">
            <div class="hero">
                <h1>Administrar usuaris</h1>
            </div>

            <div class="grid" id="tutorials">
                <p>Carregant usuaris...</p>
            </div>
        </div>
    </main>

    <script>
        async function carregarUsuaris() {
            try {
                const res = await fetch('../../../controller/UsuariController.php?accio=llistarTots');
                const usuaris = await res.json();
                
                const grid = document.getElementById('tutorials');

                if (!usuaris.length) {
                    grid.innerHTML = "<p>No hi ha usuaris per mostrar.</p>";
                    return;
                }

                grid.innerHTML = usuaris.map(u => `
                    <div class="card" onclick="window.location.href='../../usuaris/detall.php?id=${u.id}'">
                        <div class="card-content">
                            <div class="card-header">
                                <span class="card-cat cat-${u.rol.toLowerCase()}">
                                    ${u.rol}
                                </span>
                                <span class="card-date">ID: ${u.id}</span>
                            </div>
                            <h3 class="card-title">${u.nom}</h3>
                            <p class="card-user">${u.email}</p>
                        </div>

                        <div class="botons">
                            <p onclick="event.stopPropagation(); eliminarUsuari(${u.id})">
                                Suspendre
                            </p>
                        </div>
                    </div>
                `).join('');

            } catch (error) {
                console.error("Error carregant usuaris:", error);
                document.getElementById('tutorials').innerHTML = "<p>Error al carregar les dades.</p>";
            }
        }

        function eliminarUsuari(id) {
            if (!confirm("Segur que vols suspendre aquest usuari?")) return;

            fetch(`../../../controller/UsuariController.php?accio=eliminar&id=${id}`)
                .then(res => res.json())
                .then(data => {
                    if (data.error) {
                        alert(data.error);
                    } else {
                        alert(data.missatge || "Usuari eliminat");
                        carregarUsuaris(); 
                    }
                })
                .catch(err => console.error("Error:", err));
        }

        carregarUsuaris();
    </script>
    <?php include_once '../../layout/footer.html'; ?>
</body>
</html>