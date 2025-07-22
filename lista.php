<?php
header('Content-Type: text/html; charset=UTF-8');
include 'db.php';

// Consulta segura a la base de datos
$sql = "SELECT area, correo FROM area";
$result = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Correos Institucionales</title>
    <style>
        body {
            background-color: green;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            color: white;
            text-align: center;
        }
        .container {
            width: 90%;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .search-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        #searchBar {
            width: 100%;
            max-width: 400px;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            outline: none;
        }
        .btn-inicio {
            background-color: #1b5e20;
            color: white !important;
            font-weight: bold;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            border-radius: 30px;
            text-decoration: none;
            box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .btn-inicio:hover {
            background-color: darkgreen;
            transform: translateY(-3px);
            box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.4);
        }
        .btn-inicio svg {
            width: 24px;
            height: 24px;
            fill: white;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            color: black;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
        }
        th {
            background: #444;
            color: white;
        }
        @media (max-width: 800px) {
            .search-container {
                flex-direction: row;
                justify-content: space-between;
                width: 100%;
            }
            #searchBar {
                flex: 1;
                margin-right: 10px;
            }
            .btn-inicio {
                white-space: nowrap;
                padding: 10px 15px;
            }
        }
    </style>
    <script>
        function searchTable() {
            let input = document.getElementById("searchBar").value.toLowerCase().trim();
            let rows = document.querySelectorAll("table tbody tr");
            let noResultsMessage = document.getElementById("noResultsMessage");
            let hasMatches = false;
            
            rows.forEach(row => {
                let firstCellText = row.cells[0].innerText.toLowerCase();
                let firstWord = firstCellText.split(/\s+/)[0];
                
                if (firstWord.startsWith(input)) {
                    row.style.display = "";
                    hasMatches = true;
                } else {
                    row.style.display = "none";
                }
            });
            
            if (!hasMatches) {
                if (!noResultsMessage) {
                    noResultsMessage = document.createElement("div");
                    noResultsMessage.id = "noResultsMessage";
                    noResultsMessage.innerText = "No se encontraron coincidencias.";
                    noResultsMessage.style.color = "white";
                    noResultsMessage.style.marginTop = "20px";
                    document.querySelector(".container").appendChild(noResultsMessage);
                }
            } else {
                if (noResultsMessage) {
                    noResultsMessage.remove();
                }
            }
        }
        window.onload = function() {
        window.scrollTo(0, 0); 
    };
    </script>
</head>
<body>
    <div class="container">
        <h2>Lista de Correos Institucionales</h2>
        <div class="search-container">
            <input type="text" id="searchBar" onkeyup="searchTable()" placeholder="Buscar correo o dependencia..." aria-label="Buscar en la tabla">
            <a href="index.php" class="btn-inicio">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                </svg>
                Ir al Inicio
            </a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Dependencia</th>
                    <th>Correo Institucional</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row["area"]) ?></td>
                            <td><?= htmlspecialchars($row["correo"]) ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="2">No hay datos disponibles</td></tr>
                <?php endif; ?>
                <?php $conexion->close(); ?>
            </tbody>
        </table>
    </div>
</body>
</html>


