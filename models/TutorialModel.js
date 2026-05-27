export const getById = (db, id) => {
    const tutorial = db.prepare("SELECT * FROM tutorials WHERE id = ?").get(id);
    if (!tutorial) return null;

    const usuari = db.prepare("SELECT nom FROM usuaris WHERE id = ?").get(tutorial.id_usuari);
    return { ...tutorial, usuari: usuari?.nom ?? null };
};

export const getAll = (db) => db.prepare("SELECT * FROM tutorials").all();

export const getByCategoria = (db, tipus) =>
    db.prepare("SELECT * FROM tutorials WHERE categoria = ?").all(tipus);

export const crear = (db, dades) => {
    const { titol, categoria, durada_minuts, video_url, descripcio, id_usuari } = dades;
    const result = db.prepare(`
        INSERT INTO tutorials (titol, categoria, durada_minuts, video_url, descripcio, id_usuari, data_publicacio, aprovada)
        VALUES (?, ?, ?, ?, ?, ?, ?, DATE('now'), 0)
    `).run(titol, categoria, durada_minuts, video_url, descripcio, id_usuari);
    return result.lastInsertRowid;
};

export const actualitzar = (db, id, camps) => {
    const claus = Object.keys(camps);
    const set = claus.map(k => `${k} = ?`).join(", ");
    const result = db.prepare(`UPDATE tutorials SET ${set} WHERE id = ?`)
        .run(...Object.values(camps), id);
    return result.changes;
};

export const eliminar = (db, id) =>
    db.prepare("DELETE FROM tutorials WHERE id = ?").run(id).changes;

export const getRecents = (db) =>{
    return db.prepare("SELECT * FROM tutorials ORDER BY data_publicacio DESC LIMIT 3").all();
}

export const getByUsuari = (db, id) => {
    return db
        .prepare("SELECT * FROM tutorials WHERE id_usuari = ?")
        .all(id);
};