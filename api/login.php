<?php
session_start();

    require_once("../config/supabase.php");

    if($_SERVER["REQUEST_METHOD"] !== "POST"){
        header("Location: ../login.html")
        exit;
    }

    /* DATOS DEL FORMULARIO */
    $correo = $_POST["email"] ?? "";
    $password = $_POST["password"] ?? ""

    if(!$correo || !$password){
        header("Location: ../login.html?error=1");
        exit;
    }

    /* CONSULTA */
    $sql = "SELECT * FROM tb_logeo WHERE correo = :correo AND password = :password AND estatus = 1 AND tipo_usuario = 'Administrador'";

    $stmt = $pdo->prepare($sql);
    $stmt -> execute([":correo" => $correo, ":password" => $password]);

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    if(!$usuario){
        header("Location: ../login.html?error=2");
        exit;
    }

    /* CREAR SESION */
    $_SESSION["admin_id"] = $usuario["id_log"];
    $_SESSION["admin_nombre"] = trim($usuario["nombre"] . " " . $usuario["apaterno"] . " " . $usuario["amaterno"]);
    $_SESSION["admin_correo"] = $usuario["correo"];

    /* REDIRIJIR AL PANEL */
    header("Location: ../admin/dashboard.php");
    exit;
?>