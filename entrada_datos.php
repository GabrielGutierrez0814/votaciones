<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrada de Datos - Sistema de Votación Futurista</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #1e1e2f;
            color: #fff;
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #2b2b3c;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            width: 400px;
        }
        h1 {
            font-size: 1.5rem;
            color: #00ff99;
            text-align: center;
        }
        label {
            display: block;
            margin-bottom: 8px;
            color: #b0b0c3;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #333;
            border-radius: 5px;
            background-color: #2a2f38;
            color: #fff;
        }
        input[type="submit"] {
            background-color: #00ff99;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }
        input[type="submit"]:hover {
            background-color: #00cc7a;
        }

        /* Estilo para el modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            background: #2b2b3c;
            padding: 20px;
            border-radius: 10px;
            color: #fff;
            max-width: 500px;
            width: 100%;
            text-align: center;
        }
        .modal-content button {
            margin-top: 15px;
            padding: 10px 20px;
            border: none;
            background-color: #00ff99;
            color: #1e1e2f;
            font-size: 1rem;
            border-radius: 5px;
            cursor: pointer;
        }
        .modal-content button:hover {
            background-color: #00cc7a;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Ingrese sus Datos</h1>
        <form id="votoForm" method="post">
            <input type="hidden" name="candidato_id" value="<?php echo htmlspecialchars($_GET['candidato_id']); ?>">
            
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="apellidos">Apellidos:</label>
            <input type="text" id="apellidos" name="apellidos" required>

            <label for="cedula">Cédula:</label>
            <input type="text" id="cedula" name="cedula" required>

            <input type="submit" value="Enviar Datos">
        </form>
    </div>

    <!-- Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <p id="modalMessage"></p>
            <button onclick="closeModal()">Cerrar</button>
        </div>
    </div>

    <script>
        document.getElementById('votoForm').addEventListener('submit', function(e) {
            e.preventDefault(); // Prevenir el envío del formulario

            const formData = new FormData(this);

            fetch('procesar_voto.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                // Mostrar el modal con el mensaje
                document.getElementById('modalMessage').textContent = data.message;
                document.getElementById('myModal').style.display = 'flex';

                // Redireccionar automáticamente después de 3 segundos si el voto es exitoso
                if (data.status === 'success') {
                    setTimeout(() => {
                        window.location.href = 'votar.php';
                    }, 3000);
                }
            })
            .catch(error => console.error('Error:', error));
        });

        function closeModal() {
            document.getElementById('myModal').style.display = 'none';
            // Redireccionar a votar.php si el modal es cerrado y el voto fue exitoso
            if (document.getElementById('modalMessage').textContent.includes('Voto registrado exitosamente.')) {
                window.location.href = 'votar.php';
            }
        }
    </script>

</body>
</html>
