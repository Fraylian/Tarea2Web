<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $birth_date = $_POST['birth_date'];

    $sql = "INSERT INTO warriors (first_name, last_name, birth_date) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $first_name, $last_name, $birth_date);

    if ($stmt->execute()) {
        echo "New warrior registered successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register Warrior</title>
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
        form label {
            display: block;
            margin-bottom: 5px;
        }
        form input[type="text"], form input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
        }
        form input[type="submit"] {
            background: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <div id="main">
            <h2>Register New Warrior</h2>
            <form action="register.php" method="post">
                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name" required><br><br>
                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name" required><br><br>
                <label for="birth_date">Birth Date:</label>
                <input type="date" id="birth_date" name="birth_date" required><br><br>
                <input type="submit" value="Register">
            </form>
        </div>
    </div>
</body>
</html>
