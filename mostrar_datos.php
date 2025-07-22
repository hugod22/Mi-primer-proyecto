<?php
session_start();
// Verificar autenticación
if (!isset($_SESSION["autenticado"]) || $_SESSION["autenticado"] !== true) {
    header("Location: index.php");
    exit();
}
// Incluir la conexión a la base de datos
include 'db.php';
// Obtener datos de sesión
$correo_inst = $_SESSION["correo_inst"] ?? "No disponible";
$contraseña_inst = $_SESSION["contraseña_inst"] ?? "No disponible";
$usuario_SGD = $_SESSION["usuario_SGD"] ?? "No disponible";
$contraseña_SGD = $_SESSION["contraseña_SGD"] ?? "No disponible";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda de Correos</title>
    <style>
        body {
            background-color: green;
            color: white;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .card {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
            width: 350px;
            margin-bottom: 20px;
        }
        h1 {
            margin-bottom: 15px;
            font-size: 24px;
        }
        p {
            font-size: 18px;
            margin: 10px 0;
        }
        strong {
            font-size: 20px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            border-radius: 5px;
            background-color: white;
            color: green;
            font-size: 16px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
        }
        .btn:hover {
            background-color: rgba(255, 255, 255, 0.8);
        }
        .btn-container {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <!-- Card de Correo Institucional -->
    <div class="card">
        <h1>Correo Institucional</h1>
        <?php if (!empty($correo_inst) && !empty($contraseña_inst)) : ?>
            <p>📧 Correo: <strong><?= htmlspecialchars($correo_inst) ?></strong></p>
            <p>🔑 Contraseña: <strong><?= htmlspecialchars($contraseña_inst) ?></strong></p>
        <?php else : ?>
            <p>No se encontraron datos del usuario.</p>
        <?php endif; ?>
    </div>
    <!-- Card de Usuario SGD -->
    <div class="card">
        <h1>Usuario SGD</h1>
        <?php if (!empty($usuario_SGD) && !empty($contraseña_SGD)) : ?>
            <p>📧 Usuario SGD: <strong><?= htmlspecialchars($usuario_SGD) ?></strong></p>
            <p>🔑 Contraseña SGD: <strong><?= htmlspecialchars($contraseña_SGD) ?></strong></p>
        <?php else : ?>
            <p>No se encontraron datos del correo SGD.</p>
        <?php endif; ?>
    </div>
    <!-- Botón para cerrar sesión -->
    <div class="btn-container">
        <a href="logout.php" class="btn">Ir al Inicio</a>
    </div>
</body>
</html>
<?php $conexion->close(); ?>
