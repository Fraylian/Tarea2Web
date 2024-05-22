<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Registro de una nueva habilidad
    $name = $_POST['name'];
    $type = $_POST['type'];
    $power_level = $_POST['power_level'];

    $sql = "INSERT INTO skills (name, type, power_level) VALUES ('$name', '$type', $power_level)";

    if ($conn->query($sql) === TRUE) {
        echo "New skill registered successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Asociar habilidad a un guerrero
    $last_skill_id = $conn->insert_id; // ID de la última habilidad registrada
    $warrior_id = $_POST['warrior_id']; // Suponiendo que se envía desde el formulario

    $sql = "INSERT INTO warrior_skills (warrior_id, skill_id) VALUES ($warrior_id, $last_skill_id)";

    if ($conn->query($sql) === TRUE) {
        echo "Skill associated with warrior successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register Skill</title>
</head>
<body>
    <h2>Register New Skill</h2>
    <form action="register_skill.php" method="post">
        <label for="name">Skill Name:</label>
        <input type="text" id="name" name="name" required><br><br>
        <label for="type">Skill Type:</label>
        <select id="type" name="type" required>
            <option value="física">Física</option>
            <option value="energética">Energética</option>
            <option value="estratégica">Estratégica</option>
        </select><br><br>
        <label for="power_level">Power Level:</label>
        <input type="number" id="power_level" name="power_level" required><br><br>
        <label for="warrior_id">Warrior ID:</label>
        <input type="number" id="warrior_id" name="warrior_id" required><br><br>
        <input type="submit" value="Register Skill">
    </form>
</body>
</html>
