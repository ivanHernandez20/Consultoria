<?php
    require_once("../config/supabase.php");
    require_once("../utils/response.php");

    if($_SERVER["REQUEST_METHOD"] !== "POST"){
        jsonResponse(["error" => "No se permite otro metodo que no sea POST"], 405);
    }

    $data = json_decode(file_get_contents("php://input"), true);

    $nombre = $data["nombre"] ?? "";
    $aPaterno = $data["aPaterno"] ?? "";
    $correo = $data["correo"] ?? "";
    $telefono = $data["telefono"] ?? "";
    $asunto = $data["asunto"] ?? "";
    $mensaje = $data["mensaje"] ?? "";

    if(!$nombre || !$aPaterno || !$correo || !$asunto || !$mensaje){
        jsonResponse(["error" => "Campos Faltantes"], 400);
    }

    $sql = "INSERT INTO tb_usuarios (nombre_usuario, aPaterno_usuario, correo_usuario, telefono_usuario, asunto_usuario, mensaje)
            VALUES(:nombre, :aPaterno, :aMaterno, :correo, :telefono, :asunto, :mensaje)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([":nombre"   => $nombre, ":apaterno" => $apaterno, ":correo"   => $correo, ":telefono" => $telefono, ":asunto"   => $asunto, ":mensaje"  => $mensaje]);

    jsonResponse(["ok" => true, "mensaje" => "Datos guardados correctamente"], 201);
?>