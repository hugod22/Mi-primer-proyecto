<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificación via WhatsApp</title>
    <style>
        body {
            background-color: #008000;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .wrapper {
            display: flex;
            align-items: flex-start;
            gap: 30px;
            max-width: 900px;
            width: 100%;
            justify-content: center;
        }

        .instrucciones, .container {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            width: 380px;
            text-align: center;
        }

        h2, h3 {
            color: green;
            font-size: 32px;
            margin-bottom: 10px;
        }

        .instrucciones ul {
            list-style: none;
            padding: 0;
        }

        .instrucciones li {
            padding: 8px;
            font-size: 14px;
            border-left: 4px solid green;
            margin-bottom: 8px;
            background: green;
            padding-left: 10px;
            color: white;
            border-radius: 8px;
        }

        input {
            width: 90%;
            padding: 12px;
            margin-top: 8px;
            border: 2px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            transition: border 0.3s;
        }

        input:focus {
            border-color: green;
            outline: none;
        }

        button {
            width: 97%;
            padding: 12px;
            margin-top: 15px;
            border: none;
            border-radius: 8px;
            background-color: green;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s;
        }

        button:hover {
            background-color: darkgreen;
            transform: scale(1);
        }

        .btn-inicio {
            position: fixed;
            bottom: 20px;
            right: 235px;
            background-color: #1b5e20;
            color: white !important;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            border-radius: 30px;
            text-decoration: none;
            box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }

        .btn-inicio:hover {
            background-color: darkgreen;
            transform: translateY(-3px);
            box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.4);
        }

        .nota {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: green;
            font-weight: bold;
        }

        .btn-inicio svg {
            width: 20px;
            height: 20px;
            fill: white;
        }

        @media (max-width: 600px) {
            body {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: flex-start;
                padding: 10px;
            }

            .wrapper {
                flex-direction: column;
                align-items: center;
                gap: 15px;
                width: 100%;
            }

            .instrucciones, .container {
                width: 85%;
                max-width: 400px;
            }

            .btn-inicio {
                width: 30%;
                text-align: center;
                margin-top: 30px;
                position: relative;
                bottom: 20;
                right: 0;
            }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="instrucciones">
            <h3>PASO 1</h3>
            <ul>
                <li>📱 Agrega el número <strong>+34 684 73 40 44</strong> a tus contactos de WhatsApp.</li>
                <li>📩 Envíale el mensaje: <strong>Permito que callmebot me envíe mensajes.</strong></li>
            </ul>
            <form method="POST" action="whatsapp_auth.php">
                <label for="nombre">Nombre y Primer Apellido</label>
                <input type="text" name="nombre" id="nombre" placeholder="Ingrese su nombre y primer apellido" required>
                <label for="telefono1">Celular:</label>
                <input type="text" name="telefono1" id="telefono1" placeholder="Ingrese su numero de celular"  required>
                <label for="apikey">API Key:</label><br>
                <input type="text" name="apikey" id="apikey" placeholder="Ingrese el ApyKey recibido en su Whatsaap" required  pattern="\d{7}" title="El API Key debe contener exactamente 7 dígitos"  maxlength="7">
                <button type="submit">Enviar</button>
            </form>
        </div>

        <div class="container">
            <p class="nota">NOTA: Para consultar nuevamente sus usuarios y contraseñas, solo realice el paso 2.</p>
            <h2>PASO 2</h2>
            <form method="post" action="whatsapp_auth.php">
                <label for="telefono2">Ingrese su número de celular:</label>
                <input type="text" name="telefono2"id="telefono2" required>
                <button type="submit">Enviar Código</button>
            </form>
            <form method="post" action="whatsapp_auth.php"><br>
                <label for="codigo_ingresado">Ingrese el nuevo código recibido:</label>
                <input type="text" name="codigo_ingresado" id="codigo_ingresado" required  pattern="\d{6}" title="El codigo debe contener exactamente 6 dígitos"  maxlength="6">
                <button type="submit">Verificar Código</button>
            </form>
        </div>
    </div>

    <a href="index.php" class="btn-inicio">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
        </svg>
        Ir al Inicio
    </a>
</body>
</html>
