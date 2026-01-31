<?php
$dsn = "pgsql:host=db.exyysvmpeyhqicnxwpfz.supabase.co;port=5432;dbname=postgres";
$user = "postgres";
$password = "mbWMzgQ3LktvCLar";

try {
    $pdo = new PDO($dsn, $user, $password, [
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