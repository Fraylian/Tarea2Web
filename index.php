<!DOCTYPE html>
<html>
<head>
    <title>Dragon Ball Warriors Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('img/fondo1.jpeg');
            background-size: cover;
            background-position: center;
        }
        .container {
            text-align: center;
            background: rgba(255, 255, 255, 0.8); /* Fondo semi-transparente para mejorar la legibilidad del texto */
            padding: 20px;
            box-shadow: 0px 0px 10px 0px #000;
        }
        .btn {
            background: #333;
            color: #fff;
            padding: 15px 30px;
            margin: 10px;
            text-decoration: none;
            border: none;
            display: inline-block;
            cursor: pointer;
        }
        .btn:hover {
            background: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Guerreros Dragon Ball</h1>
        <a href="register.php" class="btn">Registrar nuevo Guerrero</a>
        <a href="register_skill.php" class="btn">Registrar Nuevas habilidades</a>
        <a href="warrior_skills_view.php" class="btn">Guerreros con sus habilidades</a>
        <a href="Dashboard.php" class="btn">Ver Dashboard</a>
    </div>
</body>
</html>
