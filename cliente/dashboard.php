<?php
session_start();
require_once '../includes/auth.php';
verificarCliente();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Panel - SysConsult</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="dashboard.php">
                <i class="bi bi-person-circle"></i> Mi Cuenta
            </a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="mis_servicios.php">Mis Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tickets.php">Tickets de Soporte</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="perfil.php">Mi Perfil</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-danger" href="../includes/logout.php">Salir</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h2>Bienvenido, Cliente</h2>
        
        <!-- Tarjetas de estado -->
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Servicios Contratados</h5>
                        <h2>3</h2>
                        <a href="mis_servicios.php" class="btn btn-primary">Ver Todos</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tickets Abiertos</h5>
                        <h2>2</h2>
                        <a href="tickets.php" class="btn btn-warning">Ver Tickets</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Próximo Vencimiento</h5>
                        <h2>15 días</h2>
                        <a href="#" class="btn btn-info">Renovar</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Servicios activos -->
        <div class="card mt-4">
            <div class="card-header">
                <h5>Mis Servicios Activos</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5>Ciberseguridad Premium</h5>
                                <p>Estado: <span class="badge bg-success">Activo</span></p>
                                <p>Vencimiento: 15/10/2024</p>
                                <a href="#" class="btn btn-sm btn-outline-primary">Gestionar</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5>Cloud Storage 500GB</h5>
                                <p>Estado: <span class="badge bg-success">Activo</span></p>
                                <p>Vencimiento: 20/10/2024</p>
                                <a href="#" class="btn btn-sm btn-outline-primary">Gestionar</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5>Soporte 24/7</h5>
                                <p>Estado: <span class="badge bg-warning">Por renovar</span></p>
                                <p>Vencimiento: 05/10/2024</p>
                                <a href="#" class="btn btn-sm btn-outline-warning">Renovar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>