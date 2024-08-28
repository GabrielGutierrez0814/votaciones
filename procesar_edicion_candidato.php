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
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$edad = $_POST['edad'];

// Verificar si se subió una nueva foto
if ($_FILES['foto']['name']) {
    $foto = 'uploads/' . basename($_FILES['foto']['name']);
    move_uploaded_file($_FILES['foto']['tmp_name'], $foto);

    // Actualizar los datos del candidato con la nueva foto
    $sql = "UPDATE candidatos SET nombre='$nombre', apellido='$apellido', edad='$edad', foto='$foto' WHERE id=$id";
} else {
    // Actualizar los datos del candidato sin cambiar la foto
    $sql = "UPDATE candidatos SET nombre='$nombre', apellido='$apellido', edad='$edad' WHERE id=$id";
}

if ($conn->query($sql) === TRUE) {
    echo "Candidato actualizado exitosamente.";
} else {
    echo "Error al actualizar el candidato: " . $conn->error;
}

$conn->close();
header('Location: admin.php');
exit();
?>
