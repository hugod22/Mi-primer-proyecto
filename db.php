<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "muni";

// Crear conexión
$conexion = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
// Configurar charset para evitar problemas con acentos y caracteres especiales
$conexion->set_charset("utf8");
?>
