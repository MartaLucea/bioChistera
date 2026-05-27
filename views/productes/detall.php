<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/css/tutorials.css">
    <title>BioChistera</title>
</head>

<body>
    <?php include_once '../layout/header.php';

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

    <main class="contenidor">

        <div id="loading">
            <p>Carregant producte...</p>
        </div>

        <div id="error" style="display:none">
            <h1>Producte no trobat</h1>
            <a href="productes.php">← Tornar</a>
        </div>

        <section id="producte" style="display:none">
            <p class="ods-hero__breadcrumb">
                <a href="/index.php">Inici</a> ›
                <a href="productes.php">Productes</a> ›
                <span id="bc-nom"></span>
            </p>
            
            <div class="titol_comprar">
                <h1 id="nom"></h1>
                <?php if ($userId): ?>
                    <button id="comprar"
                        data-user-id="<?= $userId ?>"
                        style="display:none">
                        Comprar
                    </button>
                <?php endif; ?>
                </div>
            <div class="meta">
                <span id="data"></span> · <span id="usuari"></span>
            </div>

            <img id="imatge" alt="Imatge del producte" style="max-width:100%; height:auto;">

            <div class="card">
                <h3>Descripció</h3>
                <p id="descripcio"></p>
            </div>

            <div class="card">
                <h3>Informació</h3>
                <p><strong>Preu:</strong> <span id="preu"></span></p>
                <p><strong>Categoria:</strong> <span id="categoria"></span></p>
            </div>
            
        </section>

    </main>

    <?php include_once '../layout/footer.html'; ?>

    <script>
        const params = new URLSearchParams(window.location.search);
        const id = params.get('id');
        const token = getCookie("token");
        let payload = null;

        if (token) {
            try {
                payload = JSON.parse(atob(token.split(".")[1]));
            } catch {}
        }

        function getCookie(name) {
            return document.cookie.split('; ')
                .find(r => r.startsWith(name + '='))
                ?.split('=')[1] ?? null;
        }

        function formatData(data) {
            return new Date(data).toLocaleDateString('ca-ES');
        }

        function mostrarError() {
            document.getElementById('loading').style.display = 'none';
            document.getElementById('error').style.display = 'block';
        }

        async function carregarProducte() {
            if (!id) return mostrarError();

            try {
                const res = await fetch(`http://localhost:3001/productes/${id}`);
                if (!res.ok) throw new Error();
                const p = await res.json();

                document.getElementById('loading').style.display = 'none';
                document.getElementById('producte').style.display = 'block';

                document.title = p.nom;
                document.getElementById('bc-nom').textContent = p.nom;
                document.getElementById('nom').textContent = p.nom;
                document.getElementById('data').textContent = p.data_publicacio ? formatData(p.data_publicacio) : '';
                document.getElementById('usuari').textContent = p.usuari || '';
                document.getElementById('imatge').src = p.imatge || '';
                document.getElementById('descripcio').textContent = p.descripcio || '';
                document.getElementById('categoria').textContent = p.categoria || '';
                document.getElementById('preu').textContent = p.preu > 0 ? `${p.preu} €` : "Donació";

                const btnComprar = document.getElementById('comprar');

                if (btnComprar) {
                    const myId = String(btnComprar.dataset.userId);
                    if (String(p.id_usuari) !== myId && p.comprat === 0) {
                        btnComprar.style.display = 'inline-block';
                    }
                }

            } catch {
                mostrarError();
            }
        }

        const btnComprar = document.getElementById('comprar');

        if (btnComprar) {
            btnComprar.addEventListener('click', async () => {
                try {
                    const res = await fetch('http://localhost:3001/comprar', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({
                            id_producte: id,
                            id_usuari: btnComprar.dataset.userId
                        })
                    });

                    const data = await res.json();

                    if (res.ok) {
                        alert("Producte comprat correctament");
                        window.location.assign('/views/user/paginaUsuari.php');
                    } else {
                        alert(data.error);
                    }

                } catch {
                    alert("Error de connexió.");
                }
            });
        }

        carregarProducte();
    </script>
</body>

</html>