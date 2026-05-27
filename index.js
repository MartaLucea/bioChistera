import express from "express";
import cors from "cors";
import Database from "better-sqlite3";
import path from "path";

import * as TutorialController from "./controller/TutorialController.js";
import * as ProducteController from "./controller/ProducteController.js";

const db = new Database(path.resolve("database/bioChistera.db"));
const app = express();
app.use(express.json());
app.use(cors());


app.get("/tutorials", TutorialController.getAll(db));
app.get("/tutorials/categoria/:tipus", TutorialController.getByCategoria(db));
app.get("/tutorials/:id", TutorialController.getById(db));
app.post("/tutorials", TutorialController.crear(db));
app.put("/tutorials/:id", TutorialController.actualitzar(db));
app.delete("/tutorial/:id", TutorialController.eliminar(db));

app.get("/productes", ProducteController.getAll(db));
app.get("/productes/categoria/:tipus", ProducteController.getByCategoria(db));
app.get("/productes/:id", ProducteController.getById(db));
app.post("/productes", ProducteController.crear(db));
app.put("/productes/:id", ProducteController.actualitzar(db));
app.delete("/producte/:id", ProducteController.eliminar(db));


app.get("/usuari/:id", (req, res) => {

    const id = Number(req.params.id);

    const tutorials =
        TutorialController.obtenirTutorialsUsuari(db, id);

    const productes =
        ProducteController.obtenirProductesUsuari(db, id);

    res.json({
        tutorials,
        productes
    });
});


app.get("/recents", (req, res) => {

    const tutorials =
        TutorialController.getRecents(db);

    const productes =
        ProducteController.getRecents(db);

    res.json({
        tutorials,
        productes
    });
});

app.listen(3001, () => {
    console.log("Server listing on port 3001");
});