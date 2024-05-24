<?php
include 'db.php';

// Obtener los guerreros
$sql = "SELECT id, first_name, last_name, birth_date FROM warriors";
$result = $conn->query($sql);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Procesar la actualización del guerrero
    $id = $_POST['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $birth_date = $_POST['birth_date'];

    $sql = "UPDATE warriors SET first_name = ?, last_name = ?, birth_date = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $first_name, $last_name, $birth_date, $id);

    if ($stmt->execute()) {
        echo "Warrior updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
    header("Location: edit_warrior.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Warrior</title>
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
            <a class="navbar-brand" href="#">Guerreros Z</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Register Warrior</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register_skill.php">Register Skill</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="warrior_skills_view.php">View Warriors</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="edit_warrior.php">Edit Warriors</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div id="main">
            <h2>Edit Warriors</h2>
            <?php if ($result->num_rows > 0): ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Birth Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <form action="edit_warrior.php" method="post">
                                    <td><input type="text" class="form-control" name="first_name" value="<?= $row['first_name'] ?>"></td>
                                    <td><input type="text" class="form-control" name="last_name" value="<?= $row['last_name'] ?>"></td>
                                    <td><input type="date" class="form-control" name="birth_date" value="<?= $row['birth_date'] ?>"></td>
                                    <td>
                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </td>
                                </form>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No warriors found</p>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
