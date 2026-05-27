<?php

$db = new PDO('sqlite:bioChistera.db');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$db->exec("DROP TABLE IF EXISTS tutorials");
$db->exec("DROP TABLE IF EXISTS usuaris");
$db->exec("DROP TABLE IF EXISTS productes");
$db->exec("DROP TABLE IF EXISTS compres");
$db->exec("
CREATE TABLE IF NOT EXISTS usuaris (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom TEXT NOT NULL UNIQUE,
    contrassenya TEXT NOT NULL,
    email TEXT NOT NULL UNIQUE,
    rol TEXT DEFAULT 'usuari'
);
");

$db->exec("
CREATE TABLE IF NOT EXISTS productes (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom TEXT NOT NULL,
    categoria TEXT NOT NULL,
    descripcio TEXT,
    imatge TEXT,
    id_usuari INTEGER NOT NULL,
    data_publicacio TEXT DEFAULT CURRENT_TIMESTAMP,
    donacio TEXT DEFAULT 'si',
    preu REAL DEFAULT 0,
    comprat INTEGER DEFAULT 0,

    FOREIGN KEY (id_usuari) REFERENCES usuaris(id)
);
");

$db->exec("
CREATE TABLE IF NOT EXISTS tutorials (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    titol TEXT NOT NULL,
    categoria TEXT NOT NULL,
    descripcio TEXT,
    durada_minuts INTEGER,
    video_url TEXT,
    id_usuari INTEGER NOT NULL,
    data_publicacio TEXT DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (id_usuari) REFERENCES usuaris(id)
);
");

$db->exec("
CREATE TABLE IF NOT EXISTS compres (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    id_usuari INTEGER NOT NULL,
    id_producte INTEGER NOT NULL,
    data_compra TEXT DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (id_usuari) REFERENCES usuaris(id),
    FOREIGN KEY (id_producte) REFERENCES productes(id)
);
");


$id_usuaris = [
    ["Marta", "1234", "marta@gmail.com", "admin"],
    ["CircMestre", "1234", "circ@gmail.com", "usuari"],
    ["PomPomClown", "1234", "pom@gmail.com", "usuari"],
    ["JongleurFou", "1234", "joung@gmail.com", "usuari"],
    ["MagicStellar", "1234", "maigc@gmail.com", "usuari"],
    ["RodaLliure", "1234", "roda@gmail.com", "usuari"],
    ["FlameCirc", "1234", "flame@gmail.com", "usuari"],
    ["BullonArt", "1234", "bullon@gmail.com", "usuari"]

];


$stmtid_Usuari = $db->prepare("
INSERT INTO usuaris (
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
        "descripcio" => "Aprèn la tècnica bàsica del forçat de carta, el fonament de molts trucs de cartes clàssics. Explicació pas a pas amb càmera lenta.",
        "durada_minuts" => 12,
        "video_url" => "https://www.youtube.com/embed/dQw4w9WgXcQ",
        "id_usuari" => 1,
        "data_publicacio" => "2025-02-14"
    ],

    [
        "titol" => "Malabars amb 3 pilotes: cascada bàsica",
        "categoria" => "Circ",
        "descripcio" => "Tutorial complet per aprendre la cascada de 3 pilotes des de zero. Inclou exercicis previs amb 1 i 2 pilotes per consolidar la coordinació.",
        "durada_minuts" => 18,
        "video_url" => "https://www.youtube.com/embed/dQw4w9WgXcQ",
        "id_usuari" => 4,
        "data_publicacio" => "2025-01-30"
    ],

    [
        "titol" => "El nas vermell: com construir el teu personatge clown",
        "categoria" => "Clown",
        "descripcio" => "Sessió teòrico-pràctica sobre com trobar el teu propi personatge clown. Treballa la mirada, la ridiculesa i la connexió amb el públic.",
        "durada_minuts" => 25,
        "video_url" => "https://www.youtube.com/embed/dQw4w9WgXcQ",
        "id_usuari" => 3,
        "data_publicacio" => "2025-03-05"
    ],

    [
        "titol" => "Trucs amb monedes: la desaparició bàsica",
        "categoria" => "Magia",
        "descripcio" => "Aprèn a fer desaparèixer una moneda amb tres tècniques de palming diferents. Tutorial amb càmera lenta i vista des de l'audiència.",
        "durada_minuts" => 15,
        "video_url" => "https://www.youtube.com/embed/dQw4w9WgXcQ",
        "id_usuari" => 5,
        "data_publicacio" => "2025-02-28"
    ],

    [
        "titol" => "Devil Stick: primeres figures i control bàsic",
        "categoria" => "Circ",
        "descripcio" => "Com agafar i controlar el devil stick per primera vegada. Aprèn el moviment bàsic de tick-tack i les primeres figures de control.",
        "durada_minuts" => 20,
        "video_url" => "https://www.youtube.com/embed/dQw4w9WgXcQ",
        "id_usuari" => 2,
        "data_publicacio" => "2025-03-18"
    ],

    [
        "titol" => "Globoflèxia: el gos bàsic pas a pas",
        "categoria" => "Clown",
        "descripcio" => "Crea el teu primer gos de globus en menys de 5 minuts. Tutorial pensat per a animadors infantils i principiants absoluts en globoflèxia.",
        "durada_minuts" => 8,
        "video_url" => "https://www.youtube.com/embed/dQw4w9WgXcQ",
        "id_usuari" => 8,
        "data_publicacio" => "2025-04-02"
    ],

    [
        "titol" => "Cartomagia intermèdia: el doble alçament",
        "categoria" => "Magia",
        "descripcio" => "Domina el doble alçament, una de les tècniques més versàtils de la cartomagia. Inclou tres variants i exercicis de suavitat per fer-ho invisible.",
        "durada_minuts" => 22,
        "video_url" => "https://www.youtube.com/embed/dQw4w9WgXcQ",
        "id_usuari" => 1,
        "data_publicacio" => "2025-03-22"
    ],

    [
        "titol" => "Malabars amb maces: de pilotes a maces",
        "categoria" => "Circ",
        "descripcio" => "Si ja domines 3 pilotes, aquest tutorial t'ensenya a fer la transició a les maces. Diferències de timing, agafament i ritme explicats en detall.",
        "durada_minuts" => 28,
        "video_url" => "https://www.youtube.com/embed/dQw4w9WgXcQ",
        "id_usuari" => 4,
        "data_publicacio" => "2025-04-08"
    ],

    [
        "titol" => "Clown físic: la caiguda còmica",
        "categoria" => "Clown",
        "descripcio" => "Tècnica de la caiguda còmica segura i efectiva. Aprèn a caure sense fer-te mal i amb màxim impacte dramàtic. Exercicis de calentament inclosos.",
        "durada_minuts" => 30,
        "video_url" => "https://www.youtube.com/embed/dQw4w9WgXcQ",
        "id_usuari" => 3,
        "data_publicacio" => "2025-03-10"
    ],

    [
        "titol" => "Anelles xineses: les tres anelles entrellaçades",
        "categoria" => "Magia",
        "descripcio" => "Aprèn la rutina clàssica de les tres anelles xineses entrellaçades. Tutorial amb angles múltiples i explicació detallada dels moments clau.",
        "durada_minuts" => 35,
        "video_url" => "https://www.youtube.com/embed/dQw4w9WgXcQ",
        "id_usuari" => 2,
        "data_publicacio" => "2025-02-05"
    ],

    [
        "titol" => "Monocicle: primers passos amb suport",
        "categoria" => "Circ",
        "descripcio" => "Mètode progressiu per aprendre a anar en monocicle utilitzant una paret o suport. Inclou consells de postura, pedaleig i on mirar.",
        "durada_minuts" => 16,
        "video_url" => "https://www.youtube.com/embed/dQw4w9WgXcQ",
        "id_usuari" => 6,
        "data_publicacio" => "2025-04-15"
    ],

    [
        "titol" => "Màgia amb cordes: el nus que desapareix",
        "categoria" => "Magia",
        "descripcio" => "Tres trucs clàssics amb cordes: el nus fantasma, la corda elàstica i la corda restaurada. Explicació amb i sense guants per veure les mans.",
        "durada_minuts" => 19,
        "video_url" => "https://www.youtube.com/embed/dQw4w9WgXcQ",
        "id_usuari" => 5,
        "data_publicacio" => "2025-01-18"
    ],

    [
        "titol" => "Globoflèxia avançada: espasa i flor",
        "categoria" => "Clown",
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
        "descripcio" => "Taller avançat sobre la tècnica del fracàs com a motor còmic. Com convertir els errors en gold, connectar amb el públic i sostenir els silencis.",
        "durada_minuts" => 45,
        "video_url" => "https://www.youtube.com/embed/dQw4w9WgXcQ",
        "id_usuari" => 3,
        "data_publicacio" => "2025-03-25"
    ],

    [
        "titol" => "Batons de foc: seguretat i primers moviments",
        "categoria" => "Circ",
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
    descripcio,
    durada_minuts,
    video_url,
    id_usuari,
    data_publicacio
)
VALUES (?, ?, ?, ?, ?, ?, ?)
");


foreach ($tutorials as $t) {

    $stmtTutorial->execute([
        $t["titol"],
        $t["categoria"],
        $t["descripcio"],
        $t["durada_minuts"],
        $t["video_url"],
        $t["id_usuari"],
        $t["data_publicacio"]
    ]);
}
$productes = [

    [
        "nom" => "Baralles de cartes Bicycle (lot de 3)",
        "categoria" => "Magia",
        "descripcio" => "Tres baralles de cartes Bicycle en bon estat, ideals per aprendre cartomagia bàsica i intermèdia. Lleugeres marques d'ús però totalment funcionals.",
        "imatge" => "img/articles/cartes-bicycle.jpg",
        "id_usuari" => 1,
        "data_publicacio" => "2025-03-12",
        "donacio" => "no",
        "preu" => 13.3
    ],

    [
        "nom" => "Anelles de metall entrellaçades (set de 8)",
        "categoria" => "Magia",
        "descripcio" => "Set de 8 anelles de metall cromades de 30cm de diàmetre. Perfectes per a números d'anelles xineses.",
        "imatge" => "img/articles/anelles-metall.jpg",
        "id_usuari" => 2,
        "data_publicacio" => "2025-04-01",
        "donacio" => "no",
        "preu" => 28.0
    ],

    [
        "nom" => "Nas de pallasso vermell (lot de 5)",
        "categoria" => "Clown",
        "descripcio" => "Cinc nassos de pallasso de escuma vermella, ideals per tallers i espectacles.",
        "imatge" => "img/articles/nas-pallasso.jpg",
        "id_usuari" => 3,
        "data_publicacio" => "2025-02-20",
        "donacio" => "si",
        "preu" => 0
    ],

    [
        "nom" => "Malabars: set de 3 maces de jongleria",
        "categoria" => "Circ",
        "descripcio" => "Tres maces de jongleria en bon estat, equilibrades i resistents.",
        "imatge" => "img/articles/maces-jongleria.jpg",
        "id_usuari" => 4,
        "data_publicacio" => "2025-03-28",
        "donacio" => "si",
        "preu" => 0
    ],

    [
        "nom" => "Capes de màgic (adulte i nen)",
        "categoria" => "Magia",
        "descripcio" => "Dues capes negres amb folre vermell en bon estat.",
        "imatge" => "img/articles/capes-magic.jpg",
        "id_usuari" => 5,
        "data_publicacio" => "2025-01-15",
        "donacio" => "no",
        "preu" => 22.5
    ],

    [
        "nom" => "Monocicle 20 polzades",
        "categoria" => "Circ",
        "descripcio" => "Monocicle ideal per iniciació i nivell mitjà.",
        "imatge" => "img/articles/monocicle.jpg",
        "id_usuari" => 6,
        "data_publicacio" => "2025-04-10",
        "donacio" => "no",
        "preu" => 45.0
    ],

    [
        "nom" => "Foulards de seda per a màgia (lot de 12)",
        "categoria" => "Magia",
        "descripcio" => "Mocadors de seda de colors per trucs de màgia.",
        "imatge" => "img/articles/foulards-seda.jpg",
        "id_usuari" => 1,
        "data_publicacio" => "2025-03-15",
        "donacio" => "si",
        "preu" => 0
    ],

    [
        "nom" => "Sabates de pallasso (talla 44-46 extra)",
        "categoria" => "Clown",
        "descripcio" => "Sabates grans de pallasso en bon estat.",
        "imatge" => "img/articles/sabates-pallasso.jpg",
        "id_usuari" => 3,
        "data_publicacio" => "2025-02-25",
        "donacio" => "si",
        "preu" => 0
    ],

    [
        "nom" => "Pal del diable (Devil Stick) amb bastons de control",
        "categoria" => "Circ",
        "descripcio" => "Devil stick de fibra amb bastons de control inclosos.",
        "imatge" => "img/articles/devil-stick.jpg",
        "id_usuari" => 2,
        "data_publicacio" => "2025-04-05",
        "donacio" => "no",
        "preu" => 19.9
    ],

    [
        "nom" => "Kit de globoflèxia (bombes i bomba d'aire)",
        "categoria" => "Clown",
        "descripcio" => "Kit complet de globoflèxia amb globus i bomba d’aire.",
        "imatge" => "img/articles/globoflexia.jpg",
        "id_usuari" => 8,
        "data_publicacio" => "2025-04-18",
        "donacio" => "si",
        "preu" => 0
    ],

    [
        "nom" => "Batons de foc (parell)",
        "categoria" => "Circ",
        "descripcio" => "Batons de foc professionals per ús avançat.",
        "imatge" => "img/articles/batons-foc.jpg",
        "id_usuari" => 7,
        "data_publicacio" => "2025-03-02",
        "donacio" => "no",
        "preu" => 35.0
    ],

    [
        "nom" => "Cub de Rubik màgic (gimmick)",
        "categoria" => "Magia",
        "descripcio" => "Cub trucat per efectes de màgia de saló.",
        "imatge" => "img/articles/cub-rubik-magic.jpg",
        "id_usuari" => 5,
        "data_publicacio" => "2025-01-22",
        "donacio" => "no",
        "preu" => 9.5
    ],

    [
        "nom" => "Pilotes de malabars (set de 6)",
        "categoria" => "Circ",
        "descripcio" => "Set de pilotes per iniciació al malabarisme.",
        "imatge" => "img/articles/pilotes-malabars.jpg",
        "id_usuari" => 4,
        "data_publicacio" => "2025-03-30",
        "donacio" => "si",
        "preu" => 0
    ],

    [
        "nom" => "Vestit de pallasso complet",
        "categoria" => "Clown",
        "descripcio" => "Vestit complet de pallasso en bon estat.",
        "imatge" => "img/articles/vestit-pallasso.jpg",
        "id_usuari" => 3,
        "data_publicacio" => "2025-02-10",
        "donacio" => "no",
        "preu" => 25.0
    ],

    [
        "nom" => "Llibre: El arte del clown - Jacques Lecoq",
        "categoria" => "Clown",
        "descripcio" => "Llibre de referència sobre tècnica clown.",
        "imatge" => "img/articles/llibre-lecoq.jpg",
        "id_usuari" => 6,
        "data_publicacio" => "2025-04-12",
        "donacio" => "no",
        "preu" => 18.0
    ]
];

$stmtProducte = $db->prepare("
INSERT INTO productes (
    nom,
    categoria,
    descripcio,
    imatge,
    id_usuari,
    data_publicacio,
    donacio,
    preu
)
VALUES (?, ?, ?, ?, ?, ?, ?, ?)
");

foreach ($productes as $p) {

    $stmtProducte->execute(
        [
            $p["nom"],
            $p["categoria"],
            $p["descripcio"],
            $p["imatge"],
            $p["id_usuari"],
            $p["data_publicacio"],
            $p["donacio"],
            $p["preu"]
        ]
    );
}

echo "Base de dades creada correctament.";
