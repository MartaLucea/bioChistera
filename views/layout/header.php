<header class="header">
    <a href="/index.php" class="header_logo">
        <span class="footer-title">Bio🎩Chistera</span>
    </a>

    <nav class="nav" id="menu">
        <ul class="nav-list">

            <li class="nav-item">
                <a href="/views/productes/index.php">Productes</a>
            </li>
            <li class="nav-item">
                <a href="/views/tutorials/index.php">Tutorials</a>
            </li>

            <li class="nav-item nav-item--dropdown">
                <a href="/views/ods/index.php">ODS ▼</a>
                <ul class="nav-sub">
                    <li><a href="/views/ods/detall.php?ods=3">Salut i Benestar</a></li>
                    <li><a href="/views/ods/detall.php?ods=10">Reducció de les desigualtats</a></li>
                    <li><a href="/views/ods/detall.php?ods=12">Producció i consum responsables</a></li>
                    <li><a href="/views/ods/detall.php?ods=17">Aliança pels Objectius</a></li>
                </ul>
            </li>

            <li class="nav-item nav-item--dropdown">
                <a href="#">Anàlisi ▼</a>
                <ul class="nav-sub">
                    <li><a href="/views/static/backMarket.php">Back Market</a></li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="/views/static/practiquesSostenibles.php">Pràctiques sostenibles</a>
            </li>

            <li class="nav-item">
                <a href="/views/static/preguntesFrequens.php">FAQ</a>
            </li>
            <?php
            $token = $_COOKIE["token"] ?? null;
            $user = null;

            if ($token) {
                $parts = explode(".", $token);

                if (count($parts) === 3) {
                    $payload = json_decode(base64_decode($parts[1]), true);
                    $user = $payload;
                }
            }
            ?>

            <?php if (!$user): ?>

                <li class="nav-item">
                    <a href="/views/auth/login.php">login</a>
                </li>
                <li class="nav-item">
                    <a href="/views/auth/register.php">registrar-se</a>
                </li>

            <?php else: ?>

                <li class="nav-item">
                    <a href="/views/auth/logout.php">logout</a>
                </li>
                <li class="nav-item">
                    <a href="/views/user/paginaUsuari.php">Pagina usuario</a>

                </li>
                
                <?php if (isset($user["rol"]) && $user["rol"] === "admin"): ?>
                    <li class="nav-item nav-item--dropdown">
                        <a>Administrar ▼</a>
                        <ul class="nav-sub">
                            <li><a href="/views/user/admin/tutorials.php">Tutorials</a></li>
                            <li><a href="/views/user/admin/productes.php">Productes</a></li>
                            <li><a href="/views/user/admin/usuaris.php">Usuaris</a></li>                        
                        </ul>
                    </li>
                <?php endif; ?>

            <?php endif; ?>

            <li class="nav-item">
                <button id="theme-toggle" class="theme-btn" aria-label="Canviar mode">
                    <span class="icon-sun">☀︎</span>
                    <span class="icon-moon" style="display:none;">★</span>
                    <script>
                        const btn = document.getElementById('theme-toggle');
                        const sun = btn.querySelector('.icon-sun');
                        const moon = btn.querySelector('.icon-moon');
                        
                        function actualitzaIcones() {
                            if (document.body.classList.contains('light-mode')) {
                                sun.style.display = 'none';
                                moon.style.display = 'inline';
                            } else {
                                sun.style.display = 'inline';
                                moon.style.display = 'none';
                            }
                        }

                        btn.addEventListener('click', () => {
                            document.body.classList.toggle('light-mode');

                            const esClar = document.body.classList.contains('light-mode');

                            localStorage.setItem('tema', esClar ? 'clar' : 'fosc');

                            actualitzaIcones();
                        });

                        if (localStorage.getItem('tema') === 'clar') {
                            document.body.classList.add('light-mode');
                        }
                        actualitzaIcones();
                </script>
                </button>
            </li>
        </ul>
    </nav>

    <button class="nav-toggle" id="nav-toggle" aria-label="Obrir menú">
        <span></span>
        <span></span>
        <span></span>
    </button>
</header>