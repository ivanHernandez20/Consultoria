<?php
session_start();

    if (!isset($_SESSION['usuario'])) {
        header('Location: login.html');
        exit();
    }

    $session_timeout = 3600; // 1 hora en segundos
    if (isset($_SESSION['login_time']) && (time() - $_SESSION['login_time'] > $session_timeout)) {
        session_destroy();
        header('Location: login.html');
        exit();
    }

    require_once("../config/supabase.php");
    $sql = " SELECT CONCAT(nombre, ' ', apaterno, ' ', amaterno), correo, tipo_usuario FROM tb_logeo LIMIT 1";

    $stmt = $pdo -> prepare($sql);
    $stmt->execute();
    $user = $stmt->fetchone(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Administración</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .sidebar {
            background: #2c3e50;
            color: white;
            min-height: 100vh;
            position: fixed;
            width: 250px;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
        .sidebar a {
            color: #ecf0f1;
            text-decoration: none;
            display: block;
            padding: 15px 20px;
            border-bottom: 1px solid #34495e;
        }
        .sidebar a:hover {
            background: #34495e;
        }
        .sidebar a.active {
            background: #3498db;
        }
        .user-info {
            background: #1a252f;
            padding: 20px;
            text-align: center;
        }
        .stats-card {
            border-radius: 10px;
            padding: 20px;
            color: white;
            margin-bottom: 20px;
        }
        .bg-primary { background: #3498db; }
        .bg-success { background: #2ecc71; }
        .bg-warning { background: #f39c12; }
        .bg-danger { background: #e74c3c; }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="user-info">
            <i class="bi bi-person-circle" style="font-size: 50px;"></i>
            <h5 class="mt-2"><?php echo htmlspecialchars($_SESSION['usuario']); ?></h5>
            <p class="text-muted">Administrador</p>
        </div>
        
        <nav>
        <!--    <a href="dashboard.php" class="active">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a href="#">
                <i class="bi bi-people"></i> Usuarios
            </a>
            <a href="#">
                <i class="bi bi-bar-chart"></i> Reportes
            </a>
            <a href="#">
                <i class="bi bi-gear"></i> Configuración
            </a>
            <a href="#">
                <i class="bi bi-bell"></i> Notificaciones
            </a> -->
            <a href="logout.php" style="color: #e74c3c;">
                <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
            </a>
        </nav>
    </div>


    <div class="main-content">
        <h1>Dashboard de Administración</h1>
        <p class="text-muted">Bienvenido al panel de control del sistema</p>
        

        <div class="row mt-4">
            <div class="col-md-3">
                <div class="stats-card bg-primary">
                    <i class="bi bi-people display-4"></i>
                    <h3>150</h3>
                    <p>Usuarios Activos</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card bg-success">
                    <i class="bi bi-check-circle display-4"></i>
                    <h3>42</h3>
                    <p>Tickets Resueltos</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card bg-warning">
                    <i class="bi bi-clock display-4"></i>
                    <h3>8</h3>
                    <p>Pendientes</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card bg-danger">
                    <i class="bi bi-exclamation-triangle display-4"></i>
                    <h3>3</h3>
                    <p>Alertas</p>
                </div>
            </div>
        </div>


        <div class="card mt-4">
            <div class="card-header">
                <h5><i class="bi bi-clock-history"></i> Actividad Reciente</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Acción</th>
                            <th>Fecha/Hora</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>admin</td>
                            <td>Inicio de sesión</td>
                            <td><?php echo date('d/m/Y H:i:s'); ?></td>
                        </tr>
                        <tr>
                            <td>soporte</td>
                            <td>Actualización de ticket</td>
                            <td>15/03/2024 10:30:22</td>
                        </tr>
                        <tr>
                            <td>usuario</td>
                            <td>Registro nuevo</td>
                            <td>15/03/2024 09:15:10</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>