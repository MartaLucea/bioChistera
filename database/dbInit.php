<?php

$db = new PDO('sqlite:bioChistera.db');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$db->exec("DROP TABLE IF EXISTS tutorials");
$db->exec("DROP TABLE IF EXISTS id_usuaris");
$db->exec("DROP TABLE IF EXISTS productes");

$db->exec("
CREATE TABLE IF NOT EXISTS id_usuaris (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom TEXT NOT NULL UNIQUE,
    contrassenya TEXT NOT NULL,
    email TEXT NOT NULL,
    rol TEXT DEFAULT 'id_usuari'
    );
");

$db->exec("
CREATE TABLE IF NOT EXISTS productes (
    id INTEGER PRIMARY KEY,
    nom TEXT NOT NULL,
    categoria TEXT NOT NULL,
    subcategoria TEXT,
    descripcio TEXT,
    estat TEXT,
    imatge TEXT,
    id_usuari INTEGER,
    data_publicacio TEXT
);
");

$db->exec("
CREATE TABLE IF NOT EXISTS tutorials (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    titol TEXT NOT NULL,
    categoria TEXT NOT NULL,
    subcategoria TEXT,
    descripcio TEXT,
    durada_minuts INTEGER,
    video_url TEXT,
    id_usuari INTEGER,
    data_publicacio TEXT
);
");


$id_usuaris = [
    ["Marta", "1234", "marta@gmail.com", "admin"],
    ["CircMestre", "1234", "circ@gmail.com", "id_usuari"],
    ["PomPomClown", "1234", "pom@gmail.com", "id_usuari"],
    ["JongleurFou", "1234", "joung@gmail.com", "id_usuari"],
    ["MagicStellar", "1234", "maigc@gmail.com", "id_usuari"],
    ["RodaLliure", "1234", "roda@gmail.com", "id_usuari"],
    ["FlameCirc", "1234", "flame@gmail.com", "id_usuari"],
    ["BullonArt", "1234", "bullon@gmail.com", "id_usuari"]

];


$stmtid_Usuari = $db->prepare("
INSERT INTO id_usuaris (
    nom,
    contrassenya,
    email,
    rol
)
VALUES (?, ?, ?, ?)
");

foreach ($id_usuaris as $u) {

    $passwordHash = md5($u[1]);

    $stmtid_Usuari->execute([
        $u[0],
        $passwordHash,
        $u[2],
        $u[3]
    ]);
}


$tutorials = [

    [
        "titol" => "Introducció a la cartomagia: el forçat de carta",
        "categoria" => "Magia",
        "subcategoria" => "Cartomagia",
        "descripcio" => "Aprèn la tècnica bàsica del forçat de carta, el fonament de molts trucs de cartes clàssics. Explicació pas a pas amb càmera lenta.",
        "durada_minuts" => 12,
        "video_url" => "https://www.youtube.com/embed/dQw4w9WgXcQ",
        "id_usuari" => 1,
        "data_publicacio" => "2025-02-14"
    ],

    [
        "titol" => "Malabars amb 3 pilotes: cascada bàsica",
        "categoria" => "Circ",
        "subcategoria" => "Malabars",
        "descripcio" => "Tutorial complet per aprendre la cascada de 3 pilotes des de zero. Inclou exercicis previs amb 1 i 2 pilotes per consolidar la coordinació.",
        "durada_minuts" => 18,
        "video_url" => "https://www.youtube.com/embed/dQw4w9WgXcQ",
        "id_usuari" => 4,
        "data_publicacio" => "2025-01-30"
    ],

    [
        "titol" => "El nas vermell: com construir el teu personatge clown",
        "categoria" => "Clown",
        "subcategoria" => "Tècnica clown",
        "descripcio" => "Sessió teòrico-pràctica sobre com trobar el teu propi personatge clown. Treballa la mirada, la ridiculesa i la connexió amb el públic.",
        "durada_minuts" => 25,
        "video_url" => "https://www.youtube.com/embed/dQw4w9WgXcQ",
        "id_usuari" => 3,
        "data_publicacio" => "2025-03-05"
    ],

    [
        "titol" => "Trucs amb monedes: la desaparició bàsica",
        "categoria" => "Magia",
        "subcategoria" => "Monedes",
        "descripcio" => "Aprèn a fer desaparèixer una moneda amb tres tècniques de palming diferents. Tutorial amb càmera lenta i vista des de l'audiència.",
        "durada_minuts" => 15,
        "video_url" => "https://www.youtube.com/embed/dQw4w9WgXcQ",
        "id_usuari" => 5,
        "data_publicacio" => "2025-02-28"
    ],

    [
        "titol" => "Devil Stick: primeres figures i control bàsic",
        "categoria" => "Circ",
        "subcategoria" => "Malabars",
        "descripcio" => "Com agafar i controlar el devil stick per primera vegada. Aprèn el moviment bàsic de tick-tack i les primeres figures de control.",
        "durada_minuts" => 20,
        "video_url" => "https://www.youtube.com/embed/dQw4w9WgXcQ",
        "id_usuari" => 2,
        "data_publicacio" => "2025-03-18"
    ],

    [
        "titol" => "Globoflèxia: el gos bàsic pas a pas",
        "categoria" => "Clown",
        "subcategoria" => "Globoflèxia",
        "descripcio" => "Crea el teu primer gos de globus en menys de 5 minuts. Tutorial pensat per a animadors infantils i principiants absoluts en globoflèxia.",
        "durada_minuts" => 8,
        "video_url" => "https://www.youtube.com/embed/dQw4w9WgXcQ",
        "id_usuari" => 8,
        "data_publicacio" => "2025-04-02"
    ],

    [
        "titol" => "Cartomagia intermèdia: el doble alçament",
        "categoria" => "Magia",
        "subcategoria" => "Cartomagia",
        "descripcio" => "Domina el doble alçament, una de les tècniques més versàtils de la cartomagia. Inclou tres variants i exercicis de suavitat per fer-ho invisible.",
        "durada_minuts" => 22,
        "video_url" => "https://www.youtube.com/embed/dQw4w9WgXcQ",
        "id_usuari" => 1,
        "data_publicacio" => "2025-03-22"
    ],

    [
        "titol" => "Malabars amb maces: de pilotes a maces",
        "categoria" => "Circ",
        "subcategoria" => "Malabars",
        "descripcio" => "Si ja domines 3 pilotes, aquest tutorial t'ensenya a fer la transició a les maces. Diferències de timing, agafament i ritme explicats en detall.",
        "durada_minuts" => 28,
        "video_url" => "https://www.youtube.com/embed/dQw4w9WgXcQ",
        "id_usuari" => 4,
        "data_publicacio" => "2025-04-08"
    ],

    [
        "titol" => "Clown físic: la caiguda còmica",
        "categoria" => "Clown",
        "subcategoria" => "Clown físic",
        "descripcio" => "Tècnica de la caiguda còmica segura i efectiva. Aprèn a caure sense fer-te mal i amb màxim impacte dramàtic. Exercicis de calentament inclosos.",
        "durada_minuts" => 30,
        "video_url" => "https://www.youtube.com/embed/dQw4w9WgXcQ",
        "id_usuari" => 3,
        "data_publicacio" => "2025-03-10"
    ],

    [
        "titol" => "Anelles xineses: les tres anelles entrellaçades",
        "categoria" => "Magia",
        "subcategoria" => "Magia de escena",
        "descripcio" => "Aprèn la rutina clàssica de les tres anelles xineses entrellaçades. Tutorial amb angles múltiples i explicació detallada dels moments clau.",
        "durada_minuts" => 35,
        "video_url" => "https://www.youtube.com/embed/dQw4w9WgXcQ",
        "id_usuari" => 2,
        "data_publicacio" => "2025-02-05"
    ],

    [
        "titol" => "Monocicle: primers passos amb suport",
        "categoria" => "Circ",
        "subcategoria" => "Acrobàcia",
        "descripcio" => "Mètode progressiu per aprendre a anar en monocicle utilitzant una paret o suport. Inclou consells de postura, pedaleig i on mirar.",
        "durada_minuts" => 16,
        "video_url" => "https://www.youtube.com/embed/dQw4w9WgXcQ",
        "id_usuari" => 6,
        "data_publicacio" => "2025-04-15"
    ],

    [
        "titol" => "Màgia amb cordes: el nus que desapareix",
        "categoria" => "Magia",
        "subcategoria" => "Màgia de saló",
        "descripcio" => "Tres trucs clàssics amb cordes: el nus fantasma, la corda elàstica i la corda restaurada. Explicació amb i sense guants per veure les mans.",
        "durada_minuts" => 19,
        "video_url" => "https://www.youtube.com/embed/dQw4w9WgXcQ",
        "id_usuari" => 5,
        "data_publicacio" => "2025-01-18"
    ],

    [
        "titol" => "Globoflèxia avançada: espasa i flor",
        "categoria" => "Clown",
        "subcategoria" => "Globoflèxia",
        "descripcio" => "Dues figures intermèdies de globoflèxia molt demanades: l'espasa i la flor de cinc pètals. Tècniques per fer bombolles múltiples sense que explotin.",
        "durada_minuts" => 14,
        "video_url" => "https://www.youtube.com/embed/dQw4w9WgXcQ",
        "id_usuari" => 8,
        "data_publicacio" => "2025-04-20",
        "visualitzacions" => 390
    ],

    [
        "titol" => "Improvisació clown: el joc del fracàs",
        "categoria" => "Clown",
        "subcategoria" => "Tècnica clown",
        "descripcio" => "Taller avançat sobre la tècnica del fracàs com a motor còmic. Com convertir els errors en gold, connectar amb el públic i sostenir els silencis.",
        "durada_minuts" => 45,
        "video_url" => "https://www.youtube.com/embed/dQw4w9WgXcQ",
        "id_usuari" => 3,
        "data_publicacio" => "2025-03-25"
    ],

    [
        "titol" => "Batons de foc: seguretat i primers moviments",
        "categoria" => "Circ",
        "subcategoria" => "Arts de foc",
        "descripcio" => "Tutorial de seguretat obligatori abans de treballar amb foc: materials ignífugs, zona de treball, acompanyant de seguretat i primers moviments sense foc.",
        "durada_minuts" => 32,
        "video_url" => "https://www.youtube.com/embed/dQw4w9WgXcQ",
        "id_usuari" => 7,
        "data_publicacio" => "2025-03-08"
    ]

];

$stmtTutorial = $db->prepare("
INSERT INTO tutorials (
    titol,
    categoria,
    subcategoria,
    descripcio,
    durada_minuts,
    video_url,
    id_usuari,
    data_publicacio
)
VALUES (?, ?, ?, ?, ?, ?, ?, ?)
");


foreach ($tutorials as $t) {

    $stmtTutorial->execute([
        $t["titol"],
        $t["categoria"],
        $t["subcategoria"],
        $t["descripcio"],
        $t["durada_minuts"],
        $t["video_url"],
        $t["id_usuari"],
        $t["data_publicacio"]
    ]);
}

$productes = [

    [
        "id" => 1,
        "nom" => "Baralles de cartes Bicycle (lot de 3)",
        "categoria" => "Magia",
        "subcategoria" => "Cartomagia",
        "descripcio" => "Tres baralles de cartes Bicycle en bon estat, ideals per aprendre cartomagia bàsica i intermèdia. Lleugeres marques d'ús però totalment funcionals.",
        "estat" => "bo",
        "imatge" => "img/articles/cartes-bicycle.jpg",
        "id_usuari" => 1,
        "data_publicacio" => "2025-03-12"
    ],

    [
        "id" => 2,
        "nom" => "Anelles de metall entrellaçades (set de 8)",
        "categoria" => "Magia",
        "subcategoria" => "Magia de escena",
        "descripcio" => "Set de 8 anelles de metall cromades de 30cm de diàmetre. Perfectes per a números d'anelles xineses. Inclouen funda de transport.",
        "estat" => "molt bo",
        "imatge" => "img/articles/anelles-metall.jpg",
        "id_usuari" => 2,
        "data_publicacio" => "2025-04-01"
    ],

    [
        "id" => 3,
        "nom" => "Nas de pallasso vermell (lot de 5)",
        "categoria" => "Clown",
        "subcategoria" => "Accessoris",
        "descripcio" => "Cinc nassos de pallasso de escuma vermella de diferents mides. Nets i desinfectats. Ideals per a tallers i actuacions escolars.",
        "estat" => "bo",
        "imatge" => "img/articles/nas-pallasso.jpg",
        "id_usuari" => 3,
        "data_publicacio" => "2025-02-20"
    ],

    [
        "id" => 4,
        "nom" => "Malabars: set de 3 maces de jongleria",
        "categoria" => "Circ",
        "subcategoria" => "Malabars",
        "descripcio" => "Tres maces de jongleria Henrys de colors blau i groc. Bon estat general, petites ratlles a la pintura però perfectament equilibrades.",
        "estat" => "acceptable",
        "imatge" => "img/articles/maces-jongleria.jpg",
        "id_usuari" => 4,
        "data_publicacio" => "2025-03-28"
    ],

    [
        "id" => 5,
        "nom" => "Capes de màgic (adulte i nen)",
        "categoria" => "Magia",
        "subcategoria" => "Vestuari",
        "descripcio" => "Dues capes negres amb folre vermell, una de talla adulte (L) i una de nen (6-8 anys). Brodats daurats als vores. Rentades i en perfecte estat.",
        "estat" => "molt bo",
        "imatge" => "img/articles/capes-magic.jpg",
        "id_usuari" => 5,
        "data_publicacio" => "2025-01-15"
    ],

    [
        "id" => 6,
        "nom" => "Monocicle 20 polzades",
        "categoria" => "Circ",
        "subcategoria" => "Acrobàcia",
        "descripcio" => "Monocicle de 20 polzades, talla mitjana, adequat per a persones d'entre 1.55m i 1.75m. Inclou manual d'aprenentatge fotocopiat.",
        "estat" => "bo",
        "imatge" => "img/articles/monocicle.jpg",
        "id_usuari" => 6,
        "data_publicacio" => "2025-04-10"
    ],

    [
        "id" => 7,
        "nom" => "Foulards de seda per a màgia (lot de 12)",
        "categoria" => "Magia",
        "subcategoria" => "Props de màgia",
        "descripcio" => "Dotze mocadors de seda de colors variats (30x30cm). Clàssic en màgia de salón i infantil. Usats però nets i sense estrips.",
        "estat" => "bo",
        "imatge" => "img/articles/foulards-seda.jpg",
        "id_usuari" => 1,
        "data_publicacio" => "2025-03-15"
    ],

    [
        "id" => 8,
        "nom" => "Sabates de pallasso (talla 44-46 extra)",
        "categoria" => "Clown",
        "subcategoria" => "Vestuari",
        "descripcio" => "Sabates gegants de pallasso de colors vermell i groc, talla extra (44-46). Material de làtex i escuma. Ideals per a espectacles al carrer.",
        "estat" => "acceptable",
        "imatge" => "img/articles/sabates-pallasso.jpg",
        "id_usuari" => 3,
        "data_publicacio" => "2025-02-25"
    ],
    [
        "id" => 9,
        "nom" => "Pal del diable (Devil Stick) amb bastons de control",
        "categoria" => "Circ",
        "subcategoria" => "Malabars",
        "descripcio" => "Pal del diable de fibra de vidre amb dues baquetes de control. Colors negre i groc fluorescent. Inclou bossa de transport.",
        "estat" => "molt bo",
        "imatge" => "img/articles/devil-stick.jpg",
        "id_usuari" => 2,
        "data_publicacio" => "2025-04-05"
    ],

    [
        "id" => 10,
        "nom" => "Kit de globoflèxia (bombes i bomba d'aire)",
        "categoria" => "Clown",
        "subcategoria" => "Accessoris",
        "descripcio" => "Kit complet de globoflèxia: 200 globus de modelar de colors i una bomba d'aire manual. Perfecte per a animació infantil i espectacles de carrer.",
        "estat" => "nou",
        "imatge" => "img/articles/globoflexia.jpg",
        "id_usuari" => 8,
        "data_publicacio" => "2025-04-18"
    ],

    [
        "id" => 11,
        "nom" => "Batons de foc (parell)",
        "categoria" => "Circ",
        "subcategoria" => "Arts de foc",
        "descripcio" => "Parell de batons de foc amb metxes de cotó reforçat. Longitud 60cm. Per a ús professional. No aptes per a principiants sense supervisió.",
        "estat" => "bo",
        "imatge" => "img/articles/batons-foc.jpg",
        "id_usuari" => 7,
        "data_publicacio" => "2025-03-02"
    ],

    [
        "id" => 12,
        "nom" => "Cub de Rubik màgic (gimmick)",
        "categoria" => "Magia",
        "subcategoria" => "Props de màgia",
        "descripcio" => "Cub de Rubik preparat com a gimmick per a màgia de saló. Permet fer resoldre el cub en pocs segons de manera espectacular. Inclou instruccions.",
        "estat" => "bo",
        "imatge" => "img/articles/cub-rubik-magic.jpg",
        "id_usuari" => 5,
        "data_publicacio" => "2025-01-22"
    ],

    [
        "id" => 13,
        "nom" => "Pilotes de malabars (set de 6)",
        "categoria" => "Circ",
        "subcategoria" => "Malabars",
        "descripcio" => "Sis pilotes de malabars de 70mm omplertes de sorra, colors variats. Ideals per aprendre malabarisme des de zero. Molt bon agafament.",
        "estat" => "bo",
        "imatge" => "img/articles/pilotes-malabars.jpg",
        "id_usuari" => 4,
        "data_publicacio" => "2025-03-30"
    ],

    [
        "id" => 14,
        "nom" => "Vestit de pallasso complet",
        "categoria" => "Clown",
        "subcategoria" => "Vestuari",
        "descripcio" => "Vestit complet de pallasso: pantalons de polka dot, camisa de volants, tirants i barret cònic. Talla M/L. Rentat a mà i en perfecte estat.",
        "estat" => "molt bo",
        "imatge" => "img/articles/vestit-pallasso.jpg",
        "id_usuari" => 3,
        "data_publicacio" => "2025-02-10"
    ],

    [
        "id" => 15,
        "nom" => "Llibre: El arte del clown - Jacques Lecoq",
        "categoria" => "Clown",
        "subcategoria" => "Formació",
        "descripcio" => "Llibre de referència sobre tècnica clown de Jacques Lecoq. Edició en castellà. Tapes amb lleugeres marques però interior perfecte.",
        "estat" => "acceptable",
        "imatge" => "img/articles/llibre-lecoq.jpg",
        "id_usuari" => 6,
        "data_publicacio" => "2025-04-12"
    ]

];

$stmtProducte = $db->prepare("
INSERT INTO productes (
    id,
    nom,
    categoria,
    subcategoria,
    descripcio,
    imatge,
    id_usuari,
    data_publicacio
)
VALUES (?, ?, ?, ?, ?, ?, ?, ?)
");

foreach ($productes as $p) {

    $stmtProducte->execute(
        [
            $p["id"],
            $p["nom"],
            $p["categoria"],
            $p["subcategoria"],
            $p["descripcio"],
            $p["imatge"],
            $p["id_usuari"],
            $p["data_publicacio"]
        ]
    );
}

echo "Base de dades creada correctament.";
