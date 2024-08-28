<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Verificar si el usuario es administrador
if ($_SESSION['rol_id'] == 1) {
    echo "Bienvenido, Administrador";
    // Mostrar opciones de gestión de candidatos, usuarios, etc.
} else {
    echo "Bienvenido, Usuario";
    // Mostrar opciones limitadas o solo información.
}
?>
