import * as TutorialModel from "../models/TutorialModel.js";

export const getAll = (db) => (req, res) => {
    const tutorials = TutorialModel.getAll(db);
    res.json(tutorials);
};

export const getByCategoria = (db) => (req, res) => {
    const tutorials = TutorialModel.getByCategoria(db, req.params.tipus);
    res.json(tutorials);
};

export const getById = (db) => (req, res) => {
    const tutorial = TutorialModel.getById(db, Number(req.params.id));
    if (!tutorial) return res.status(404).json({ error: "Tutorial no trobat" });
    res.json(tutorial);
};

export const crear = (db) => (req, res) => {
    const { titol, categoria, id_usuari } = req.body;
    if (!titol || !categoria || !id_usuari)
        return res.status(400).json({ error: "Falten camps obligatoris" });

    const id = TutorialModel.crear(db, req.body);
    res.status(201).json({ id, message: "Tutorial creat" });
};

export const actualitzar = (db) => (req, res) => {
    const camps = req.body;
    if (!Object.keys(camps).length)
        return res.status(400).json({ error: "No hi ha res a actualitzar" });

    const changes = TutorialModel.actualitzar(db, Number(req.params.id), camps);
    if (!changes) return res.status(404).json({ error: "Tutorial no trobat" });
    res.json({ message: "Tutorial actualitzat" });
};

export const eliminar = (db) => (req, res) => {
    const changes = TutorialModel.eliminar(db, Number(req.params.id));
    if (!changes) return res.status(404).json({ error: "Tutorial no trobat" });
    res.json({ message: "Tutorial borrat" });
};
export const getRecents = (db) => {
    return TutorialModel.getRecents(db);
};

export const obtenirTutorialsUsuari = (db, id) => {
    return TutorialModel.getByUsuari(db, id);
};
