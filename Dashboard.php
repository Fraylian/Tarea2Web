<?php
include 'db.php'; // Asegúrate de que este archivo contiene la conexión a tu base de datos

// Ejecutar consultas y guardar los resultados
$total_guerreros = $conn->query("SELECT COUNT(*) AS total FROM warriors")->fetch_assoc()['total'];
$total_habilidades = $conn->query("SELECT COUNT(*) AS total FROM skills")->fetch_assoc()['total'];
$promedio_habilidades = $conn->query("SELECT AVG(cuenta_habilidades) AS promedio FROM (SELECT COUNT(*) AS cuenta_habilidades FROM warrior_skills GROUP BY warrior_id) AS subconsulta")->fetch_assoc()['promedio'];
$edad_promedio = $conn->query("SELECT AVG(TIMESTAMPDIFF(YEAR, birth_date, CURDATE())) AS edad_promedio FROM warriors")->fetch_assoc()['edad_promedio'];
$poder_promedio = $conn->query("SELECT AVG(power_level) AS poder_promedio FROM skills")->fetch_assoc()['poder_promedio'];
$habilidades_extremas = $conn->query("SELECT MAX(power_level) AS max_poder, MIN(power_level) AS min_poder FROM skills")->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard de Estadísticas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Dashboard de Estadísticas - Dragon Ball Warriors</h1>
    <div class="row">
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Total de Guerreros</div>
                <div class="card-body">
                    <p class="card-text"><?php echo $total_guerreros; ?> Guerreros registrados</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Total de Habilidades</div>
                <div class="card-body">
                    <p class="card-text"><?php echo $total_habilidades; ?> Habilidades registradas</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-info mb-3">
                <div class="card-header">Promedio de Habilidades por Guerrero</div>
                <div class="card-body">
                    <p class="card-text"><?php echo round($promedio_habilidades, 2); ?> Habilidades por guerrero</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header">Edad Promedio de los Guerreros</div>
                <div class="card-body">
                    <p class="card-text"><?php echo round($edad_promedio, 1); ?> años</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-danger mb-3">
                <div class="card-header">Nivel de Poder Promedio</div>
                <div class="card-body">
                    <p class="card-text"><?php echo round($poder_promedio, 1); ?></p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-dark mb-3">
                <div class="card-header">Extremos de Poder de Habilidad</div>
                <div class="card-body">
                    <p class="card-text">Máximo: <?php echo $habilidades_extremas['max_poder']; ?></p>
                    <p class="card-text">Mínimo: <?php echo $habilidades_extremas['min_poder']; ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
