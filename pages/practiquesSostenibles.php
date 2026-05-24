<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Pràctiques Sostenibles — BioChistera</title>
</head>
<body>
    <?php include_once '../include/header.php'; ?>

    <main>

        <section class="ods-hero">
            <p class="ods-hero__breadcrumb"><a href="../index.php">Inici</a> › Pràctiques Sostenibles</p>
            <h1>Com treballem de forma sostenible</h1>
            <p class="ods-hero__sub">
                No n'hi ha prou amb parlar de sostenibilitat; cal practicar-la cada dia. Aquí recollim totes les decisions
                que hem pres durant el desenvolupament de BioChistera per reduir el nostre impacte ambiental.
            </p>
        </section>

        <section class="prac-stats">
                <div class="prac-stats__grid">
                    <div class="prac-stat">
                        <span class="prac-stat__num">0</span>
                        <span class="prac-stat__label">fulls impresos</span>
                    </div>
                    <div class="prac-stat">
                        <span class="prac-stat__num">100%</span>
                        <span class="prac-stat__label">codi net i optimitzat</span>
                    </div>
                    <div class="prac-stat">
                        <span class="prac-stat__num">☀️🌙</span>
                        <span class="prac-stat__label">mode clar/fosc disponible</span>
                    </div>
                    <div class="prac-stat">
                        <span class="prac-stat__num">cloud</span>
                        <span class="prac-stat__label">eines col·laboratives al núvol</span>
                    </div>
                </div>
        </section>

        <section class="practiques">
            <div class="contenidor">
                    <div class="prac-grid">

                        <div class="prac-card">
                            <div class="prac-card__header">
                                <h3>Mode fosc per defecte</h3>
                            </div>
                            <p>La interfície de BioChistera s'ha dissenyat amb fons fosc com a opció per defecte.
                            Les pantalles OLED i AMOLED apaguen els píxels negres completament, cosa que pot
                            reduir el consum de bateria fins a un 60% en dispositius mòbils moderns.</p>
                            <div class="prac-card__tag">Estalvi energètic</div>
                        </div>
                        <div class="prac-card">
                            <div class="prac-card__header">
                                <h3>Imatges optimitzades</h3>
                            </div>
                            <p>Totes les imatges del projecte han estat comprimides abans de pujar-les al servidor.
                            Hem reduït el pes sense pèrdua de qualitat visual apreciable, estalviant ample de banda
                            a cada visita i reduint el temps de càrrega de les pàgines.</p>
                            <div class="prac-card__tag">Pes de la web</div>
                        </div>

                        <div class="prac-card">
                            <div class="prac-card__header">
                                <h3>Codi net sense redundàncies</h3>
                            </div>
                            <p>Hem evitat duplicar lògica i hem reutilitzat components com el header i el footer
                            mitjançant PHP <code>include</code>. Menys codi significa menys bytes a transferir,
                            menys processament al servidor i menys consum d'energia per cada pàgina carregada.</p>
                            <div class="prac-card__tag">Eficiència</div>
                        </div>

                    </div>

                    <div class="prac-grid">
                        <div class="prac-card">
                            <div class="prac-card__header">
                                <h3>Eines col·laboratives al núvol</h3>
                            </div>
                            <p>Tot el projecte s'ha desenvolupat amb eines online com GitHub, Google Drive i Figma.
                            Això ha eliminat la necessitat de desplaçaments físics per fer entregues o revisions,
                            reduint les emissions de CO₂ associades al transport.</p>
                            <div class="prac-card__tag">Mobilitat</div>
                        </div>

                        <div class="prac-card">
                            <div class="prac-card__header">
                                <h3>Zero paper</h3>
                            </div>
                            <p>Durant tot el procés de desenvolupament no hem imprès cap document, apunt, esquema
                            ni fragment de codi. Tota la documentació, les anotacions i els prototips s'han
                            gestionat en format digital.</p>
                            <div class="prac-card__tag">Recursos</div>
                        </div>

                        <div class="prac-card">
                            <div class="prac-card__header">
                                <h3>Control de versions amb Git</h3>
                            </div>
                            <p>Hem fet servir Git i GitHub per gestionar el codi. Això permet treballar de forma
                            asíncrona, evitar l'enviament de fitxers per correu (que implica copies innecessàries
                            en servidors) i mantenir un historial de canvis sense duplicar arxius.</p>
                            <div class="prac-card__tag">Eficiència digital</div>
                        </div>

                    </div>

                    <h2 class="prac-categoria__titol">Hàbits a l'aula</h2>
                    <div class="prac-grid">

                        <div class="prac-card">
                            <div class="prac-card__header">
                                <h3>Ordinadors apagats, no en suspensió</h3>
                            </div>
                            <p>Al final de cada sessió de treball hem apagat completament els ordinadors en lloc
                            de deixar-los en mode suspensió o en espera. Un equip en suspensió segueix consumint
                            entre 1 i 5W de forma contínua, mentre que apagat el consum és pràcticament zero.</p>
                            <div class="prac-card__tag">Consum elèctric</div>
                        </div>

                        <div class="prac-card">
                            <div class="prac-card__header">
                            <h3>Llum apagada quan no cal</h3>
                            </div>
                            <p>Durant les sessions de treball a l'aula hem aprofitat la llum natural sempre que
                            ha estat possible i hem apagat les llums artificials en sortir. Petits gestos que,
                            multiplicats pels dies de treball del projecte, suposen un estalvi real.</p>
                            <div class="prac-card__tag">Consum elèctric</div>
                        </div>

                        <div class="prac-card">
                            <div class="prac-card__header">
                                <h3>Reutilització del hardware existent</h3>
                            </div>
                            <p>Tot el projecte s'ha desenvolupat amb els dispositius que ja teníem disponibles,
                            sense adquirir cap equip nou. Prolongar la vida útil dels dispositius existents és
                            una de les formes més efectives de reduir l'impacte ambiental de la tecnologia.</p>
                            <div class="prac-card__tag">Economia circular</div>
                        </div>

                    </div>
            </div>
        </section>

        <section class="prac-reflexio">
            <div class="contenidor">
                <div class="ods-block ods-block--highlight">
                    <h2>Per què ens importa</h2>
                    <p>
                        Internet i els dispositius digitals representen actualment al voltant del 4% de les emissions
                        globals de CO₂, una xifra que creix any rere any. Com a futurs desenvolupadors web, tenim la
                        responsabilitat d'escriure codi que no només funcioni, sinó que ho faci de la manera menys
                        costosa per al planeta. BioChistera és el nostre primer pas en aquesta direcció.
                    </p>
                </div>
            </div>
        </section> 

    </main>

    <?php include_once '../include/footer.html'; ?>
</body>
</html>