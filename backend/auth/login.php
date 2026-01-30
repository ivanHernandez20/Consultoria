<?php
    require_once("../config/supabase.php");
    require_once("../utils/response.php");

    if($_SERVER["REQUEST_METHOD"] !== "POST"){
        jsonResponse(["error" => "Metodo no permitido"], 405);
    }

    $data = json_decode(file_get_contents("php://input"), true);

    $correo = $data["correo"] ?? "";
    $password = $data["password"] ?? ""

    if(!$correo || !$password){
        jsonResponse(["error" => "Datos Incompletos"], 400);
    }

    $sql = "SELECT * FROM tb_logeo WHERE correo = :correo AND password = :password AND estatus = 1";

    $stmt = $pdo->prepare($sql);
    $stmt -> execute([":correo" => $correo, ":password" => $password]);

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    if(!$usuario){
        jsonResponse(["error" => "Credenciales invalidas"], 401);
    }

    $nombreCompleto = trim($usuario["nombre"] . " " . $usuario["apaterno"] . " " . $usuario["amaterno"]);

    jsonResponse(["ok" => true, "usuario" => [
        "id" => $usuario["id_log"],
        "nombre" => $nombreCompleto,
        "tipo" => $usuario["tipo_usuario"]
    ]])
?>