<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>BioChistera</title>
</head>

<body>

    <?php include_once 'include/header.php'; ?>

    <section id="capcalera">
        <h1>Bio🎩Chistera</h1>
        <p class="subtitol">Del barret, un conill. De nosaltres, un canvi.</p>
        <p class="descripcio">
            Marketplace solidari de material de <strong>màgia, circ i clown</strong>.
            Compra, ven, intercanvia i aprèn amb tutorials de la comunitat.
        </p>
        <div class="botons">
            <a href="pages/productes.php" class="boto principal">Explorar el mercat</a>
            <a href="pages/tutorials.php" class="boto secundari">Veure tutorials</a>
        </div>
    </section>
    <section id="sobre">
        <div class="contenidor">
            <h2>Què és BioChistera?</h2>
            <p>
                BioChistera és una plataforma pensada per a artistes de carrer, mags, pallassos i
                acròbates. Aquí pots donar una segona vida al teu material escènic en desús,
                trobar allò que necessites per al teu proper espectacle, i aprendre noves
                tècniques gràcies als tutorials de la comunitat.
            </p>
            <p>
                No és una botiga de coses noves. És un espai d'<strong>intercanvi i reutilització</strong>
                vinculat als Objectius de Desenvolupament Sostenible de l'ONU.
            </p>
        </div>
    </section>


    <section id="categories">
        <div class="contenidor">
            <h2>Explora per categoria</h2>
            <div class="graella-categories">
                <a href="#" class="categoria">
                    <img src="https://fluentdeck.vercel.app/emoji/png/animated/crystal_ball_animated.png" alt="Star" width="50" /><strong>Màgia</strong>
                    <p>Baralles, varetas...</p>
                </a>
                <a href="mercat.php?cat=circ" class="cat-item">
                    <img src="https://fluentdeck.vercel.app/emoji/png/3D/circus_tent_3d.png" alt="Performing Arts" width="50" />
                    <strong>Circ</strong>
                    <p>Malabars, monocicles, cèrcols...</p>
                </a>
                <a href="mercat.php?cat=clown" class="cat-item">
                    <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Animated-Fluent-Emojis/master/Emojis/Activities/Performing%20Arts.png" alt="Performing Arts" width="50" />
                    <strong>Clown</strong>
                    <p>Nassos, vestits, maquillatge...</p>
                </a>
                <a href="/pages/tutorials.php" class="cat-item">
                    <img src="https://fluentdeck.vercel.app/emoji/png/3D/clapper_board_3d.png" alt="Performing Arts" width="50" />
                    <strong>Tutorials</strong>
                    <p>Vídeos de la comunitat</p>
                </a>
            </div>
        </div>
    </section>

    <section id="articles-recents">
        <div class="contenidor">
            <div class="cap-seccio">
                <h2>Últims articles</h2>
                <a href="pages/productes.php">Veure tots →</a>
            </div>
            <div class="graella-articles" id="articles-js">
                <p class="carregant">Carregant articles...</p>
            </div>
        </div>
    </section>

    <section id="tutorials-recents">
        <div class="contenidor">
            <div class="cap-seccio">
                <h2>Tutorials recents</h2>
                <a href="pages/tutorials.php">Veure tots →</a>
            </div>
            <div class="graella-tutorials" id="tutorials-js">
                <p class="carregant">Carregant tutorials...</p>
            </div>
        </div>
    </section>

    <section id="com-funciona">
        <div class="contenidor">
            <h2>Com funciona?</h2>
            <div class="passos">
                <div class="pas">
                    <span class="numero">01</span>
                    <strong>Registra't</strong>
                    <p>Crea un compte gratuït i uneix-te a la comunitat.</p>
                </div>
                <div class="pas">
                    <span class="numero">02</span>
                    <strong>Publica o compra</strong>
                    <p>Ven el teu material en desús o troba el que necessites.</p>
                </div>
                <div class="pas">
                    <span class="numero">03</span>
                    <strong>Aprèn i ensenya</strong>
                    <p>Comparteix tutorials o aprèn nous trucs i tècniques.</p>
                </div>
                <div class="pas">
                    <span class="numero">04</span>
                    <strong>Impacta</strong>
                    <p>Cada intercanvi contribueix als ODS 3, 10 i 17.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="ods">
        <div class="contenidor">
            <h2>Un marketplace amb propòsit</h2>
            <p>
                BioChistera està vinculada a tres Objectius de Desenvolupament Sostenible de l'ONU.
                Cada vegada que reutilitzes material o comparteixes coneixement, estàs contribuint
                a un món més just i sostenible.
            </p>
            <div class="llista-ods">
                <div class="element-ods">
                    <strong>ODS 3</strong>
                    <span>Salut i Benestar</span>
                    <p>L'art millora el benestar emocional en col·lectius vulnerables.</p>
                </div>
                <div class="element-ods">
                    <strong>ODS 10</strong>
                    <span>Reducció de Desigualtats</span>
                    <p>L'art solidari arriba on altres recursos no poden.</p>
                </div>
                <div class="element-ods">
                    <strong>ODS 12</strong>
                    <span>Producció i consum responsables</span>
                    <p>El consum responsable del material escènic i reduint residus.</p>
                </div>
                <div class="element-ods">
                    <strong>ODS 17</strong>
                    <span>Aliances</span>
                    <p>La plataforma és en si mateixa una xarxa de col·laboració.</p>
                </div>
            </div>
            <a href="ods.php" class="boto-secundari">Saber-ne més</a>
        </div>
    </section>

    <section id="crida">
        <div class="contenidor">
            <h2>Llest per treure el conill del barret?</h2>
            <p>Publica el teu primer producte avui i dona-li una segona vida al teu material.</p>
            <div class="botons">
                <a href="/views/register.php" class="boto principal">Publicar producte</a>
                <a href="/views/register.php" class="boto secundari">Crear compte gratis</a>
            </div>
        </div>
    </section>

    <?php include_once 'include/footer.html'; ?>
</body>
<script>
    async function recents() {
        try {
            const response = await fetch(`http://localhost:3001/recents`);

            if (!response.ok) {
                throw new Error("Error al obtenir els recents");
            }

            const tot = await response.json();

            console.log(tot);

            const grid = document.getElementById('tutorials-js');

            if (!tot.tutorials.length) return;

            grid.innerHTML = tot.tutorials.map(t => `
      <div class="card">
        <span class="card-cat cat-${t.categoria.toLowerCase()}">${t.categoria}</span>
        <h3>${t.titol}</h3>
        <div class="card-meta">
          <span>${t.durada_minuts} min</span>
        </div>
      </div>
    `).join('');

            const materials = document.getElementById('articles-js');

            if (tot.productes.length) {
                materials.innerHTML = tot.productes.map(p => `
        <div class="card">
          <h3>${p.nom}</h3>
          <p>${p.descripcio}</p>
        </div>
      `).join('');
            }

        } catch (error) {
            console.error("Error:", error);
        }
    }

    recents();
</script>

</html>