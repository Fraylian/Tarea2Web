<?php
include 'db.php'; // Asegúrate de que este archivo contiene la conexión a tu base de datos.

$sql = "SELECT * FROM warrior_skills_view";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Habilidades de los guerreros</title>
    <!-- Incluye Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
     
    <div class="container mt-5">
        <a href="index.php" class="btn btn-danger mt-3">Regresar al inicio</a>
        <br><br>
        <h2 class="mb-4">Habilidades de los guerreros</h2>
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <!-- <th>Warrior ID</th> -->
                    <th>Warrior Name</th>
                    <th>Birth Date</th>
                    <!-- <th>Skill ID</th> -->
                    <th>Skill Name</th>
                    <th>Skill Type</th>
                    <th>Power Level</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        // echo "<td>" . $row["warrior_id"] . "</td>";
                        echo "<td>" . $row["warrior_name"] . "</td>";
                        echo "<td>" . $row["birth_date"] . "</td>";
                        // echo "<td>" . $row["skill_id"] . "</td>";
                        echo "<td>" . $row["skill_name"] . "</td>";
                        echo "<td>" . $row["skill_type"] . "</td>";
                        echo "<td>" . $row["power_level"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No data found</td></tr>";
                }
                ?>
            </tbody>
        </table>
        
    </div>
    <!-- Incluye Bootstrap JS y sus dependencias -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
