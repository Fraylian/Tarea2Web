<?php
include 'db.php'; // Asegúrate de que este archivo contiene la conexión a tu base de datos.

$sql = "SELECT * FROM warrior_skills_view";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Habilidades de los guerreros</title>
    <!-- Incluye Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .table img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 50%;
        }
        .container {
            margin-top: 50px;
        }
        .btn-custom {
            background-color: #007bff;
            color: #fff;
            border: none;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
        .table thead {
            background-color: #343a40;
            color: #fff;
        }
        .table tbody tr:nth-child(odd) {
            background-color: #e9ecef;
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
     
    <div class="container">
        <h2 class="mb-4 text-center">Habilidades de los Guerreros</h2>
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Imagen</th>
                    <th>Nombre del Guerrero</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Nombre de la Habilidad</th>
                    <th>Tipo de Habilidad</th>
                    <th>Nivel de Poder</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td><img src='" . $row["img"] . "' alt='Imagen del Guerrero'></td>";
                        echo "<td>" . $row["warrior_name"] . "</td>";
                        echo "<td>" . $row["birth_date"] . "</td>";
                        echo "<td>" . $row["skill_name"] . "</td>";
                        echo "<td>" . $row["skill_type"] . "</td>";
                        echo "<td>" . $row["power_level"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>No se encontraron datos</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <div class="text-center mt-4">
            <a href="edit_skill.php" class="btn btn-custom">Editar habilidades</a>
            <a href="edit_warrior.php" class="btn btn-custom">Editar guerreros</a>
        </div>
    </div>

    <!-- Incluye Bootstrap JS y sus dependencias -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
