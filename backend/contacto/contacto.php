<?php
    require_once("../config/db.php");
    require_once("../utils/response.php");

    if($_SERVER["REQUEST_METHOD"] !== "POST"){
        jsonResponse(["error" => "No se permite otro metodo que no sea POST"], 405);
    }

    $nombre = $_POST["nombre"] ?? "";
    $aPaterno = $_POST["aPaterno"] ?? "";
    $correo = $_POST["correo"] ?? "";
    $telefono = $_POST["telefono"] ?? "";
    $asunto = $_POST["asunto"] ?? "";
    $mensaje = $_POST["mensaje"] ?? "";

    if(!$nombre || !$aPaterno || !$correo || !$asunto || !$mensaje){
        jsonResponse(["error" => "Campos Faltantes"], 400);
    }

    $sql = "INSERT INTO tb_usuarios (nombre_usuario, aPaterno_usuario, correo_usuario, telefono_usuario, asunto_usuario, mensaje)
            VALUES(?,?,?,?,?,?)";
    jsonResponse(["ok" => true, "mensaje" => "Datos guardados correctamente"]);
?>