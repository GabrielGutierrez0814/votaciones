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

// Obtener los datos del formulario
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$edad = $_POST['edad'];

// Manejar la carga de la foto
$foto = 'uploads/' . basename($_FILES['foto']['name']);
move_uploaded_file($_FILES['foto']['tmp_name'], $foto);

// Insertar el nuevo candidato en la base de datos
$sql = "INSERT INTO candidatos (nombre, apellido, edad, foto) VALUES ('$nombre', '$apellido', '$edad', '$foto')";

if ($conn->query($sql) === TRUE) {
    echo "Nuevo candidato agregado exitosamente.";
} else {
    echo "Error al agregar el candidato: " . $conn->error;
}

$conn->close();
header('Location: admin.php');
exit();
?>
