<?php
include('db.php');

// Obtener mes y año de la solicitud o usar los valores actuales
$mes = isset($_GET['mes']) ? intval($_GET['mes']) : date('m');
$año = isset($_GET['año']) ? intval($_GET['año']) : date('Y');

// Configurar el idioma para nombres de meses en español
setlocale(LC_TIME, 'es_ES.utf8', 'es_ES', 'esp', 'es');
$nombreMes = ucfirst(strftime('%B %Y', strtotime("$año-$mes-01")));

// Obtener información del mes
$diasMes = date('t', strtotime("$año-$mes-01"));
$primerDia = date('N', strtotime("$año-$mes-01"));

// Iniciar la tabla del calendario
echo "<table>
        <thead>
            <tr>
                <th>Lunes</th><th>Martes</th><th>Miércoles</th><th>Jueves</th>
                <th>Viernes</th><th>Sábado</th><th>Domingo</th>
            </tr>
        </thead>
        <tbody>
        <tr>";

// Rellenar espacios en blanco antes del primer día del mes
for ($i = 1; $i < $primerDia; $i++) {
    echo "<td></td>";
}

// Generar los días del mes con sus reservas
for ($dia = 1; $dia <= $diasMes; $dia++) {
    $fechaActual = sprintf('%04d-%02d-%02d', $año, $mes, $dia);

    // Obtener reservas para el día actual 
    $sql = "SELECT responsable, area, asunto, lugar, hora_inicio, hora_fin, necesita_proyector FROM reservas WHERE fecha = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $fechaActual);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si hay reservas en la fecha
    $tieneReservas = ($result->num_rows > 0);
    $claseDia = $tieneReservas ? "reservado" : "disponible";

    // Agregar evento onclick para manejar interacciones
    echo "<td data-fecha='$fechaActual' class='dia-calendario $claseDia' onclick='manejarClick(this)'>$dia";

    // Mostrar reservas si existen
    if ($tieneReservas) {
        while ($reserva = $result->fetch_assoc()) {
            $hora_inicio = date("H:i", strtotime($reserva['hora_inicio']));
            $hora_fin = date("H:i", strtotime($reserva['hora_fin']));
            $necesita_proyector = $reserva['necesita_proyector']; 
            echo "<div class='info-reserva'>
            👤 {$reserva['responsable']} - 🏢 {$reserva['area']}<br>
            📝 {$reserva['asunto']} -📍 {$reserva['lugar']}<br>
            🕒 ({$hora_inicio} - {$hora_fin}) - 📽️ {$necesita_proyector}<br>
            </div>";
        }
    }
    echo "</td>";
    // Cerrar la fila cuando se complete la semana
    if (($dia + $primerDia - 1) % 7 == 0) {
        echo "</tr><tr>";
    }
}

// Cerrar la última fila y la tabla
echo "</tr></tbody></table>";

// Cerrar conexiones
$stmt->close();
$conexion->close();
?>
