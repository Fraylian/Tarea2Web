<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $birth_date = $_POST['birth_date'];
    $identificacion = $_POST['identificacion'];

    // Manejar la subida de la imagen
    $img = $_FILES['img']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($img);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Validar el archivo de imagen
    $check = getimagesize($_FILES['img']['tmp_name']);
    if ($check !== false) {
        if (move_uploaded_file($_FILES['img']['tmp_name'], $target_file)) {
            $sql = "INSERT INTO warriors (first_name, last_name, birth_date, identificacion, img) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssss", $first_name, $last_name, $birth_date, $identificacion, $target_file);

            if ($stmt->execute()) {
                echo "Nuevo guerrero registrado exitosamente";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $stmt->close();
        } else {
            echo "Lo siento, hubo un error al subir tu archivo.";
        }
    } else {
        echo "El archivo no es una imagen.";
    }

    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Guerrero</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 50%;
            margin: auto;
            overflow: hidden;
        }
        #main {
            background: #fff;
            color: #333;
            padding: 20px;
            margin-top: 30px;
            box-shadow: 0px 0px 10px 0px #000;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Guerreros Z</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Registrar nuevo Guerrero</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register_skill.php">Registrar Nuevas habilidades</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="warrior_skills_view.php">Guerreros con sus habilidades</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Dashboard.php">Dashboard</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="container mt-5">
        <div id="main">
            <h2>Registrar nuevo Guerrero</h2>
            <form action="register.php" method="post" enctype="multipart/form-data">
                <label for="first_name">Nombre:</label>
                <input type="text" class="form-control" id="first_name" name="first_name" required><br>
                <label for="last_name">Apellido:</label>
                <input type="text" class="form-control" id="last_name" name="last_name" required><br>
                <label for="identificacion">Identificación:</label>
                <input type="text" class="form-control" id="identificacion" name="identificacion" required><br>
                <label for="birth_date">Fecha de cumpleaños:</label>
                <input type="date" class="form-control" id="birth_date" name="birth_date" required><br>
                <label for="img">Imagen:</label>
                <input type="file" class="form-control" id="img" name="img" required><br>
                <button type="submit" class="btn btn-primary">Registrar</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


    
