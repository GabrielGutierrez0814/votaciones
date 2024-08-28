<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sistema_votacion";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

session_start(); // Iniciar sesión para almacenar datos de usuario

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Preparar y ejecutar la consulta para verificar el usuario
    $sql = "SELECT id, nombre, rol_id, password FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $nombre, $rol_id, $hashed_password);

    if ($stmt->num_rows > 0) {
        $stmt->fetch();
        // Verificar la contraseña
        if (password_verify($password, $hashed_password)) {
            // Almacenar datos en la sesión
            $_SESSION['user_id'] = $id;
            $_SESSION['nombre'] = $nombre;
            $_SESSION['rol_id'] = $rol_id;

            // Redirigir según el rol
            if ($rol_id == 1) { // Supongamos que 1 es el rol de administrador
                header("Location: admin.php");
            } elseif ($rol_id == 2) { // Supongamos que 2 es el rol de usuario
                header("Location: menu.php");
            } else {
                echo "Rol desconocido.";
            }
            exit();
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Correo electrónico no registrado.";
    }

    $stmt->close();
}

$conn->close();
?>
