<?php
include 'db.php';

$warriors = [];

// Si el formulario fue enviado, procesamos la entrada
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Registro de una nueva habilidad
    $name = $_POST['name'];
    $type = $_POST['type'];
    $power_level = $_POST['power_level'];

    $sql = "INSERT INTO skills (name, type, power_level) VALUES ('$name', '$type', $power_level)";

    if ($conn->query($sql) === TRUE) {
        echo "New skill registered successfully";
        $last_skill_id = $conn->insert_id;
        $warrior_id = $_POST['warrior_id'];

        $sql = "INSERT INTO warrior_skills (warrior_id, skill_id) VALUES ($warrior_id, $last_skill_id)";

        if ($conn->query($sql) === TRUE) {
            echo "Skill associated with warrior successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Consultar la lista de guerreros para el select
$sql = "SELECT id, first_name, last_name FROM warriors";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $warriors[] = $row;
    }
}

// Cierra la conexión después de obtener todos los datos necesarios
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Skill</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .header {
            background-color: #f0f0f0;
            padding: 10px 0;
            text-align: center;
            font-size: 2em;
            font-weight: bold;
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
        <h2>Register New Skill</h2>
        <form action="register_skill.php" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Skill Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="type" class="form-label">Skill Type:</label>
                <select class="form-select" id="type" name="type" required>
                    <option value="física">Física</option>
                    <option value="energética">Energética</option>
                    <option value="estratégica">Estratégica</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="power_level" class="form-label">Power Level:</label>
                <input type="number" class="form-control" id="power_level" name="power_level" required>
            </div>
            <div class="mb-3">
                <label for="warrior_id" class="form-label">Warrior ID:</label>
                <select class="form-select" id="warrior_id" name="warrior_id" required>
                    <?php foreach ($warriors as $warrior) { ?>
                        <option value="<?php echo $warrior['id']; ?>">
                            <?php echo htmlspecialchars($warrior['first_name'] . ' ' . $warrior['last_name']); ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Register Skill</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
