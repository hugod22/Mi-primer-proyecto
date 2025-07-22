<?php
require_once __DIR__ . '/vendor/autoload.php';
session_start();
// Verificar que se reciben los parámetros necesarios
if (!isset($_GET['responsable'], $_GET['area'], $_GET['asunto'], $_GET['lugar'], $_GET['fecha'], $_GET['hora_inicio'], $_GET['hora_fin'], $_GET['necesita_proyector'])) {
    die("Error: Faltan parámetros en la solicitud.");
}

// Obtener y sanitizar datos
$responsable = htmlspecialchars($_GET['responsable']);
$area = htmlspecialchars($_GET['area']);
$asunto = htmlspecialchars($_GET['asunto']);
$lugar = htmlspecialchars($_GET['lugar']);
$fecha = htmlspecialchars($_GET['fecha']);
$hora_inicio = htmlspecialchars($_GET['hora_inicio']);
$hora_fin = htmlspecialchars($_GET['hora_fin']);
$necesita_proyector = (!empty($_GET['necesita_proyector']) && $_GET['necesita_proyector'] === 'Si') ? 'Sí' : 'No';

// Crear el PDF
$pdf = new TCPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Sistema de Reservas');
$pdf->SetTitle('Confirmación de Reserva');
$pdf->SetMargins(10, 20, 10);
$pdf->AddPage();

//Agregar logo si existe
$logoPath = __DIR__ . '/logo.png';
if (file_exists($logoPath)) {
    $pdf->Image($logoPath, 160, 10, 50, 50, 'PNG', '', '', false, 300, '', false, false, 0, false, false, false);
}
// Contenido del PDF
$html = "
<h2 style='text-align:center;'>Confirmación de Reserva</h2>
<p><strong>Responsable:</strong> $responsable</p>
<p><strong>Área:</strong> $area</p>
<p><strong>Asunto:</strong> $asunto</p>
<p><strong>Lugar:</strong> $lugar</p>
<p><strong>Fecha:</strong> $fecha</p>
<p><strong>Hora:</strong> $hora_inicio - $hora_fin</p>
<p><strong>Proyector:</strong> " . ($necesita_proyector == 'Sí' ? 'Sí' : 'No') . "</p>
<p>Gracias por su reserva.</p>";

$pdf->writeHTML($html, true, false, true, false, '');

$pdfFileName = "Reserva_{$responsable}_{$fecha}.pdf";

$pdf->Output($pdfFileName, 'D'); 

exit();
?>

