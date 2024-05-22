<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $birth_date = $_POST['birth_date'];

    $sql = "INSERT INTO warriors (first_name, last_name, birth_date) VALUES ('$first_name', '$last_name', '$birth_date')";

    if ($conn->query($sql) === TRUE) {
        echo "New warrior registered successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register Warrior</title>
</head>
<body>
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
</body>
</html>
