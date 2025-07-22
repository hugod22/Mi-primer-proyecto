<?php
session_start();
header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal de Ayuda</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            background-color: green;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: white;
            text-align: center;
        }

        .logo {
            position: absolute;
            top: 10px;
            left: 10px;
            width: 240px;
            height: auto;
        }

        .container {
            margin: 50px auto;
            width: 90%;
            max-width: 400px;
            background: rgba(255, 255, 255, 0.2);
            padding: 20px;
            border-radius: 10px;
        }

        h1, h2 {
            font-size: 32px;
            font-weight: bold;
            margin: 10px 0;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: white;
            border: none;
            color: green;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin: 10px 0;
            display: block;
        }

        button:hover {
            background-color: lightgray;
        }

        @media screen and (max-width: 600px) {
            .container {
                width: 95%;
                padding: 15px;
            }

            .logo {
                width: 80px;
                top: 5px;
                left: 5px;
            }

            h1 {
                margin-top: 80px;
                font-size: 32px;
            }

            h2 {
                font-size: 29px;
            }

            button {
                font-size: 16px;
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <img src="logo.png" alt="Logo" class="logo">
    <h1>Agenda Digital</h1>
    <h2>Municipalidad Distrital de San Ramón</h2>
    
    <div class="container">
        <h2>Portal de Ayuda</h2>
        <button onclick="window.location.href='validacion.php'">Consulta tu usuario y contraseña del correo Institucionales y trámite documentario</button>
        <button onclick="window.location.href='reservas.php'">Reserva de Auditorio</button>
        <button onclick="window.location.href='servicios.php'">Enlaces de Servicios Internos</button>
        <button onclick="window.location.href='lista.php'">Lista de Correos Institucionales</button>
    </div>
</body>
</html>
