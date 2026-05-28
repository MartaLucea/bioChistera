<?php
require_once __DIR__ . "/../auth/validar.php";

$token = $_COOKIE["token"] ?? "";
if (!$token) { header("Location: ../../index.php"); exit; }

$parts = explode(".", $token);
$payload = json_decode(base64_decode($parts[1]), true);

if ($payload['rol'] !== "admin") {
    header("Location: ../../index.php");
    exit;
}

$id_usuari = $_GET['id'] ?? null;
if (!$id_usuari) {
    echo "ID d'usuari no especificat.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../../public/css/administrar.css">
    <title>BioChistera - Detall Usuari</title>
</head>
<body>
    <?php include_once '../layout/header.php'; ?>
    <main>
        <div class="container">
            <div id="contingut-detall">
                <p>Carregant dades de l'usuari...</p>
            </div>
        </div>
    </main>

    <script>
        const idUsuari = <?= json_encode($id_usuari) ?>;

        async function carregarDetall() {
            try {
                const response = await fetch(`../../controller/UsuariController.php?accio=detall&id=${idUsuari}`);
                const u = await response.json();

                if (u.error) {
                    document.getElementById('contingut-detall').innerHTML = `<h3>Error: ${u.error}</h3>`;
                    return;
                }

                const contenedor = document.getElementById('contingut-detall'); 

                contenedor.innerHTML = `
                    <div class="hero">
                        <h1>Detall de l'Usuari</h1>
                        <a href="../user/admin/usuaris.php" style="color: white;">← Tornar a l'administració</a>
                    </div>
                    
                    <div class="card" style="max-width: 600px; margin: 20px auto; padding: 20px;">
                        <div class="card-content">
                            <div class="card-header">
                                <span class="card-cat cat-${u.rol.toLowerCase()}">${u.rol.toUpperCase()}</span>
                                <span class="card-date">Identificador: #${u.id}</span>
                            </div>
                            <h2 class="card-title" style="font-size: 2rem; margin-top: 10px;">${u.nom}</h2>
                            <hr style="margin: 20px 0; border: 0; border-top: 1px solid #eee;">
                            <p class="card-user"><strong>Correu electrònic:</strong> ${u.email}</p>
                            <p class="card-user"><strong>Estat del compte:</strong> <span style="color: green;">Actiu</span></p>
                        </div>
                        
                        <div class="botons" style="margin-top: 30px;">
                            <button onclick="eliminarUsuari(${u.id})" 
                                    style="background-color: #ff4d4d; color: white; border: none; padding: 12px 20px; cursor: pointer; width: 100%; border-radius: 5px; font-weight: bold;">
                                SUSPENDRE COMPTE
                            </button>
                        </div>
                    </div>
                `;

            } catch (error) {
                console.error("Error al carregar el detall:", error);
                document.getElementById('contingut-detall').innerHTML = "<p>No s'ha pogut connectar amb el servidor.</p>";
            }
        }

        async function eliminarUsuari(id) {
            if (!confirm("Estàs segur que vols eliminar aquest usuari? Aquesta acció no es pot desfer.")) return;
            
            try {
                const res = await fetch(`../../controller/UsuariController.php?accio=eliminar&id=${id}`);
                const data = await res.json();
                
                if (data.missatge) {
                    alert(data.missatge);
                    window.location.href = 'administrar_usuaris.php'; // Tornem a la llista
                } else {
                    alert(data.error);
                }
            } catch (e) {
                alert("Error al processar l'eliminació.");
            }
        }

        carregarDetall();
    </script>
    <?php include_once '../layout/footer.html'; ?>
</body>
</html>