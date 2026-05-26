<?php
function getODSData($ods) {
    switch ($ods){
        case 3:
            return [
                "titol" => "<h1>Salut i Benestar</h1>",
                "subtitol" =>"<p>Garantir una vida sana i promoure el benestar per a totes les persones de totes les edats.</p>",
                "img" =>'<img src="../../public/img/ods/ods3.jpg" alt="ODS 3" class="ods-detail-hero__img">',
                "queEs" => "<p>L'ODS 3 va més enllà de la medicina: inclou el benestar emocional, la salut mental i l'accés a
                                experiències que milloren la qualitat de vida. Reconeix que l'art, el joc i la creativitat són
                                factors essencials per a la salut integral de les persones.</p>",
                "quote" => '<blockquote class="ods-quote">
                                Moltes persones en situació vulnerable no tenen accés a activitats lúdiques i creatives. La
                                màgia i el circ poden ser eines terapèutiques, però el seu cost les fa inaccessibles per a
                                molts.
                            </blockquote>',
                "repte" => "<p>Els cursos presencials d'arts escèniques i el material professional queden fora de l'abast
                                econòmic de la majoria. Educadors i treballadors socials sovint no disposen de recursos pràctics
                                per introduir el joc creatiu en el seu dia a dia.</p>",
                "impactaItem1" =>"<strong>Tutorials gratuïts</strong>
                                    <p>Qualsevol persona, inclosos educadors i treballadors socials, pot aprendre tècniques de
                                        màgia i clown sense cap cost.</p>",
                "impactaItem2" => "<strong>Material assequible</strong>
                                    <p>El mercat de segona mà permet accedir a material de qualitat a preus molt reduïts,
                                        eliminant la barrera econòmica per practicar.</p>",
                "impactaItem3" => "<strong>Art com a eina terapèutica</strong>
                                    <p>L'art i el joc han demostrat científicament reduir l'estrès i millorar l'estat anímic.
                                        BioChistera facilita l'accés a aquestes eines.</p>",                        
                "ambiental" => "<p>Indirecte: plataforma digital que evita desplaçaments per accedir a formació.</p>",
                "social" => "<p>Accés a activitats creatives i terapèutiques per a tothom, sense barreres econòmiques.</p>",
                "govern" => "<p>Coneixement obert i accessible sense intermediaris ni costos de llicència.</p>",   
                "nav" => '<a href="index.php" class="ods-nav__back">← Tornar als ODS</a>
                        <div class="ods-nav__arrows">
                            <a href="detall.php?ods=10" class="ods-nav__next">ODS 10 →</a>
                        </div>'
            ];
        case 10:
            return [
                "titol" => "<h1>Reducció de les Desigualtats</h1>",
                "subtitol" =>"<p>Reduir la desigualtat dins dels països i entre ells, garantint l'accés igualitari a recursos
                            i oportunitats.</p>",
                "img" =>'<img src="../../public/img/ods/ods10.jpg" alt="ODS 10" class="ods-detail-hero__img">',
                "queEs" => "<p>L'ODS 10 busca reduir les desigualtats d'accés a recursos, cultura i oportunitats. Inclou la
                            desigualtat econòmica, però també la desigualtat d'accés a la formació, a les eines i a les
                            xarxes de contactes que permeten créixer professionalment.</p>",
                "quote" => '<blockquote class="ods-quote">
                            El material professional de màgia, circ i clown és car. La formació especialitzada és costosa.
                            Això exclou els artistes emergents i les persones amb menys recursos de practicar i créixer.
                            </blockquote>',
                "repte" => "<p>Un joc de malabars professional pot costar més de 100€. Un curs presencial de màgia, centenars.
                        Aquesta barrera econòmica fa que les arts escèniques siguin un privilegi, no un dret.</p>",
                "impactaItem1" =>"<strong>Material assequible per a tothom</strong>
                                    <p>El mercat de segona mà permet accedir a material de qualitat a una fracció del preu
                                    original, trencant la barrera econòmica.</p>",
                "impactaItem2" => "<strong>Formació sense cost</strong>
                                    <p>El repositori de tutorials elimina la barrera formativa: aprendre màgia o circ ja no
                                    requereix pagar un curs ni tenir contactes.</p>",
                "impactaItem3" => "<strong>Igualtat d'oportunitats</strong>
                                    <p>Qualsevol persona, independentment del seu origen o situació econòmica, pot participar
                                    com a compradora, venedora o creadora de contingut.</p>",                        
                "ambiental" => "<p>Neutre directe. La reducció de desigualtats es produeix principalment a nivell social i
                                econòmic.</p>",
                "social" => "<p>Democratitza l'accés a la cultura, la formació artística i el material escènic de
                                qualitat.</p>",
                "govern" => "<p>Plataforma horitzontal sense jerarquies econòmiques: tothom hi participa en igualtat de
                                condicions.</p>",   
                "nav" => '<a href="index.php" class="ods-nav__back">← Tornar als ODS</a>
                            <div class="ods-nav__arrows">
                                <a href="detall.php?ods=3" class="ods-nav__prev">← ODS 3</a>
                                <a href="detall.php?ods=12" class="ods-nav__next">ODS 12 →</a>
                            </div>'
            ];
        case 12: 
            return [
                "titol" => "<h1>Producció i Consum Responsables</h1>",
                "subtitol" =>"<p>Garantir modalitats de consum i producció sostenibles, reduint el malbaratament i allargant
                            la vida dels productes.</p>",
                "img" =>'<img src="../../public/img/ods/ods12.jpg" alt="ODS 12" class="ods-detail-hero__img">',
                "queEs" => "<p>L'ODS 12 promou l'economia circular per sobre del model lineal de 'comprar, usar, llençar'.
                        L'objectiu és fer més amb menys: reduir el malbaratament, allargar la vida dels productes i
                        fomentar la reutilització com a norma i no com a excepció.</p></p>",
                "quote" => "<blockquote class='ods-quote'>
                               Cada any, milers d'objectes escènics en perfecte estat acaben als abocadors mentre altres
                        persones compren els mateixos objectes nous, generant el doble d'impacte ambiental i econòmic.
                            </blockquote>",
                "repte" => "<p>El material de màgia, circ i clown es produeix majoritàriament amb plàstics, metalls i teixits
                        sintètics. Té un cicle de vida curt perquè els artistes canvien de repertori, creixen o
                        abandonen la pràctica. El resultat: residus evitables i consum innecessari.</p>",
                "impactaItem1" =>"<strong>Economia circular en acció</strong>
                                    <p>Cada compravenda de segona mà evita la fabricació d'un producte nou i el residu d'un
                                producte usat. El valor dels objectes es manté dins la comunitat.</p>",
                "impactaItem2" => "<strong>Reparació i manteniment</strong>
                                    <p>Els tutorials inclouen contingut sobre com mantenir i reparar el material escènic per
                                allargar-ne la vida útil.</p>",
                "impactaItem3" => "<strong>Educació en consum responsable</strong>
                                    <p>La plataforma educa implícitament en valors de consum responsable pel sol fet d'existir
                                com a alternativa a la compra de productes nous.</p>",                        
                "ambiental" => "<p>Directe: reducció de residus i de consum de recursos naturals gràcies a la reutilització
                                del material.</p>",
                "social" => "<p>Estalvi econòmic per als usuaris i accés a material de qualitat que d'altra manera seria
                                inaccessible.</p>",
                "govern" => "<p>Model de negoci basat en la reutilització, no en el creixement infinit ni en el consum
                                innecessari.</p>",   
                "nav" => '<a href="index.php" class="ods-nav__back">← Tornar als ODS</a>
                        <div class="ods-nav__arrows">
                            <a href="detall.php?ods=10" class="ods-nav__prev">← ODS 10</a>
                                <a href="detall.php?ods=17" class="ods-nav__next">ODS 17 →</a>
                        </div>'
            ];
        case 17:
            return [
                "titol" => "<h1>Aliança pels Objectius</h1>",
                "subtitol" =>"<p>Enfortir els mitjans d'implementació i revitalitzar l'Aliança Mundial per al Desenvolupament
                            Sostenible.</p>",
                "img" =>'<img src="../../public/img/ods/ods17.jpg" alt="ODS 17" class="ods-detail-hero__img">',
                "queEs" => "<p>L'ODS 17 reconeix que cap dels altres 16 objectius es pot assolir en solitari. Cal construir
                        aliances entre persones, comunitats i organitzacions per multiplicar l'impacte. Les plataformes
                        digitals són eines clau per crear aquestes connexions a gran escala.</p>",
                "quote" => '<blockquote class="ods-quote">
                                Els artistes que volen vendre material usat no saben on fer-ho de forma especialitzada. Els que
                        volen aprendre no troben tutorials de qualitat. Existeix una desconnexió entre actors amb els
                        mateixos interessos que no es troben.
                            </blockquote>',
                "repte" => "<p>Sense un espai comú, el coneixement es perd, el material s'acumula i les oportunitats de
                        col·laboració desapareixen. La comunitat d'arts escèniques necessita un punt de trobada digital.</p>",
                "impactaItem1" =>"<strong>Connexió directa entre usuaris</strong>
                                    <p>El mercat connecta directament venedors i compradors de la mateixa comunitat artística
                                sense intermediaris.</p>",
                "impactaItem2" => "<strong>Xarxa de coneixement col·lectiu</strong>
                                    <p>El repositori de tutorials construeix una xarxa on tothom aporta i tothom rep: el
                                coneixement és de tots.</p>",
                "impactaItem3" => "<strong>Aliances i sinergies entre persones</strong>
                                    <p>La plataforma fomenta la creació d'aliances entre artistes, educadors i entitats, facilitant sinergies que generen noves oportunitats i amplifiquen l'impacte col·lectiu del sector.</p>",                        
                "ambiental" => "<p>Indirecte: la col·laboració digital redueix la necessitat de desplaçaments per trobar
                                material o formació.</p>",
                "social" => "<p>Construeix comunitat i xarxes de suport mutu entre artistes de qualsevol origen o
                                ubicació.</p>",
                "govern" => "<p>Model obert i col·laboratiu sense jerarquies: qualsevol persona pot contribuir i
                                beneficiar-se de la plataforma.</p>",   
                "nav" => '<a href="index.php" class="ods-nav__back">← Tornar als ODS</a>
                        <div class="ods-nav__arrows">
                            <a href="detall.php?ods=12" class="ods-nav__prev">← ODS 12</a>
                        </div>'
            ];
    }

    return null;
}
?>