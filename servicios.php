<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicios Internos</title>
    <style>
        body {
            background-color: green;
            margin: 0;
            padding: 20px;
            font-family: Arial, sans-serif;
            color: white;
            display: flex;
            justify-content: center;
            min-height: 100vh;
        }

        .main-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
            width: 90%;
            max-width: 1200px;
        }

        h1 {
            font-size: 28px;
            font-weight: bold;
            text-align: center;
            width: 100%;
        }

        .content-wrapper {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
            width: 100%;
            align-items: flex-start; 
        }

        .container {
            max-width: 500px;
            background: rgba(255, 255, 255, 0.15);
            padding: 30px;
            border-radius: 10px;
            font-size: 16px; 
        }

        .link-box {
            background-color: white;
            color: #2E7D32;
            padding: 15px;
            margin: 10px 0;
            border-radius: 5px;
            text-decoration: none;
            display: block;
            font-weight: bold;
            transition: background-color 0.3s ease;
            text-align: center;
        }
        .link-box:hover {
            background-color: lightgray;
        }
        .description {
            font-size: 1rem;
            margin-bottom: 5px;
            font-weight: normal;
            color: white;
            text-align: center;
        }
        .btn-wrapper {
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .btn-inicio {
            padding: 12px 16px;
            background-color: #1b5e20;
            color: white;
            text-decoration: none;
            border-radius: 30px;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
            font-size: 16px;
            justify-content: center;
        }
        .btn-inicio:hover {
            background-color: darkgreen;
            transform: translateY(-3px);
            box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.4);
        }
        .btn-inicio svg {
            width: 20px;
            height: 20px;
            fill: white;
        }
    </style>
</head>
<body>
    <div class="main-container">
        <h1>Servicios Internos</h1>
        <div class="btn-wrapper">
            <a href="index.php" class="btn-inicio">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                </svg>
                Ir al inicio
            </a>
        </div>
        <div class="content-wrapper">
            <!-- Columna de enlaces -->
            <div class="container">
                <p class="description">Accede al sistema de gestión de documentos y trámites administrativos.</p>
                <a class="link-box" href="https://tramitedoc.munisanramon.gob.pe/" target="_blank" rel="noopener noreferrer">Trámite Documentario</a>

                <p class="description">Consulta información oficial y noticias de la Municipalidad Distrital de San Ramón.</p>
                <a class="link-box" href="https://www.gob.pe/munisanramon" target="_blank" rel="noopener noreferrer">Portal Municipalidad</a>

                <p class="description">Soporte técnico de la Municipalidad Distrital de San Ramón.</p>
                <a class="link-box" href="https://facilita.gob.pe/t/11174" target="_blank" rel="noopener noreferrer">Sistema de Tickets - OTI</a>

                <p class="description">Solicitud de Servicios Archivísticos.</p>
                <a class="link-box" href="https://facilita.gob.pe/t/10498" target="_blank" rel="noopener noreferrer">Anexo 9: Solicitud de Servicios Archivísticos</a>

                <p class="description">Accede al correo institucional de la Municipalidad Distrital de San Ramón.</p>
                <a class="link-box" href="https://www.munisanramon.gob.pe:2096/" target="_blank" rel="noopener noreferrer">Webmail</a>
            </div>
        </div>
    </div>
</body>
</html>