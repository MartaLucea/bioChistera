<?php
require_once __DIR__ . "/../include/dbOpenConn.php";

header("Content-Type: application/json");

$input = json_decode(file_get_contents("php://input"), true);
$nom = $input["usuari"] ?? "";
$contrasenya = $input["contrasenya"] ?? "";
$email = $input["correu"] ?? "";

if ($nom && $contrasenya) {
    $stmt = $db->prepare("INSERT INTO usuaris VALUES nom =:nom, contrassenya = :pass, email=:email");
    $stmt->bindValue(":nom", $nom, SQLITE3_TEXT);
    $stmt->bindValue(":pass", $contrasenya, SQLITE3_TEXT);
    $stmt->bindValue(":email", $email, SQLITE3_TEXT);
    $result = $stmt->execute();
    $usuari = $result->fetchArray(SQLITE3_ASSOC);

    if ($usuari) {
        if ($usuari["contrassenya"] === md5($contrasenya)){
        $header = base64_encode(json_encode(["alg" => "HS256", "typ" => "JWT"]));
        $payload = base64_encode(json_encode([
            "id" => $usuari["id"],
            "nom" => $usuari["nom"],
            "rol" => $usuari["rol"],
            "exp" => time() + 3600
        ]));
        $clau_secreta = "clauSuperSecreta123";
        $signatura = base64_encode(hash_hmac("sha256", "$header.$payload", $clau_secreta, true));

        $token = "$header.$payload.$signatura";
        setcookie("token", $token, time() + 3600, "/");
        echo json_encode(["token" => $token]);
        }else{
            echo json_encode(["error" => "Contrassenya incorrecta"]);
        }
    } else {
        http_response_code(401);
        echo json_encode(["error" => "Usuari incorrecte"]);
    }
} else {
    http_response_code(400);
    echo json_encode(["error" => "Falten dades"]);
}
