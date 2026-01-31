<?php

$host = getenv("DB_HOST");
$port = getenv("DB_PORT");
$db   = getenv("DB_NAME");
$user = getenv("DB_USER");
$pass = getenv("DB_PASS");
$dsn = "pgsql:host=$host;port=$port;dbname=$db";

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        "error" => "Error de conexión a Supabase",
        "detalle" => $e->getMessage()
    ]);
    exit;
}
/* DATABASE_URL=postgresql://postgres:mbWMzgQ3LktvCLar@db.exyysvmpeyhqicnxwpfz.supabase.co:5432/postgres */
?>




