<?php
ob_start(); 
require_once __DIR__ . "/../config/dbOpenConn.php";
require_once __DIR__ . "/../models/UsuariModel.php";

ob_clean(); 
header("Content-Type: application/json");

$model = new UsuariModel($db);
$accio = $_GET["accio"] ?? "";
$id = $_GET["id"] ?? null;
$input = json_decode(file_get_contents("php://input"), true);

match($accio) {
    "login"      => login($model, $input),
    "register"   => register($model, $input),
    "llistarTots"=> llistarTots($model),      
    "detall"     => detallUsuari($model, $id), 
    "eliminar"   => eliminarUsuari($model, $id),
    default      => resposta(400, ["error" => "Acció desconeguda"])
};

function login($model, $input) {
    $nom = trim($input["usuari"] ?? "");
    $contrasenya = trim($input["contrasenya"] ?? "");
    if (!$nom || !$contrasenya) return resposta(400, ["error" => "Falten dades"]);

    $usuari = $model->getByNom($nom);
    if (!$usuari) return resposta(401, ["error" => "Usuari incorrecte"]);
    if ($usuari["contrassenya"] !== md5($contrasenya)) return resposta(401, ["error" => "Contrasenya incorrecta"]);

    ferToken($usuari);
}

function register($model, $input) {
    $nom = trim($input["usuari"] ?? "");
    $contrasenya = trim($input["contrasenya"] ?? "");
    $email = trim($input["correu"] ?? "");

    if (!$nom || !$contrasenya || !$email) return resposta(400, ["error" => "Falten dades"]);
    if ($model->getByNom($nom)) return resposta(409, ["error" => "Aquest nom d'usuari ja existeix"]);

    $id = $model->crear($nom, $contrasenya, $email);
    $usuari = ["id" => $id, "nom" => $nom, "rol" => "usuari"];
    ferToken($usuari);
}


function llistarTots($model) {
    $usuaris = $model->getAll();
    resposta(200, $usuaris);
}

function detallUsuari($model, $id) {
    if (!$id) return resposta(400, ["error" => "ID no proporcionat"]);
    
    $usuari = $model->getById($id);
    if (!$usuari) return resposta(404, ["error" => "Usuari no trobat"]);
    
    resposta(200, $usuari);
}

function eliminarUsuari($model, $id) {
    if (!$id) return resposta(400, ["error" => "ID no proporcionat"]);

    $exit = $model->eliminar($id);
    if ($exit) {
        resposta(200, ["missatge" => "Usuari eliminat correctament"]);
    } else {
        resposta(500, ["error" => "No s'ha pogut eliminar l'usuari"]);
    }
}

function ferToken($usuari) {
    $clau = "clauSuperSecreta123";
    $header  = base64_encode(json_encode(["alg" => "HS256", "typ" => "JWT"]));
    $payload = base64_encode(json_encode([
        "id"  => $usuari["id"],
        "nom" => $usuari["nom"],
        "rol" => $usuari["rol"],
        "exp" => time() + 3600
    ]));
    $signatura = base64_encode(hash_hmac("sha256", "$header.$payload", $clau, true));
    $token = "$header.$payload.$signatura";

    setcookie("token", $token, time() + 3600, "/");
    resposta(200, ["token" => $token]);
}

function resposta($codi, $data) {
    http_response_code($codi);
    echo json_encode($data);
    exit();
}