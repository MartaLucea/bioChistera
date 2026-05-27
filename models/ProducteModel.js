export const getAll = (db) => db.prepare("SELECT * FROM productes WHERE comprat = 0").all();

export const getByCategoria = (db, tipus) =>
    db.prepare("SELECT * FROM productes WHERE categoria = ? AND comprat = 0").all(tipus);

export const getById = (db, id) => {
    const producte = db.prepare("SELECT * FROM productes WHERE id = ?").get(id);
    if (!producte) return null;

    const usuari = db.prepare("SELECT nom FROM usuaris WHERE id = ?").get(producte.id_usuari);
    return { ...producte, usuari: usuari?.nom ?? null };
};

export const crear = (db, dades) => {
    const { nom, categoria, descripcio, preu, id_usuari, donacio } = dades;
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
        .prepare("SELECT * FROM productes WHERE id_usuari = ? AND comprat = 0")
        .all(id);
};

export const getComprats = (db, id) => {
    return db
        .prepare(`SELECT * FROM productes p JOIN compres c ON p.id = c.id_producte 
            WHERE c.id_usuari = ?`)
        .all(id);
};

export const getVenuts = (db, id) => {
    return db
        .prepare("SELECT * FROM productes WHERE id_usuari = ? AND comprat = 1")
        .all(id);
};


export const getRecents = (db) =>{
    return db.prepare("SELECT * FROM productes WHERE comprat = 0 ORDER BY data_publicacio DESC LIMIT 3").all();
}

export const comprar = (db, dades) => {

    const { id_producte, id_usuari } = dades;
    const producte = db.prepare(` SELECT * FROM productes WHERE id = ?`).get(id_producte);
    if (!producte) {
        throw new Error("El producte no existeix");
    }
    if (producte.id_usuari == id_usuari) {
        throw new Error("No pots comprar el teu propi producte");
    }
    if (producte.comprat === 1) {
        throw new Error("Aquest producte ja està comprat");
    }
    const result = db.prepare(`INSERT INTO compres (id_producte, id_usuari, data_compra)
        VALUES (?, ?, DATE('now'))`).run(id_producte, id_usuari);

    db.prepare(`UPDATE productes SET comprat = 1 WHERE id = ?`).run(id_producte);

    return result.lastInsertRowid;
};