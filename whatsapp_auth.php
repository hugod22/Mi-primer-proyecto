<?php
session_start();
header('Content-Type: text/html; charset=UTF-8');
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Incluir la conexión a la base de datos
include 'db.php';
// Verificar si se envió el formulario de registro
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["nombre"], $_POST["telefono1"], $_POST["apikey"])) {
    $nombre = trim($_POST["nombre"]);
    $telefono1 = trim($_POST["telefono1"]);
    $apikey = trim($_POST["apikey"]);

    if (!preg_match('/^\d{7}$/', $apikey)) {
        echo "<script>alert('La API Key debe contener exactamente 7 números.'); window.location.href='validacion';</script>";
        exit();
    }
    // Agregar el código de país si no está presente
    if (substr($telefono1, 0, 3) !== '+51') {
        $telefono1 = '+51' . $telefono1;
    }
    // Verificar si el usuario existe
    $stmt = $conexion->prepare("SELECT * FROM usuario WHERE nombre = ?");
    $stmt->bind_param("s", $nombre);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        // Actualizar datos del usuario
        $stmt_update = $conexion->prepare("UPDATE usuario SET telefono = ?, apikey = ? WHERE nombre = ?");
        $stmt_update->bind_param("sss", $telefono1, $apikey, $nombre);
        
        if ($stmt_update->execute()) {
            echo "<script>alert('Datos enviados correctamente.'); window.location.href='validacion';</script>";
        } 
    } else {
        echo "<script>alert('El usuario no está registrado en la base de datos.'); window.location.href='validacion';</script>";
    }
}

// Verificar si se envió un número de teléfono
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["telefono2"])) {
    $telefono2 = trim($_POST["telefono2"]);
    
    if (substr($telefono2, 0, 3) !== '+51') {
        $telefono2 = '+51' . $telefono2;
    }

    $stmt = $conexion->prepare("SELECT correo_inst, contraseña_inst, usuario_SGD, contraseña_SGD, apikey FROM usuario WHERE telefono = ?");
    $stmt->bind_param("s", $telefono2);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        $_SESSION = array_merge($_SESSION, $fila);
        $_SESSION["codigo"] = rand(100000, 999999);

        if (enviarCodigoWhatsApp($telefono2, $_SESSION["codigo"], $_SESSION["apikey"])) {
            echo "<script>alert('Código enviado a su WhatsApp.'); window.location.href='validacion';</script>";
        } else {
            echo "<script>alert('Error al enviar el código. Verifique su API Key o conexión.'); window.location.href='validacion';</script>";
        }
    } else {
        echo "<script>alert('Error: El número de teléfono no está registrado.'); window.location.href='validacion';</script>";
    }
}

// Verificar el código ingresado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["codigo_ingresado"])) {
    if (isset($_SESSION["codigo"]) && $_POST["codigo_ingresado"] == $_SESSION["codigo"]) {
        $_SESSION["autenticado"] = true;
        header("Location: mostrar_datos");
        exit();
    } else {
        echo "<script>alert('Código incorrecto.'); window.location.href='validacion';</script>";
    }
}
function enviarCodigoWhatsApp($telefono2, $codigo, $apikey) {
    if (empty($apikey)) {
        echo "<script>alert('Error: No se encontró la API Key.');</script>";
        return false;
    }
    $api_url = "https://api.callmebot.com/whatsapp.php?phone=" . urlencode($telefono2) .
    "&text=" . urlencode("Su código de verificación es: " . $codigo) .
    "&apikey=" . urlencode($apikey);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return $http_code == 200;
}
$conexion->close();
?>