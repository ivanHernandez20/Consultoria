<?php
// Función para verificar si el usuario es administrador
function verificarAdmin() {
    if (!isset($_SESSION['usuario_id'])) {
        header('Location: ../login.html');
        exit();
    }
    // En una aplicación real, verificarías el tipo de usuario en la base de datos
    if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] != 'admin') {
        header('Location: ../index.html');
        exit();
    }
}

// Función para verificar si el usuario es cliente
function verificarCliente() {
    if (!isset($_SESSION['usuario_id'])) {
        header('Location: ../login.html');
        exit();
    }
    // En una aplicación real, verificarías el tipo de usuario en la base de datos
    if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] != 'cliente') {
        header('Location: ../index.html');
        exit();
    }
}
?>