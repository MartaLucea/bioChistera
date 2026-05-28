<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/faq.css">
    <title>BioChistera - FAQ</title>
</head>
<body>
    <?php include_once '../layout/header.php'; ?>
<main>
    <section id="faq-hero">
        <h1>Preguntes Freqüents</h1>
        <p>Tot el que necessites saber sobre la màgia de compartir a BioChistera.</p>
    </section>

    <div id="faq-search-wrap">
        <input 
            type="search" 
            id="faq-search" 
            placeholder="Cerca una pregunta (ex: donacions, tutorials...)" 
            aria-label="Cerca preguntes freqüents"
        >
    </div>

    <div id="faq-tabs" role="tablist">
        <button class="faq-tab actiu" data-cat="totes">Totes</button>
        <button class="faq-tab" data-cat="mercat">Mercat Solidari</button>
        <button class="faq-tab" data-cat="tutorials">Aprendre i Tutorials</button>
        <button class="faq-tab" data-cat="ods">Impacte i ODS</button>
        <button class="faq-tab" data-cat="compte">El meu Compte</button>
        <button class="faq-tab" data-cat="tecnics">Suport Tècnic</button>
    </div>

    <div id="faq-contenidor" aria-live="polite">

        <div class="faq-grup" data-cat="mercat">
            <button class="faq-pregunta" aria-expanded="false">
                <span><span class="badge-cat mercat">Mercat</span>Què vol dir que el marketplace és "solidari"?</span>
                <span class="icona">+</span>
            </button>
            <div class="faq-resposta" role="region">
                <p>Significa que prioritzem el valor comunitari. A BioChistera fomentem que el material de circ o màgia que ja no fas servir pugui ser donat o venut a preus assequibles per ajudar a altres artistes a començar, evitant el malbaratament.</p>
            </div>
        </div>

        <div class="faq-grup" data-cat="mercat">
            <button class="faq-pregunta" aria-expanded="false">
                <span><span class="badge-cat mercat">Mercat</span>Com puc posar un article com a "Donació"?</span>
                <span class="icona">+</span>
            </button>
            <div class="faq-resposta" role="region">
                <p>Al formulari de "Pujar Producte", trobaràs una opció per marcar si l'article és una donació. Si selecciones "Sí", el preu quedarà automàticament a 0€ i l'article destacarà al mercat amb l'etiqueta de "Donació".</p>
            </div>
        </div>

        <div class="faq-grup" data-cat="tutorials">
            <button class="faq-pregunta" aria-expanded="false">
                <span><span class="badge-cat tutorials">Tutorials</span>Qui pot pujar tutorials a la plataforma?</span>
                <span class="icona">+</span>
            </button>
            <div class="faq-resposta" role="region">
                <p>Qualsevol usuari registrat! Creiem en el coneixement obert. Si saps fer un truc de màgia, una figura de malabars o una tècnica de clown, pots compartir-ho enllaçant el teu vídeo de YouTube o Vimeo.</p>
            </div>
        </div>

        <div class="faq-grup" data-cat="ods">
            <button class="faq-pregunta" aria-expanded="false">
                <span><span class="badge-cat ods">ODS</span>Per què és important l'ODS 12 per a BioChistera?</span>
                <span class="icona">+</span>
            </button>
            <div class="faq-resposta" role="region">
                <p>L'ODS 12 parla de "Producció i consum responsables". En lloc de comprar material nou fabricat industrialment, reutilitzem el que ja tenim. Això redueix la petjada de carboni i allarga la vida útil d'objectes artesans o professionals.</p>
            </div>
        </div>

        <div class="faq-grup" data-cat="compte">
            <button class="faq-pregunta" aria-expanded="false">
                <span><span class="badge-cat compte">Compte</span>He perdut la meva contrasenya, què faig?</span>
                <span class="icona">+</span>
            </button>
            <div class="faq-resposta" role="region">
                <p>Per motius de seguretat en aquesta versió beta, si no recordes les teves credencials hauràs de contactar amb l'administrador del lloc o crear un nou compte. Recorda que les contrasenyes estan xifrades a la nostra base de dades.</p>
            </div>
        </div>

        <div class="faq-grup" data-cat="tecnics">
            <button class="faq-pregunta" aria-expanded="false">
                <span><span class="badge-cat tecnics">Tècnic</span>Per què l'icona del sol i la lluna no canvien de color?</span>
                <span class="icona">+</span>
            </button>
            <div class="faq-resposta" role="region">
                <p>Això sol passar si el navegador no interpreta correctament els caràcters especials. Hem optimitzat el CSS perquè es vegin blancs o transparents segons el mode que tinguis activat per estalviar energia a la teva pantalla.</p>
            </div>
        </div>

        <div id="faq-buit">
            <span>🔍</span>
            <p>Vaja, cap barret ha tret aquest conill... (No hi ha resultats per a la teva cerca).</p>
        </div>

    </div>

    <?php include_once '../layout/footer.html'; ?>

    <script>
        // Mantenim el teu script que ja funciona perfectament per filtrar i obrir preguntes
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
                }
            });

            document.getElementById('faq-buit').style.display = visibles === 0 ? 'block' : 'none';
        }
    </script>
</main>
</body>
</html>