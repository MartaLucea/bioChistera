<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/css/ods.css">
    <title>BioChistera</title>
</head>
<body>
    <?php include_once '../layout/header.php'; ?>

    <main>

        <section class="ods-hero">
            <p class="ods-hero__breadcrumb"><a href="/index.php">Inici</a> › ODS</p>
            <h1>El repte que volem canviar</h1>
            <p class="ods-hero__sub">
                BioChistera neix per resoldre un problema real: material escènic de qualitat
                acumulant pols i coneixement que no arriba a qui ho necessita.
                Aquí t'expliquem com actuem i quins Objectius de Desenvolupament Sostenible guien la nostra missió.
            </p>
        </section>

        <section class="problema">
            <div class="contenidor">
                <h2>El problema</h2>
                <div class="problema__grid">
                    <div class="problema__item">
                        <strong>Material acumulat sense ús</strong>
                        <p>Milers d'objectes escènics en perfecte estat acaben als calaixos o als abocadors quan els artistes canvien de repertori.</p>
                    </div>
                    <div class="problema__item">
                        <strong>Preu inaccessible</strong>
                        <p>El material professional de màgia, circ i clown és car. Els artistes emergents i els aficionats queden exclosos.</p>
                    </div>
                    <div class="problema__item">
                        <strong>Coneixement que no circula</strong>
                        <p>Trucs, tècniques i aprenentatges es queden en persones concretes en lloc de ser accessibles per a tothom.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="solucio">
            <div class="contenidor">
                <h2>Com ho resol BioChistera</h2>
                <div class="solucio__grid">
                    <div class="solucio__card">
                        <h3>El Mercat</h3>
                        <p>Compra, ven i intercanvia material escènic de segona mà. Allarga la vida dels objectes i estalvia diners.</p>
                        <a href="/productes/index.php" class="boto secundari">Explorar el mercat</a>
                    </div>
                    <div class="solucio__card">
                        <h3>Els Tutorials</h3>
                        <p>Repositori obert de vídeos de la comunitat. Aprèn màgia, circ i clown de forma totalment gratuïta.</p>
                        <a href="/tutorials/index.php" class="boto secundari">Veure tutorials</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="ods-cards">
            <div class="contenidor">
                <h2>Els nostres ODS</h2>
                <p class="ods-cards__sub">Passa el ratolí per sobre de cada carta per descobrir com BioChistera contribueix a cada objectiu.</p>
                <div class="flip-grid">

                    <div class="flip-card">
                        <div class="flip-card-inner">
                            <div class="flip-card-front">
                                <img src="/public/img/ods/ods3.jpg" alt="ODS 3 - Salut i Benestar">
                                <span class="flip-card-num">03</span>
                            </div>
                            <div class="flip-card-back flip-card-back--3">
                                <strong class="flip-back__num">03</strong>
                                <h3>Salut i Benestar</h3>
                                <p>Els tutorials gratuïts permeten usar l'art com a eina terapèutica, accessible per a tothom sense barreres econòmiques.</p>
                                <a href="/views/ods/detall.php?ods=3" class="flip-card__btn">Saber-ne més →</a>
                            </div>
                        </div>
                    </div>

                    <div class="flip-card">
                        <div class="flip-card-inner">
                            <div class="flip-card-front">
                                <img src="/public/img/ods/ods10.jpg" alt="ODS 10 - Reducció de les desigualtats">
                                <span class="flip-card-num">10</span>
                            </div>
                            <div class="flip-card-back flip-card-back--10">
                                <strong class="flip-back__num">10</strong>
                                <h3>Reducció de Desigualtats</h3>
                                <p>El mercat de segona mà i els tutorials gratuïts eliminen les barreres econòmiques i formatives per a artistes emergents.</p>
                                <a href="/views/ods/detall.php?ods=10" class="flip-card__btn">Saber-ne més →</a>
                            </div>
                        </div>
                    </div>

                    <div class="flip-card">
                        <div class="flip-card-inner">
                            <div class="flip-card-front">
                                <img src="/public/img/ods/ods12.jpg" alt="ODS 12 - Consum responsable">
                                <span class="flip-card-num">12</span>
                            </div>
                            <div class="flip-card-back flip-card-back--12">
                                <strong class="flip-back__num">12</strong>
                                <h3>Consum Responsable</h3>
                                <p>Cada compravenda de segona mà evita la fabricació d'un producte nou i el residu d'un producte usat.</p>
                                <a href="/views/ods/detall.php?ods=12" class="flip-card__btn">Saber-ne més →</a>
                            </div>
                        </div>
                    </div>

                    <div class="flip-card">
                        <div class="flip-card-inner">
                            <div class="flip-card-front">
                                <img src="/public/img/ods/ods17.jpg" alt="ODS 17 - Aliances">
                                <span class="flip-card-num">17</span>
                            </div>
                            <div class="flip-card-back flip-card-back--17">
                                <strong class="flip-back__num">17</strong>
                                <h3>Aliança pels Objectius</h3>
                                <p>La plataforma connecta compradors, venedors i creadors de contingut en una xarxa de coneixement col·lectiu.</p>
                                <a href="/views/ods/detall.php/proc/odss.php?ods=17" class="flip-card__btn">Saber-ne més →</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main>

    <?php include_once '../layout/footer.html'; ?>
</body>
</html>