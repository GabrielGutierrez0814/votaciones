<?php
// Conexión a la base de datos
$conn = new mysqli('localhost', 'root', '', 'sistema_votacion');

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$edad = $_POST['edad'];
$foto = $_FILES['foto']['name'];

// Guardar la imagen en el servidor
$target_dir = "uploads/";
$target_file = $target_dir . basename($foto);
move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file);

$sql = "INSERT INTO candidatos (nombre, apellido, edad, foto) VALUES ('$nombre', '$apellido', '$edad', '$target_file')";

if ($conn->query($sql) === TRUE) {
    echo "Candidato agregado exitosamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
