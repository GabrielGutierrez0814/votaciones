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

// Obtener el ID del candidato a eliminar
$id = $_GET['id'];

// Eliminar el candidato
$sql = "DELETE FROM candidatos WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Candidato eliminado exitosamente.";
} else {
    echo "Error al eliminar el candidato: " . $conn->error;
}

$conn->close();
header('Location: admin.html');
exit();
?>
