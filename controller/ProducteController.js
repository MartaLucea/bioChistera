import * as ProducteModel from "../models/ProducteModel.js";

export const getAll = (db) => (req, res) => {
    const productes = ProducteModel.getAll(db);
    res.json(productes);
};

export const getByCategoria = (db) => (req, res) => {
    const productes = ProducteModel.getByCategoria(db, req.params.tipus);
    res.json(productes);
};

export const getById = (db) => (req, res) => {
    const producte = ProducteModel.getById(db, Number(req.params.id));
    if (!producte) return res.status(404).json({ error: "Producte no trobat" });
    res.json(producte);
};

export const crear = (db) => (req, res) => {
    const { nom, categoria, id_usuari } = req.body;
    if (!nom || !categoria || !id_usuari)
        return res.status(400).json({ error: "Falten camps obligatoris" });

    const id = ProducteModel.crear(db, req.body);
    res.status(201).json({ id, message: "Producte creat" });
};

export const actualitzar = (db) => (req, res) => {
    const camps = req.body;
    if (!Object.keys(camps).length)
        return res.status(400).json({ error: "No hi ha res a actualitzar" });

    const changes = ProducteModel.actualitzar(db, Number(req.params.id), camps);
    if (!changes) return res.status(404).json({ error: "Producte no trobat" });
    res.json({ message: "Producte actualitzat" });
};

export const eliminar = (db) => (req, res) => {
    const changes = ProducteModel.eliminar(db, Number(req.params.id));
    if (!changes) return res.status(404).json({ error: "Producte no trobat" });
    res.json({ message: "Producte borrat" });
};

export const getRecents = (db) => {
    return ProducteModel.getRecents(db);
};

export const obtenirProductesUsuari = (db, id) => {
    return ProducteModel.getByUsuari(db, id);
};

