<?php
    require_once("../config/db.php");
    require_once("../utils/response.php");

    if($_SERVER["REQUEST_METHOD"] !== "POST"){
        jsonResponse(["error" => "Metodo no permitido"], 405);
    }

    $correo = $_POST["correo"] ?? "";
    $password = $_POST["password"] ?? ""

    if(!$correo || !$password){
        jsonResponse(["error" => "Datos Incompletos"], 400);
    }

    $sql = "SELECT * FROM tb_logeo WHERE correo = ? AND password = ? AND estatus = 1";

    $stmt = $pdo -> prepare($sql);
    $stmt -> execute([$correo, $tipo]);

    $usuario = $stmt -> fetch(PDO::FETCH_ASSOC);
    if(!$usuario){
        jsonResponse(["error" => "Acceso denegado"], 401);
    }

    jsonResponse(["ok" => true, "usuario" => [
        "id" => $usuario["id_log"],
        "nombre" => $usuario["nombre"] . " " . $usuario["aPaterno"] . " " . $usuario["aMaterno"],
        "tipo" => $usuario["tipo_usuario"]
    ]])
?>