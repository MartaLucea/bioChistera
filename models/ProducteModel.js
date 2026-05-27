export const getAll = (db) => db.prepare("SELECT * FROM productes").all();

export const getByCategoria = (db, tipus) =>
    db.prepare("SELECT * FROM productes WHERE categoria = ?").all(tipus);

export const getById = (db, id) => {
    const producte = db.prepare("SELECT * FROM productes WHERE id = ?").get(id);
    if (!producte) return null;

    const usuari = db.prepare("SELECT nom FROM usuaris WHERE id = ?").get(producte.id_usuari);
    return { ...producte, usuari: usuari?.nom ?? null };
};

export const crear = (db, dades) => {
    const { nom, categoria, descripcio, preu, id_usuari } = dades;
    const result = db.prepare(`
        INSERT INTO productes (nom, categoria, descripcio, id_usuari, donacio, preu, data_publicacio)
        VALUES (?, ?, ?, ?, ?, ?,?, DATE('now'))
    `).run(nom, categoria, descripcio, id_usuari, donacio, preu );
    return result.lastInsertRowid;
};

export const actualitzar = (db, id, camps) => {
    const claus = Object.keys(camps);
    const set = claus.map(k => `${k} = ?`).join(", ");
    const result = db.prepare(`UPDATE productes SET ${set} WHERE id = ?`)
        .run(...Object.values(camps), id);
    return result.changes;
};

export const eliminar = (db, id) =>
    db.prepare("DELETE FROM productes WHERE id = ?").run(id).changes;

export const getByUsuari = (db, id) => {
    return db
        .prepare("SELECT * FROM productes WHERE id_usuari = ?")
        .all(id);
};

export const getRecents = (db) =>{
    return db.prepare("SELECT * FROM productes ORDER BY data_publicacio DESC LIMIT 3").all();
}