<?php
include 'db.php'; // Asegúrate de que este archivo contiene la conexión a tu base de datos.

$sql = "SELECT * FROM warrior_skills_view";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Warrior Skills Overview</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Warrior Skills Overview</h2>
    <table>
        <thead>
            <tr>
                <th>Warrior ID</th>
                <th>Warrior Name</th>
                <th>Birth Date</th>
                <th>Skill ID</th>
                <th>Skill Name</th>
                <th>Skill Type</th>
                <th>Power Level</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["warrior_id"] . "</td>";
                    echo "<td>" . $row["warrior_name"] . "</td>";
                    echo "<td>" . $row["birth_date"] . "</td>";
                    echo "<td>" . $row["skill_id"] . "</td>";
                    echo "<td>" . $row["skill_name"] . "</td>";
                    echo "<td>" . $row["skill_type"] . "</td>";
                    echo "<td>" . $row["power_level"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No data found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
