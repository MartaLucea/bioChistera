<?php

class UsuariModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getByNom($nom) {
        $stmt = $this->db->prepare("SELECT * FROM usuaris WHERE nom = :nom");
        $stmt->bindValue(":nom", $nom, SQLITE3_TEXT);
        $result = $stmt->execute();
        return $result->fetchArray(SQLITE3_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM usuaris WHERE id = :id");
        $stmt->bindValue(":id", $id, SQLITE3_INTEGER);
        $result = $stmt->execute();
        return $result->fetchArray(SQLITE3_ASSOC);
    }

    public function getAll() {
        $result = $this->db->query("SELECT * FROM usuaris");
        
        $usuaris = [];
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $usuaris[] = $row;
        }
        return $usuaris;
    }

    public function crear($nom, $contrasenya, $email) {
        $stmt = $this->db->prepare(
            "INSERT INTO usuaris (nom, contrassenya, email, rol) 
             VALUES (:nom, :pass, :email, 'usuari')"
        );
        $stmt->bindValue(":nom", $nom, SQLITE3_TEXT);
        $stmt->bindValue(":pass", md5($contrasenya), SQLITE3_TEXT);
        $stmt->bindValue(":email", $email, SQLITE3_TEXT);
        $stmt->execute();
        return $this->db->lastInsertRowID();
    }

    public function eliminar($id) {
        $stmt = $this->db->prepare("DELETE FROM usuaris WHERE id = :id");
        $stmt->bindValue(":id", $id, SQLITE3_INTEGER);
        return $stmt->execute(); 
    }
}
?>