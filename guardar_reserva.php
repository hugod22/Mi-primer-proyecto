<?php
// Incluir la conexión a la base de datos
include 'db.php';
// Determinar si es una solicitud para ver reservas
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['fecha'])) {
    $fecha = $_GET['fecha'];

    // Consulta para obtener las reservas de la fecha dada
    $sql = "SELECT * FROM reservas WHERE fecha = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $fecha);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $reservas = [];
        while ($fila = $result->fetch_assoc()) {
            $reservas[] = $fila;
        }
        echo json_encode(["error" => false, "reservas" => $reservas]);
    } else {
        echo json_encode(["error" => true, "mensaje" => "No hay reservas registradas para esta fecha."]);
    }

    $stmt->close();
    $conexion->close();
    exit; // Detener ejecución aquí si es consulta de reservas
}

// Si no es consulta de reservas, procesar la inserción
$responsable = trim($_POST['responsable'] ?? '');
$area = trim($_POST['area'] ?? '');
$asunto = trim($_POST['asunto'] ?? '');
$lugar = trim($_POST["lugar"] ?? ''); 
$fecha = $_POST['fecha'] ?? '';
$hora_inicio = $_POST['hora_inicio'] ?? '';
$hora_fin = $_POST['hora_fin'] ?? '';
$necesita_proyector = $_POST['necesita_proyector'] ?? 'No';

// Validaciones
if (empty($responsable) || empty($area) || empty($asunto) || empty($lugar) || empty($fecha) || empty($hora_inicio) || empty($hora_fin)) {
    echo json_encode(["error" => true, "mensaje" => "⚠️ Error: Todos los campos son obligatorios."]);
    exit;
}

if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha)) {
    echo json_encode(["error" => true, "mensaje" => "⚠️ Error: Formato de fecha inválido."]);
    exit;
}

if ($hora_inicio >= $hora_fin) {
    echo json_encode(["error" => true, "mensaje" => "⚠️ Error: La hora de inicio debe ser menor a la hora de fin."]);
    exit;
}

// Verificar si hay cruce de horarios en la misma fecha y lugar
$sql_verificar = "SELECT * FROM reservas 
                  WHERE fecha = ? AND lugar = ? AND (
                      (? < hora_fin AND ? > hora_inicio)
                  )";
$stmt = $conexion->prepare($sql_verificar);
$stmt->bind_param("ssss", $fecha, $lugar, $hora_inicio, $hora_fin);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode(["error" => true, "mensaje" => "⚠️ Error: Hay un cruce de horarios en el mismo lugar."]);
} else {
    // Insertar reserva
    $sql_insertar = "INSERT INTO reservas (responsable, area, asunto, lugar, fecha, hora_inicio, hora_fin, necesita_proyector) 
                     VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql_insertar);
    $stmt->bind_param("ssssssss", $responsable, $area, $asunto, $lugar, $fecha, $hora_inicio, $hora_fin, $necesita_proyector);

    if ($stmt->execute()) {
        echo json_encode(["error" => false, "mensaje" => "✅ Reserva guardada correctamente."]);
    } else {
        echo json_encode(["error" => true, "mensaje" => "❌ Error al guardar la reserva."]);
    }
}
$stmt->close();
$conexion->close();
?>


