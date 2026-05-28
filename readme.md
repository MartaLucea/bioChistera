# Bio🎩Chistera

> *Del barret, un conill. De nosaltres, un canvi.*

Marketplace solidari de material de **màgia, circ i clown** de segona mà. Compra, ven, intercanvia i aprèn amb tutorials de la comunitat. Projecte vinculat als ODS 3, 10, 12 i 17 de l'ONU.

---

## Índex

- [Descripció](#descripció)
- [Estructura del projecte](#estructura-del-projecte)
- [Tecnologies](#tecnologies)
- [Instal·lació](#installació)
- [API REST (Node.js)](#api-rest-nodejs)
- [Back-end PHP](#back-end-php)
- [Base de dades](#base-de-dades)
- [Usuaris de prova](#usuaris-de-prova)
- [Pàgines de l'aplicació](#pàgines-de-laplicació)

---

## Descripció

BioChistera és una plataforma d'economia circular per a artistes escènics. Permet donar una segona vida a material escènic en desús (baralles, malabars, nassos de clown, maquillatge...) mitjançant la compravenda i donació entre usuaris de la comunitat. A més, qualsevol persona pot pujar tutorials de màgia, circ o clown per compartir coneixement de forma gratuïta.

El projecte forma part del cicle formatiu DAW i és de caràcter transversal entre els mòduls de **Desenvolupament web en entorn client** i **Desenvolupament web en entorn servidor**.

---

## Estructura del projecte

```
bioChistera/
├── index.js                  # Servidor Node.js + Express (API REST)
├── index.php                 # Portada principal
├── config/
│   ├── dbOpenConn.php        # Connexió SQLite per a PHP
│   └── dbCloseConn.php
├── controller/
│   ├── TutorialController.js # Controlador tutorials (Node)
│   ├── ProducteController.js # Controlador productes (Node)
│   ├── UsuariController.php  # Controlador usuaris + JWT (PHP)
│   └── odsController.php     # Controlador pàgines ODS (PHP)
├── models/
│   ├── TutorialModel.js      # Consultes SQL tutorials (Node)
│   ├── ProducteModel.js      # Consultes SQL productes (Node)
│   └── UsuariModel.php       # Consultes SQL usuaris (PHP)
├── views/
│   ├── layout/
│   │   ├── header.php        # Navbar + dark mode toggle
│   │   └── footer.html
│   ├── auth/
│   │   ├── login.php
│   │   ├── register.php
│   │   ├── logout.php
│   │   └── validar.php
│   ├── productes/
│   │   ├── index.php
│   │   ├── detall.php
│   │   ├── crear.php
│   │   └── modificar.php
│   ├── tutorials/
│   │   ├── index.php
│   │   ├── detall.php
│   │   ├── crear.php
│   │   └── modificar.php
│   ├── ods/
│   │   ├── index.php
│   │   └── detall.php
│   ├── user/
│   │   ├── paginaUsuari.php
│   │   └── admin/
│   │       ├── productes.php
│   │       ├── tutorials.php
│   │       └── usuaris.php
│   ├── usuaris/
│   │   └── detall.php
│   └── static/
│       ├── backMarket.php
│       ├── practiquesSostenibles.php
│       └── preguntesFrequens.php
├── database/
│   ├── bioChistera.db        # Base de dades SQLite
│   ├── dbInit.php            # Script d'inicialització + seed
│   └── db.json               # Dades inicials (referència)
└── public/
    ├── css/
    └── js/
        └── buscadorFaq.js
```

---

## Tecnologies

| Capa | Tecnologia |
|---|---|
| Front-end | HTML5, CSS3, JavaScript (ES2022) |
| API REST | Node.js 18+, Express.js, better-sqlite3 |
| Back-end | PHP 8+, SQLite3 |
| Autenticació | JWT manual (PHP) via cookie |
| Base de dades | SQLite (bioChistera.db) |

---

## Instal·lació

### Requisits previs

- PHP 8.0 o superior amb extensió `sqlite3` activada
- Node.js 18 o superior
- Un servidor web local amb suport PHP

### Pas 1 — Clonar el repositori

```bash
git clone https://github.com/el-teu-usuari/bioChistera.git
cd bioChistera
```

### Pas 2 — Inicialitzar la base de dades

Executa el script d'inicialització des d'un navegador o per línia de comandes:

```bash
php database/dbInit.php
```

Això crea les taules `usuaris`, `productes`, `tutorials` i `compres`, i les omple amb dades de prova.

### Pas 3 — Instal·lar dependències Node i arrencar l'API

```bash
npm install
node index.js
```

L'API queda escoltant a `http://localhost:3001`.

### Pas 4 — Servir el front-end PHP

Col·loca la carpeta del projecte dins el directori arrel del teu servidor web i accedeix a:

```
http://localhost/bioChistera/
```

---

## API REST (Node.js)

Base URL: `http://localhost:3001`

### Tutorials

| Mètode | Ruta | Descripció |
|---|---|---|
| GET | `/tutorials` | Retorna tots els tutorials |
| GET | `/tutorials/:id` | Retorna un tutorial per ID |
| GET | `/tutorials/categoria/:tipus` | Filtra tutorials per categoria |
| POST | `/tutorials` | Crea un tutorial nou |
| PUT | `/tutorials/:id` | Actualitza un tutorial existent |
| DELETE | `/tutorial/:id` | Elimina un tutorial |

**Exemple cos POST `/tutorials`:**
```json
{
  "titol": "La cascada de 3 pilotes",
  "categoria": "Circ",
  "descripcio": "Tutorial per a principiants",
  "durada_minuts": 15,
  "video_url": "https://youtube.com/embed/...",
  "id_usuari": 2
}
```

### Productes

| Mètode | Ruta | Descripció |
|---|---|---|
| GET | `/productes` | Retorna tots els productes disponibles (no comprats) |
| GET | `/productes/:id` | Retorna un producte per ID |
| GET | `/productes/categoria/:tipus` | Filtra productes per categoria |
| POST | `/productes` | Publica un producte nou |
| PUT | `/productes/:id` | Actualitza un producte existent |
| DELETE | `/producte/:id` | Elimina un producte |
| POST | `/comprar` | Registra la compra d'un producte |

**Exemple cos POST `/productes`:**
```json
{
  "nom": "Baralla Bicycle Rider Back",
  "categoria": "Magia",
  "descripcio": "Baralla quasi nova, 50 partides jugades",
  "preu": 5,
  "donacio": "no",
  "id_usuari": 1
}
```

**Exemple cos POST `/comprar`:**
```json
{
  "id_producte": 3,
  "id_usuari": 5
}
```

### Compostos

| Mètode | Ruta | Descripció |
|---|---|---|
| GET | `/usuari/:id` | Retorna tutorials, productes, compres i vendes d'un usuari |
| GET | `/recents` | Retorna els 3 tutorials i 3 productes més recents |

---

## Back-end PHP

Els controladors PHP gestionen l'autenticació i les pàgines estàtiques. S'accedeix via query string:

```
/controller/UsuariController.php?accio=login
/controller/UsuariController.php?accio=register
/controller/UsuariController.php?accio=llistarTots
/controller/UsuariController.php?accio=detall&id=1
/controller/UsuariController.php?accio=eliminar&id=1
```

L'autenticació retorna un **JWT** emmagatzemat en una cookie (`token`) amb durada d'1 hora. El payload inclou `id`, `nom` i `rol` de l'usuari.

---

## Base de dades

Esquema SQLite (`bioChistera.db`):

```sql
usuaris    (id, nom, contrassenya [md5], email, rol)
productes  (id, nom, categoria, descripcio, imatge, id_usuari, data_publicacio, donacio, preu, comprat)
tutorials  (id, titol, categoria, descripcio, durada_minuts, video_url, id_usuari, data_publicacio)
compres    (id, id_usuari, id_producte, data_compra)
```

---

## Usuaris de prova

Tots els usuaris de prova tenen la contrasenya `1234`.

| Usuari | Rol |
|---|---|
| Marta | admin |
| CircMestre | usuari |
| PomPomClown | usuari |
| JongleurFou | usuari |
| MagicStellar | usuari |
| RodaLliure | usuari |
| FlameCirc | usuari |
| BullonArt | usuari |

---

## Pàgines de l'aplicació

| Pàgina | Ruta | Descripció |
|---|---|---|
| Portada | `/index.php` | Presentació, recents i ODS |
| Productes | `/views/productes/index.php` | Llistat del marketplace |
| Detall producte | `/views/productes/detall.php?id=X` | Vista i compra |
| Crear producte | `/views/productes/crear.php` | Formulari publicació |
| Modificar producte | `/views/productes/modificar.php?id=X` | Edició |
| Tutorials | `/views/tutorials/index.php` | Llistat de tutorials |
| Detall tutorial | `/views/tutorials/detall.php?id=X` | Vista tutorial |
| Crear tutorial | `/views/tutorials/crear.php` | Formulari pujada |
| ODS | `/views/ods/index.php` | Objectius de Desenvolupament Sostenible |
| Detall ODS | `/views/ods/detall.php?ods=3` | ODS 3, 10, 12 o 17 |
| Back Market | `/views/static/backMarket.php` | Anàlisi empresa tecnològica sostenible |
| Pràctiques sostenibles | `/views/static/practiquesSostenibles.php` | Com s'ha desenvolupat de forma sostenible |
| FAQ | `/views/static/preguntesFrequens.php` | Preguntes freqüents |
| Login | `/views/auth/login.php` | Inici de sessió |
| Registre | `/views/auth/register.php` | Alta d'usuari |
| Perfil d'usuari | `/views/user/paginaUsuari.php` | Productes, tutorials, compres i vendes |
| Admin productes | `/views/user/admin/productes.php` | Gestió admin |
| Admin tutorials | `/views/user/admin/tutorials.php` | Gestió admin |
| Admin usuaris | `/views/user/admin/usuaris.php` | Gestió admin |