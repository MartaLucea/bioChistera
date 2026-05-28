<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/css/practiquesSostenibles.css">
    <title>Pràctiques Sostenibles — BioChistera</title>
</head>
<body>
    <?php include_once '../layout/header.php'; ?>

    <main>
        <section class="ods-hero">
            <p class="ods-hero__breadcrumb"><a href="/index.php">Inici</a> › Pràctiques Sostenibles</p>
            <h1>Sostenibilitat en el Desenvolupament</h1>
            <p class="ods-hero__sub">
                En el projecte BioChistera, la sostenibilitat no és només el tema de la web, sinó la base de com l'hem programat. 
                Apliquem criteris d'eficiència digital per reduir la petjada de carboni del nostre codi.
            </p>
        </section>

        <section class="prac-stats">
            <div class="prac-stats__grid">
                <div class="prac-stat">
                    <span class="prac-stat__num">0</span>
                    <span class="prac-stat__label">Fulls de paper</span>
                </div>
                <div class="prac-stat">
                    <span class="prac-stat__num">Async</span>
                    <span class="prac-stat__label">Comunicació eficient</span>
                </div>
                <div class="prac-stat">
                    <span class="prac-stat__num">OLED</span>
                    <span class="prac-stat__label">Friendly Design</span>
                </div>
                <div class="prac-stat">
                    <span class="prac-stat__num">API</span>
                    <span class="prac-stat__label">REST optimitzada</span>
                </div>
            </div>
        </section>

        <section class="practiques">
            <div class="contenidor">
                <h2 class="prac-categoria__titol">RA5: Programació Web Eficient</h2>
                <div class="prac-grid">
                    <div class="prac-card">
                        <div class="prac-card__header">
                            <h3>Comunicació asíncrona (Fetch API)</h3>
                        </div>
                        <p>Utilitzem <code>async/await</code> per fer peticions puntuals a la nostra API REST. Això evita recarregar tota la pàgina i els seus recursos (imatges, CSS, scripts) cada vegada, transferint només les dades necessàries en format JSON, reduint dràsticament el trànsit de xarxa.</p>
                        <div class="prac-card__tag">Estalvi de dades</div>
                    </div>

                    <div class="prac-card">
                        <div class="prac-card__header">
                            <h3>Arquitectura MVC i Codi Net</h3>
                        </div>
                        <p>Hem separat la lògica de servidor (PHP) de la presentació. En reutilitzar components i models, el pes total del projecte es manté mínim. Menys codi redundant implica que el processador del servidor i del client treballen menys, estalviant energia.</p>
                        <div class="prac-card__tag">Eficiència de CPU</div>
                    </div>

                    <div class="prac-card">
                        <div class="prac-card__header">
                            <h3>Mode fosc i pantalles OLED</h3>
                        </div>
                        <p>La interfície visual s'adapta a les preferències de l'usuari. El "Dark Mode" no és només estètica: en pantalles OLED, els píxels negres estan realment apagats, reduint el consum elèctric del dispositiu de l'usuari final.</p>
                        <div class="prac-card__tag">Eco-Disseny</div>
                    </div>
                </div>

                <h2 class="prac-categoria__titol">RA3: Compromís Professional</h2>
                <div class="prac-grid">
                    <div class="prac-card">
                        <div class="prac-card__header">
                            <h3>Desenvolupament "Paperless"</h3>
                        </div>
                        <p>Tota la planificació del projecte, des del disseny de la base de dades fins als esquemes de navegació, s'ha fet mitjançant eines digitals. Hem evitat la impressió de diagrames o fragments de codi en paper durant tot el procés d'aprenentatge.</p>
                        <div class="prac-card__tag">Residus Zero</div>
                    </div>

                    <div class="prac-card">
                        <div class="prac-card__header">
                            <h3>Gestió energètica de l'espai de treball</h3>
                        </div>
                        <p>Durant el desenvolupament a l'aula, hem mantingut una política d'apagada total dels equips en finalitzar la jornada, evitant el mode "Stand-by", i hem prioritzat la il·luminació natural per minimitzar el consum elèctric innecessari.</p>
                        <div class="prac-card__tag">Hàbits sostenibles</div>
                    </div>

                    <div class="prac-card">
                        <div class="prac-card__header">
                            <h3>Eines col·laboratives al núvol</h3>
                        </div>
                        <p>L'ús de GitHub per al control de versions i Google Drive per a la documentació ha permès un treball asíncron i col·laboratiu sense necessitat d'intercanvis físics de suports de memòria o desplaçaments innecessaris.</p>
                        <div class="prac-card__tag">Treball en remot</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="prac-reflexio">
            <div class="contenidor">
                <div class="ods-block ods-block--highlight">
                    <h2>Conclusió: Cap a un futur digital verd</h2>
                    <p>
                        Com a desenvolupadors, som conscients que el sector TIC ja consumeix prop del 10% de l'electricitat mundial. 
                        A BioChistera creiem que el codi ben escrit és codi sostenible. Cada línia optimitzada i cada imatge comprimida 
                        és una petita contribució a la preservació del nostre entorn.
                    </p>
                </div>
            </div>
        </section> 
    </main>

    <?php include_once '../layout/footer.html'; ?>
</body>
</html>