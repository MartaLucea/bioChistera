import express from "express";
import fs from "fs"; //treballar amb arxius
import cors from "cors";
import Database from "better-sqlite3";
import path from "path";

const dbPath = path.resolve("database/bioChistera.db");
const db = new Database(dbPath);

//Creo l'objecte de l'aplicació
const app=express();
app.use(express.json())
app.use(cors());

const readData=()=>{
    try{
        const data=fs.readFileSync("./database/db.json");
        //console.log(data);
        //console.log(JSON.parse(data));
        return JSON.parse(data)

    }catch(error){
        console.log(error);
    }
};

/*
//Funció per escriure informació
const writeData=(data)=>{
    try{
        fs.writeFileSync("./databse/db.json",JSON.stringify(data));

    }catch(error){
        console.log(error);
    }
}
    */


app.get("/tutorials",(req,res)=>{
    const tutorials = db.prepare("SELECT * FROM tutorials").all();
    res.json(tutorials);
})

app.get("/tutorials/categoria/:tipus", (req, res) => {
    const tipus = req.params.tipus;

    const tutorials = db
        .prepare("SELECT * FROM tutorials WHERE categoria = ?")
        .all(tipus);

    res.json(tutorials);
});

app.get("/tutorials/:id", (req, res) => {
    const id = parseInt(req.params.id);

    const tutorial = db
        .prepare("SELECT * FROM tutorials WHERE id = ?")
        .get(id);

    if (!tutorial) {
        return res.status(404).json({ error: "Tutorial no trobat" });
    }

    const usuari = db
        .prepare("SELECT nom FROM usuaris WHERE id = ?")
        .get(tutorial.id_usuari)
    
    res.json({
        ...tutorial,
        usuari: usuari ? usuari.nom : null
    });
});

app.get("/productes",(req,res)=>{
    const productes = db.prepare("SELECT * FROM productes").all();
    res.json(productes);
})

app.get("/productes/categoria/:tipus", (req, res) => {
    const tipus = req.params.tipus;

    const productes = db
        .prepare("SELECT * FROM productes WHERE categoria = ?")
        .all(tipus);

    res.json(productes);
});

app.get("/productes/:id", (req, res) => {
    const id = parseInt(req.params.id);

    const producte = db
        .prepare("SELECT * FROM productes WHERE id = ?")
        .get(id);

    if (!producte) {
        return res.status(404)  .json({ error: "Producte no trobat" });
    }

    const usuari = db
        .prepare("SELECT nom FROM usuaris WHERE id = ?")
        .get(producte.id_usuari)
    
    res.json({
        ...producte,
        usuari: usuari ? usuari.nom : null
    });
});

app.get("/usuari/:id", (req, res) => {
    const id = req.params.id;

    const tutorials = db
        .prepare("SELECT * FROM tutorials WHERE id_usuari = ?")
        .all(id);

    const productes = db
    .prepare("SELECT * FROM productes WHERE id_usuari = ?")
    .all(id);

    res.json({
        tutorials,
        productes
    });
});

app.get("/recents", (req, res) => {
    const tutorials = db
        .prepare("SELECT * FROM tutorials ORDER BY data_publicacio DESC LIMIT 4")
        .all();

    const productes = db
    .prepare("SELECT * FROM productes ORDER BY data_publicacio DESC  LIMIT 4")
    .all();

    res.json({
        tutorials,
        productes
    });
});


/*
//Creem un endpoint del tipus post per afegir un llibre
app.post("/books",(req,res)=>{
    const data=readData();
    const body=req.body;
    //todo lo que viene en ...body se agrega al nuevo libro
    const newBook={
        id:data.books.length+1,
        ...body,
    };
    data.books.push(newBook);
    writeData(data);
    res.json(newBook);
});

//Creem un endpoint per modificar un llibre
app.put("/books/:id", (req, res) => {
    const data = readData();
    const body = req.body;
    const id = parseInt(req.params.id);
    const bookIndex = data.books.findIndex((book) => book.id === id);
    data.books[bookIndex] = {
      ...data.books[bookIndex],
      ...body,
    };
    writeData(data);
    res.json({ message: "Book updated successfully" });
  });

//Creem un endpoint per eliminar un llibre
app.delete("/books/:id", (req, res) => {
    const data = readData();
    const id = parseInt(req.params.id);
    const bookIndex = data.books.findIndex((book) => book.id === id);
    //splice esborra a partir de bookIndex, el número de elements 
    // que li indiqui al segon argument, en aquest cas 1
    data.books.splice(bookIndex, 1);
    writeData(data);
    res.json({ message: "Book deleted successfully" });
  });
*/

//Funció per escoltar
app.listen(3001,()=>{
    console.log("Server listing on port 3001");
});