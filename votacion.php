<?php
$conn = new mysqli('localhost', 'root', '', 'sistema_votacion');

$sql = "SELECT * FROM candidatos";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
    echo "<div>";
    echo "<img src='" . $row['foto'] . "' alt='Foto de " . $row['nombre'] . "' width='100'>";
    echo "<h2>" . $row['nombre'] . " " . $row['apellido'] . "</h2>";
    echo "<p>Edad: " . $row['edad'] . "</p>";
    echo "<form action='votar.php' method='POST'>";
    echo "<input type='hidden' name='candidato_id' value='" . $row['id'] . "'>";
    echo "<button type='submit'>Votar</button>";
    echo "</form>";
    echo "</div>";
}
$conn->close();
?>
