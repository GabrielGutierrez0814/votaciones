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

$registro_exitoso = false; // Inicializar la variable para el éxito del registro

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $rol_id = $_POST['rol_id']; // Capturar el ID del rol desde el formulario

    // Verificar si el correo ya está registrado
    $sql_check = "SELECT id FROM usuarios WHERE email = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param('s', $email);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows > 0) {
        echo "El correo ya está registrado.";
    } else {
        // Insertar el nuevo usuario en la base de datos
        $sql = "INSERT INTO usuarios (nombre, apellidos, email, password, rol_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssssi', $nombre, $apellidos, $email, $password, $rol_id);

        if ($stmt->execute()) {
            $registro_exitoso = true; // El registro fue exitoso
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $stmt_check->close();
}

$conn->close();

// Después de registrar al usuario exitosamente, redirige a login.php
if ($registro_exitoso) {
    header("Location: index.html");
    exit();
}
?>
