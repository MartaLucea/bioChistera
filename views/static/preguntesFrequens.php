<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/faq.css">
    <title>BioChistera</title>
</head>
<body>
    <?php include_once '../layout/header.php'; ?>
<main>
    <section id="faq-hero">
        <h1>Preguntes Freqüents</h1>
        <p>Tot el que necessites saber sobre BioChistera, d'un sol cop d'ull.</p>
    </section>

    <div id="faq-search-wrap">
        <input
            type="search"
            id="faq-search"
            placeholder="Cerca una pregunta..."
            aria-label="Cerca preguntes freqüents"
        >
    </div>

    <div id="faq-tabs" role="tablist">
        <button class="faq-tab actiu" data-cat="totes">Totes</button>
        <button class="faq-tab" data-cat="mercat">Mercat</button>
        <button class="faq-tab" data-cat="compte">Compte</button>
        <button class="faq-tab" data-cat="tutorials">Tutorials</button>
        <button class="faq-tab" data-cat="ods">ODS &amp; Sostenibilitat</button>
        <button class="faq-tab" data-cat="tecnics">Tècnics</button>
    </div>

    <div id="faq-contenidor" aria-live="polite">

        <div class="faq-grup" data-cat="mercat">
            <button class="faq-pregunta" aria-expanded="false">
                <span><span class="badge-cat mercat">Mercat</span>Com puc publicar un article?</span>
                <span class="icona">+</span>
            </button>
            <div class="faq-resposta" role="region">
                <p>Ve a la pàgina d'usuari i fes clic a «Pujar material», omple el formulari amb el títol, categoria, descripció, preu (o marca-ho com a donació / intercanvi) i afegeix fotos. Un cop enviat, l'article apareixerà al mercat en pocs minuts.</p>
            </div>
        </div>

        <div class="faq-grup" data-cat="mercat">
            <button class="faq-pregunta" aria-expanded="false">
                <span><span class="badge-cat mercat">Mercat</span>Puc donar material en lloc de vendre'l?</span>
                <span class="icona">+</span>
            </button>
            <div class="faq-resposta" role="region">
                <p>Sí! BioChistera promou la donació i l'intercanvi. En crear l'article pots escollir entre «Venda» o «Donació». Les donacions estan especialment valorats per la comunitat perquè contribueixen directament als nostres ODS.</p>
            </div>
        </div>

        <div class="faq-grup" data-cat="mercat">
            <button class="faq-pregunta" aria-expanded="false">
                <span><span class="badge-cat mercat">Mercat</span>Quin tipus de material es pot publicar?</span>
                <span class="icona">+</span>
            </button>
            <div class="faq-resposta" role="region">
                <p>Qualsevol material relacionat amb les arts escèniques: articles de màgia (baralles, varetes, caixes), material de circ (malabars, monocicles, cèrcols), material de clown (nassos, vestits, maquillatge) i accessoris d'actuació en general. <strong>No</strong> s'accepta material que no sigui escènic ni articles il·legals.</p>
            </div>
        </div>

        <div class="faq-grup" data-cat="mercat">
            <button class="faq-pregunta" aria-expanded="false">
                <span><span class="badge-cat mercat">Mercat</span>Com puc editar o eliminar el meu article?</span>
                <span class="icona">+</span>
            </button>
            <div class="faq-resposta" role="region">
                <p>Des del teu perfil, a la secció «Els meus articles», trobaràs botons d'edició i eliminació al costat de cada publicació. Els canvis es guarden automàticament a la nostra API.</p>
            </div>
        </div>

        <div class="faq-grup" data-cat="compte">
            <button class="faq-pregunta" aria-expanded="false">
                <span><span class="badge-cat compte">Compte</span>Cal registrar-se per veure el mercat?</span>
                <span class="icona">+</span>
            </button>
            <div class="faq-resposta" role="region">
                <p>No. Qualsevol persona pot navegar pel mercat i veure els tutorials sense cap compte. El registre és necessari únicament per publicar articles, pujar tutorials o contactar amb altres usuaris.</p>
            </div>
        </div>

        <div class="faq-grup" data-cat="compte">
            <button class="faq-pregunta" aria-expanded="false">
                <span><span class="badge-cat compte">Compte</span>El registre és gratuït?</span>
                <span class="icona">+</span>
            </button>
            <div class="faq-resposta" role="region">
                <p>Sí, completament gratuït. BioChistera és una plataforma sense ànim de lucre orientada a la comunitat d'arts escèniques. No hi ha plans de pagament ni comissions ocults.</p>
            </div>
        </div>

        <div class="faq-grup" data-cat="tutorials">
            <button class="faq-pregunta" aria-expanded="false">
                <span><span class="badge-cat tutorials">Tutorials</span>Com puc pujar un tutorial?</span>
                <span class="icona">+</span>
            </button>
            <div class="faq-resposta" role="region">
                <p>Ve a la pàgina d'usuarii fes clic a «Pujar tutorial». Necessites un compte actiu. Pots enganxar l'URL d'un vídeo de YouTube o Vimeo i afegir un títol i descripció. La comunitat podrà veure'l immediatament.</p>
            </div>
        </div>

        <div class="faq-grup" data-cat="tutorials">
            <button class="faq-pregunta" aria-expanded="false">
                <span><span class="badge-cat tutorials">Tutorials</span>Quins formats de vídeo s'accepten?</span>
                <span class="icona">+</span>
            </button>
            <div class="faq-resposta" role="region">
                <p>Acceptem enllaços externs de YouTube i Vimeo. Per ara no és possible pujar fitxers de vídeo directament (ens ajuda a mantenir la plataforma lleugera i sostenible, reduint el consum energètic dels nostres servidors).</p>
            </div>
        </div>

        <div class="faq-grup" data-cat="ods">
            <button class="faq-pregunta" aria-expanded="false">
                <span><span class="badge-cat ods">ODS</span>Quins ODS treballa BioChistera?</span>
                <span class="icona">+</span>
            </button>
            <div class="faq-resposta" role="region">
                <p>La plataforma s'alinea principalment amb tres Objectius de Desenvolupament Sostenible de l'ONU: <strong>ODS 3</strong> (Salut i benestar), <strong>ODS 10</strong> (Reducció de desigualtats) i <strong>ODS 17</strong> (Aliances per als objectius). A més, la reutilització de material connecta amb l'<strong>ODS 12</strong> (Producció i consum responsables). <a href="../ods/index.php">Llegeix-ne més aquí.</a></p>
            </div>
        </div>

        <div class="faq-grup" data-cat="ods">
            <button class="faq-pregunta" aria-expanded="false">
                <span><span class="badge-cat ods">ODS</span>Com contribueix reutilitzar material escènic al medi ambient?</span>
                <span class="icona">+</span>
            </button>
            <div class="faq-resposta" role="region">
                <p>Cada vegada que compres o intercanvies material de segona mà evites que acabi al fem i redueixes la demanda de producció nova, que consumeix recursos naturals i genera emissions de CO₂. A BioChistera cada transacció és un petit acte d'economia circular.</p>
            </div>
        </div>

        <div class="faq-grup" data-cat="ods">
            <button class="faq-pregunta" aria-expanded="false">
                <span><span class="badge-cat ods">ODS</span>Quines pràctiques sostenibles aplica la plataforma?</span>
                <span class="icona">+</span>
            </button>
            <div class="faq-resposta" role="region">
                <p>Fem servir imatges optimitzades per reduir el pes de la web, el codi minimitza les peticions innecessàries a l'API i disposem de <strong>Mode Fosc</strong> per estalviar energia en pantalles OLED. <a href="practiquesSostenibles.php">Vés a la pàgina de pràctiques sostenibles</a> per saber-ne tots els detalls.</p>
            </div>
        </div>

        <div class="faq-grup" data-cat="tecnics">
            <button class="faq-pregunta" aria-expanded="false">
                <span><span class="badge-cat tecnics">Tècnic</span>Perquè no carreguen els articles?</span>
                <span class="icona">+</span>
            </button>
            <div class="faq-resposta" role="region">
                <p>Els articles es carreguen de forma asíncrona des de la nostra API. Si veus el missatge «Carregant articles...» durant massa temps, comprova la teva connexió a internet. Si el problema persisteix, assegura't que el servidor Node.js/Express estigui en marxa a <code>localhost:3000</code> (o al servidor de producció corresponent).</p>
            </div>
        </div>

        <div class="faq-grup" data-cat="tecnics">
            <button class="faq-pregunta" aria-expanded="false">
                <span><span class="badge-cat tecnics">Tècnic</span>La web funciona sense JavaScript?</span>
                <span class="icona">+</span>
            </button>
            <div class="faq-resposta" role="region">
                <p>La navegació bàsica i la lectura de continguts estàtics funcionen sense JS. No obstant això, el mercat d'articles, els tutorials i els formularis de publicació requereixen JavaScript activat, ja que consumeixen la nostra API REST de manera asíncrona.</p>
            </div>
        </div>

        <div id="faq-buit">
            <span>🔍</span>
            <p>Cap pregunta coincideix amb la teva cerca.</p>
        </div>

    </div>

    <?php include_once '../layout/footer.html'; ?>

    <script>
        document.querySelectorAll('.faq-pregunta').forEach(btn => {
            btn.addEventListener('click', () => {
                const expanded = btn.getAttribute('aria-expanded') === 'true';
                document.querySelectorAll('.faq-pregunta').forEach(b => {
                    b.setAttribute('aria-expanded', 'false');
                    b.nextElementSibling.classList.remove('oberta');
                });
                if (!expanded) {
                    btn.setAttribute('aria-expanded', 'true');
                    btn.nextElementSibling.classList.add('oberta');
                }
            });
        });

        const tabs = document.querySelectorAll('.faq-tab');
        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                tabs.forEach(t => t.classList.remove('actiu'));
                tab.classList.add('actiu');
                filtrarFAQ();
            });
        });

        document.getElementById('faq-search').addEventListener('input', filtrarFAQ);

        function filtrarFAQ() {
            const cat = document.querySelector('.faq-tab.actiu').dataset.cat;
            const text = document.getElementById('faq-search').value.toLowerCase().trim();
            let visibles = 0;

            document.querySelectorAll('.faq-grup').forEach(grup => {
                const coincideixCat = cat === 'totes' || grup.dataset.cat === cat;
                const contingut = grup.textContent.toLowerCase();
                const coincideixText = text === '' || contingut.includes(text);

                if (coincideixCat && coincideixText) {
                    grup.removeAttribute('hidden');
                    visibles++;
                } else {
                    grup.setAttribute('hidden', '');
                    const btn = grup.querySelector('.faq-pregunta');
                    btn.setAttribute('aria-expanded', 'false');
                    grup.querySelector('.faq-resposta').classList.remove('oberta');
                }
            });

            document.getElementById('faq-buit').style.display = visibles === 0 ? 'block' : 'none';
        }
    </script>
</main>
</body>
</html>