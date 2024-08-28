<?php
// Configuración de la base de datos
$host = 'localhost'; // Cambia esto según tu configuración
$dbname = 'sistema_votacion';
$username = 'root'; // Cambia esto según tu configuración
$password = ''; // Cambia esto según tu configuración

// Conectar a la base de datos
$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Consultar la base de datos para obtener los resultados
$query = 'SELECT nombre, votos, foto FROM candidatos';
$stmt = $pdo->prepare($query);
$stmt->execute();

// Obtener los resultados como un array asociativo
$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Construir la URL completa para la imagen
foreach ($resultados as &$candidato) {
    $candidato['foto'] = 'uploads/' . $candidato['foto'];
}

// Devolver los resultados como JSON
header('Content-Type: application/json');
echo json_encode($resultados);
?>
