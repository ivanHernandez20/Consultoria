<?php
    $host = "localhost";
    $db = "consultoria";
    $user = "root";
    $password = "Root";

    try{
        $pdo = new PDO(
            "mysql:host=$host;dbname=$db;charset=utf8",
            $user,
            $password,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    }catch(PDOException $e){
        http_response_code(500);
        echo json_encode(["error" => "Error de conexion"]);
        exit;
    }
?>