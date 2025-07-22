<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario de Reservas</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    text-align: center;
    background-color: green;
    margin: 0;
    padding: 20px;
}

h2 {
    color: white;
    font-size: 32px;
}

h3 {
    color: white;
    font-size: 16px;
}

table {
    width: 100%;
    max-width: 1500px;
    margin: auto;
    border-collapse: collapse;
    background-color: white;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    overflow: hidden;
}

th {
    background-color: rgb(0, 255, 106);
    color: black;
    padding: 10px;
}

td {
    border: 1px solid #ddd;
    padding: 20px;
    text-align: center;
    min-width: 50px;
    position: relative;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
}

td:hover {
    background-color: #f1f1f1;
}

.info-reserva {
    margin: 2px auto;
    padding: 5px;
    color: black;
    border: 2px solid green;
    border-radius: 5px;
    background-color: #e6ffe6;
    text-align: center;
    font-weight: bold;
    font-size: 12px;
}

#reservaForm {
    display: none;
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    max-width: 400px;
    width: 100%;
    box-sizing: border-box;
    position: absolute;
    cursor: grab;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 1000;
}

.cerrar-formulario {
    position: absolute;
    top: 5px;
    right: 5px;
    background: red;
    color: white;
    border: none;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    width: 25px;
    height: 25px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    line-height: 1;
}

.cerrar-formulario:hover {
    color: darkred;
}

input, select, button {
    width: 100%;
    height: 40px;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

input:focus {
    border-color: green;
    outline: none;
}

button {
    background-color: #28a745;
    color: white;
    border: none;
    cursor: pointer;
    font-weight: bold;
}

button:hover {
    background-color: #218838;
}

#mensaje {
    margin-top: 10px;
    font-size: 14px;
    font-weight: bold;
    text-align: center;
}

.btn-inicio {
    position: relative;
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
    margin-top: 1px;
    width: max-content;
    margin-right: auto;
    margin-left: 20px;
}

.btn-inicio:hover {
    background-color: green;
    transform: translateY(-3px);
    box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.4);
}

.btn-inicio svg {
    width: 20px;
    height: 20px;
    fill: white;
}

#area {
    position: relative;
}

#sugerencias {
    position: absolute;
    top: 100%;
    left: 0;
    width: 100%;
    background: white;
    border: 1px solid #ccc;
    max-height: 150px;
    overflow-y: auto;
    display: none;
    z-index: 1000;
}
@media (max-width: 600px) {
    h2 {
        text-align: center; 
        font-size: 26px; 
        display: block;
        width: 100%;
        margin: 0 auto;
    }

    .calendar-controls {
        display: flex;
        justify-content: center; 
        gap: 10px; 
    }

    .btn-inicio { 
        padding: 5px 15px; 
        font-size: 14px; 
        border-radius: 10px;
        height: auto;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 15px; 
        bottom: 20;
    }

    .calendar-container {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        padding: 10px;
    }

    table {
        width: 95%; 
        max-width: 100%; 
        margin: 0 auto;
    }
}
    </style>
</head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<body>
<a href="index.php" class="btn-inicio">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg>
        Ir al inicio
    </a>
<h2>Calendario de Reservas</h2>
<div id="navegacionMes" style="display: flex; align-items: center; justify-content: center; gap: 10px; margin: auto; width: fit-content; background: rgba(0, 128, 0, 0.8); padding: 5px 10px; border-radius: 5px; white-space: nowrap;">
    <button id="prevMes" style="padding: 3px 6px; font-size: 12px; cursor: pointer; border: none; background: #00ff6a; color: black; border-radius: 4px;">◀</button>
    <span id="mesActual" style="color: white; font-weight: bold; font-size: 16px; white-space: nowrap;"></span>
    <button id="nextMes" style="padding: 3px 6px; font-size: 12px; cursor: pointer; border: none; background: #00ff6a; color: black; border-radius: 4px;">▶</button>
</div>
<!-- Contenedor del calendario -->
<div id="calendarioContainer">
    <?php include('generar_calendario.php'); ?>
</div>
<form id="reservaForm">
    <button type="button" class="cerrar-formulario">&times;</button>
    <h3 style="margin-top: 0; text-align: center; color: #333;">Registrar Reserva</h3>
    <div style="display: flex; flex-direction: column; gap: 10px;">
        <label for="responsable">Responsable:</label>
        <input type="text" name="responsable" autocomplete="off" required>
        <label for="area">Área:</label>
        <div style="position: relative;">
        <input type="text" name="area" id="area" autocomplete="off" required placeholder="Escriba su área">
        <div id="sugerencias" class="sugerencias"></div>
        </div>
        <label for="asunto">Asunto:</label>
        <input type="text" id="asunto" name="asunto"  autocomplete="off" required>
        <label for="lugar">Lugar:</label>
        <select name="lugar" id="lugar" required>
            <option value="">Seleccione un lugar</option>
            <option value="Salon de Actos">Salón de Actos</option>
            <option value="Sala de Regidores">Sala de Regidores</option>
            <option value="Auditorio Vaso de Leche">Auditorio Vaso de Leche</option>
        </select>
        <label for="fecha">Fecha:</label>
        <input type="date" name="fecha" id="fecha" required>
        <div style="display: flex; gap: 10px;">
            <div style="flex: 1;">
                <label for="hora_inicio">Inicio:</label>
                <input type="time" name="hora_inicio" id="hora_inicio" required>
            </div>
            <div style="flex: 1;">
                <label for="hora_fin">Fin:</label>
                <input type="time" name="hora_fin" id="hora_fin" required>
            </div>
        </div>
        <!-- Nueva Sección: ¿Necesita proyector? -->
        <div style="display: flex; align-items: center; gap: 10px;">
     <label for="necesita_proyector">¿Necesita proyector?</label>
        <div style="display: flex; align-items: center; gap: 5px;">
        <input type="radio" name="necesita_proyector" value="Si" id="proyector_si" required>
        <label for="proyector_si">Sí</label>
        <input type="radio" name="necesita_proyector" value="No" id="proyector_no">
        <label for="proyector_no">No</label>
    </div>
</div>
        <button type="submit" style="background-color: #28a745; color: white; font-size: 16px; border-radius: 5px;">Guardar Reserva</button>
        </div> 
    <div id="mensaje" style="margin-top: 10px; font-size: 14px; text-align: center;"></div>
</form>
    <script>
        document.addEventListener('click', function(event) {
    let celda = event.target.closest('td[data-fecha]');
    if (!celda) return;

    const fecha = celda.dataset.fecha;

    const formulario = document.getElementById('reservaForm');
    // ❌ Si el formulario ya está visible, evitamos abrir cualquier otro modal
    if (formulario.style.display === 'block') {
        return;
    }
    if (celda.classList.contains("reservado")) {
        Swal.fire({
            title: `La fecha ${formatoFecha(fecha)} ya tiene reservas`,
            text: "¿Deseas hacer una nueva reserva o ver las reservas existentes?",
            icon: "info",
            showConfirmButton: true,
            allowOutsideClick: false, 
            showCancelButton: true,
            confirmButtonText: "Nueva reserva",
            cancelButtonText: "Ver reservas"
            
        
        }).then((result) => {
            if (result.isConfirmed) {
                // ✅ Solo mostramos el formulario si el usuario elige "Nueva reserva"
                document.querySelector('#reservaForm').reset();
                document.getElementById('mensaje').innerText = '';
                document.querySelector('input[name="fecha"]').value = fecha;
                document.getElementById('reservaForm').style.display = 'block';
            } else {
                // ✅ Si elige ver reservas, llamamos a la función correspondiente
                verReservas(fecha);
            }
        });

        return; // ⛔ Evita que el código continúe ejecutándose
    }

    // ✅ Si la celda NO está reservada, mostramos directamente el formulario
    document.querySelector('#reservaForm').reset();
    document.getElementById('mensaje').innerText = '';
    document.querySelector('input[name="fecha"]').value = fecha;
    document.getElementById('reservaForm').style.display = 'block';
});
function formatoFecha(fecha) {
    const partes = fecha.split('-'); 
    return `${partes[2]}-${partes[1]}-${partes[0]}`; 
}

function verReservas(fecha) {
    fetch(`guardar_reserva.php?fecha=${fecha}`)
        .then(response => {
            if (!response.ok) {
                throw new Error(`Error HTTP: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            console.log("Datos recibidos:", data); // 🔍 Verifica la respuesta en la consola

            if (data.error) {
                Swal.fire("Reservas", "Error al obtener reservas o no hay reservas para esta fecha.", "info");
                return;
            }

            if (!data.reservas || data.reservas.length === 0) {
                Swal.fire("Reservas", "No hay reservas registradas para esta fecha.", "info");
                return;
            }

            // ✅ Construcción correcta del contenido
            let contenido = `
                <div style="text-align: left; font-size: 14px;">
                    ${data.reservas.map(reserva => `
                        <div style="border: 1px solid black; padding: 10px; margin-bottom: 10px; border-radius: 8px;">
                            <p><strong>👤 Responsable:</strong> ${reserva.responsable}</p>
                            <p><strong>🏢 Área:</strong> ${reserva.area}</p>
                            <p><strong>📌 Asunto:</strong> ${reserva.asunto}</p>
                            <p><strong>📍 Lugar:</strong> ${reserva.lugar}</p>
                            <p><strong>🕒 Hora:</strong> ${reserva.hora_inicio} - ${reserva.hora_fin}</p>
                            <p><strong>🎥 Proyector:</strong> ${reserva.necesita_proyector}</p>
                        </div>
                    `).join('')}
                </div>`;

            // ✅ Mostrar datos en Swal.fire()
            Swal.fire({
                title: `📅 Reservas para  ${formatoFecha(fecha)}`,
                html: contenido,
                icon: "info",
                showConfirmButton: true,
                allowOutsideClick: false, 
                width: 500, 
                confirmButtonText: "Cerrar",

            });
        })
        .catch(error => {
            console.error("Error en fetch:", error);
            Swal.fire("Error", "No se pudieron obtener las reservas. Intenta nuevamente.", "error");
        });
}

document.querySelector('.cerrar-formulario').addEventListener('click', function() {
    document.getElementById('reservaForm').style.display = 'none';
});

        document.getElementById('reservaForm').addEventListener('submit', function(event) {
    event.preventDefault();

    let fechaSeleccionada = new Date(document.getElementById('fecha').value);
    let hoy = new Date();
    hoy.setHours(0, 0, 0, 0); 

    if (fechaSeleccionada < hoy) {
        document.getElementById('mensaje').innerText = '❌ No se puede reservar fechas pasadas.';
        document.getElementById('mensaje').style.color = 'red';
        return; 
    }

    let formData = new FormData(this);

    fetch('guardar_reserva.php', {
    method: 'POST',
    body: formData
})
.then(response => response.json())  
.then(data => {
    let mensaje = document.getElementById('mensaje');
    mensaje.innerText = data.mensaje;
    mensaje.style.color = data.error ? 'red' : 'green';

    if (!data.error) {
        // Obtener los valores del formulario
        let responsable = document.querySelector('input[name="responsable"]').value;
        let area = document.getElementById('area').value;
        let asunto = document.getElementById('asunto').value;
        let lugar = document.getElementById('lugar').value;
        let fecha = document.getElementById('fecha').value;
        let hora_inicio = document.getElementById('hora_inicio').value;
        let hora_fin = document.getElementById('hora_fin').value;
        let proyectorSeleccionado = document.querySelector('input[name="necesita_proyector"]:checked');
        let necesita_proyector = proyectorSeleccionado ? proyectorSeleccionado.value : "No"; // Valor correcto

        // 🔹 Generar la URL para descargar el PDF
        let url = `descargar_reserva.php?responsable=${encodeURIComponent(responsable)}&area=${encodeURIComponent(area)}&asunto=${encodeURIComponent(asunto)}&lugar=${encodeURIComponent(lugar)}&fecha=${encodeURIComponent(fecha)}&hora_inicio=${encodeURIComponent(hora_inicio)}&hora_fin=${encodeURIComponent(hora_fin)}&necesita_proyector=${encodeURIComponent(necesita_proyector)}`;
        // 🔹 Redirigir automáticamente para descargar el PDF
        window.location.href = url;
        // 🔹 Agregar reserva al calendario si existe una celda para la fecha
        let celda = document.querySelector(`td[data-fecha="${fecha}"]`);
        if (celda) {
            celda.classList.add("reservado");
            let reservaInfo = document.createElement('div');
            reservaInfo.classList.add('info-reserva');
            reservaInfo.innerHTML = `
                👤 ${responsable} - 🏢 ${area}<br>
                📝 ${asunto} - 📍 ${lugar}<br>
                🕒 (${hora_inicio} - ${hora_fin}) - 📽️ ${necesita_proyector}<br>                 
            `;
            celda.appendChild(reservaInfo);
        }
        // 🔹 Cerrar el formulario después de 1 segundo
        setTimeout(() => {
            document.getElementById('reservaForm').style.display = 'none';
        }, 1000);
    }
})
.catch(error => console.error('❌ Error:', error));
});
document.addEventListener("DOMContentLoaded", function () {
    // Obtener el mes y el año actuales
    let hoy = new Date();
    let mes = hoy.getMonth() + 1; // Los meses en JavaScript van de 0 a 11
    let año = hoy.getFullYear();

    // Verificar si hay un mes y año guardados en el localStorage
    let ultimoMes = localStorage.getItem("ultimoMes");
    let ultimoAño = localStorage.getItem("ultimoAño");

    // Limpiar los valores guardados después de usarlos
    localStorage.removeItem("ultimoMes");
    localStorage.removeItem("ultimoAño");

    // Actualizar el mes y el año en la interfaz
    actualizarMesAño(mes, año);

    // Cargar el calendario
    cargarCalendario(mes, año);

    function actualizarMesAño(mes, año) {
        localStorage.setItem("mes", mes);
        localStorage.setItem("año", año);

        document.getElementById("prevMes").setAttribute("data-mes", mes);
        document.getElementById("prevMes").setAttribute("data-año", año);
        document.getElementById("nextMes").setAttribute("data-mes", mes);
        document.getElementById("nextMes").setAttribute("data-año", año);

        let mesTexto = new Intl.DateTimeFormat('es', { month: 'long' }).format(new Date(año, mes - 1));
        document.getElementById("mesActual").innerText = `${mesTexto.charAt(0).toUpperCase() + mesTexto.slice(1)} ${año}`;
    }

    function cargarCalendario(mes, año) {
        fetch(`generar_calendario.php?mes=${mes}&año=${año}`)
            .then(response => response.text())
            .then(data => {
                document.getElementById("calendarioContainer").innerHTML = data;
                asignarEventosCeldas();
            })
            .catch(error => console.error('Error al cargar el calendario:', error));
    }
    document.getElementById("prevMes").addEventListener("click", function() {
        mes = mes === 1 ? 12 : mes - 1;
        año = mes === 12 ? año - 1 : año;
        actualizarMesAño(mes, año);
        cargarCalendario(mes, año);
    });

    document.getElementById("nextMes").addEventListener("click", function() {
        mes = mes === 12 ? 1 : mes + 1;
        año = mes === 1 ? año + 1 : año;
        actualizarMesAño(mes, año);
        cargarCalendario(mes, año);
    });

    actualizarMesAño(mes, año);
    cargarCalendario(mes, año);
});
function obtenerMesActual() {
        const fechaActual = new Date();
        const mes = fechaActual.getMonth(); 
        const año = fechaActual.getFullYear(); 
        const nombresMeses = [
            'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
            'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
        ];
        return {
            mes: nombresMeses[mes],
            año: año,
            mesNumero: mes + 1  
        };
    }

    const { mes, año, mesNumero } = obtenerMesActual();
    document.getElementById('mesActual').textContent = `${mes} ${año}`;

    document.getElementById('prevMes').setAttribute('data-mes', mesNumero - 1);
    document.getElementById('prevMes').setAttribute('data-año', año);
    document.getElementById('nextMes').setAttribute('data-mes', mesNumero + 1);
    document.getElementById('nextMes').setAttribute('data-año', año);
    document.addEventListener("DOMContentLoaded", function () {
        const areaInput = document.getElementById("area");
        const sugerenciasDiv = document.getElementById("sugerencias");
        const areasDisponibles = [
    "ALCALDIA", "OFICINA DE TECNOLOGIA DE INFORMACION", "DEFENSA CIVIL", "REGISTRO CIVIL", "EJECUCION COACTIVA",
    "UNIDAD DE ARCHIVO CENTRAL", "SUB GERENCIA DE RECAUDACION", "SUB GERENCIA DE FISCALIZACION",
    "GERENTE DE RENTAS", "SUB GERENCIA DE COMERCIALIZACION", "SUB GERENTE DE MAPED",
    "SUB GERENCIA DE SEGURIDAD CIUDADANA", "SUB GERENCIA DE CONTROL PATRIMONIAL",
    "SUB GERENCIA DE EDUCACION, CULTURA Y DEPORTE", "SUB GERENCIA DE DEMUNA",
    "SUB GERENCIA DE MERCADO, CAMAL Y CEMENTERIO", "GERENCIA MUNICIPAL",
    "GERENCIA DE ADMINISTRACION", "SECRETARIA GENERAL", "SECRETARIA GENERAL - TRANSPARENCIA",
    "GERENCIA DE SERVICIOS PUBLICOS LOCALES", "GERENCIA DE DESARROLLO URBANO Y RURAL",
    "OFICINA DE ASESORIA JURIDICA", "OFICINA DE PRESUPUESTO, PLANEAMIENTO Y RACIONALIZACION",
    "SUB GERENCIA DE PROYECTOS AGROPECUARIOS", "PROGRAMA VASO DE LECHE",
    "SUB GERENCIA DE MEDIO AMBIENTE ECOLOGIA SANEAMIENTO", "CAJA",
    "OFICINA DE IMAGEN INSTITUCIONAL", "MESA DE PARTES", "ALMACEN",
    "SUB GERENCIA DE CATASTRO", "SUB GERENCIA DE PERSONAL",
    "ADMINISTRACION TECNICA MUNICIPAL - ATM", "SUB GERENCIA DE CONTABILIDAD",
    "SUB GERENCIA DE TESORERIA", "SUB GERENCIA DE ABASTECIMIENTO",
    "PROCURADOR", "SUB GERENTE DE TRANSPORTES", "SUB GERENCIA DE MAQUINARIA",
    "SUB GERENCIA DE PARTICIPACION VECINAL Y ORGANIZACIONES", "OFICINA DE REGIDORES",
    "GERENCIA DE DESARROLLO ECONOMICO", "GERENCIA DESARROLLO SOCIAL HUMANO",
    "RESERVA DE BIOSFERA", "COMITE CAS", "PROCESO ADMINISTRATIVO DISCIPLINARIO"
];
        areaInput.addEventListener("input", function () {
            let valor = areaInput.value.toLowerCase();
            sugerenciasDiv.innerHTML = "";
            
            if (valor.length > 0) {
                let filtrados = areasDisponibles.filter(area => area.toLowerCase().includes(valor));

                if (filtrados.length > 0) {
                    sugerenciasDiv.style.display = "block";
                    filtrados.forEach(area => {
                        let opcion = document.createElement("div");
                        opcion.textContent = area;
                        opcion.style.padding = "8px";
                        opcion.style.cursor = "pointer";
                        opcion.style.borderBottom = "1px solid #eee";

                        opcion.addEventListener("click", function () {
                            areaInput.value = area;
                            sugerenciasDiv.style.display = "none";
                        });

                        sugerenciasDiv.appendChild(opcion);
                    });
                } else {
                    sugerenciasDiv.style.display = "none";
                }
            } else {
                sugerenciasDiv.style.display = "none";
            }
        });

        document.addEventListener("click", function (e) {
            if (!areaInput.contains(e.target) && !sugerenciasDiv.contains(e.target)) {
                sugerenciasDiv.style.display = "none";
            }
        });
    });
    document.addEventListener("DOMContentLoaded", function () {
    let formulario = document.getElementById("reservaForm");
    let isDragging = false;
    let startX, startY, initialX, initialY;

    formulario.addEventListener("mousedown", function (e) {
        isDragging = true;
        startX = e.clientX;
        startY = e.clientY;
        initialX = formulario.offsetLeft;
        initialY = formulario.offsetTop;
        formulario.style.cursor = "grabbing";
    });

    document.addEventListener("mousemove", function (e) {
        if (isDragging) {
            let dx = e.clientX - startX;
            let dy = e.clientY - startY;
            formulario.style.left = initialX + dx + "px";
            formulario.style.top = initialY + dy + "px";
        }
    });
    document.addEventListener("mouseup", function () {
        isDragging = false;
        formulario.style.cursor = "grab";
    });
});
    </script>
   
</div>
</body>
</html>