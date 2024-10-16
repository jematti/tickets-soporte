<?php
ob_start(); // Iniciar el buffer de salida

require('../fpdf/fpdf.php');
include("dbconnection.php"); // Incluir la conexión a la base de datos

// Función para obtener datos de tickets según el estado
function obtenerTickets($con, $ini, $fin, $estado) {
    $sql = "SELECT t.id, t.email_id, t.subject, t.task_type, t.priority, t.status, t.posting_date, t.admin_remark_date, u.name as user_name
            FROM ticket t 
            JOIN user u ON t.email_id = u.email 
            WHERE t.posting_date BETWEEN '$ini' AND '$fin'";
    
    // Agregar filtro de estado si no se selecciona "all"
    if ($estado != 'all') {
        $sql .= " AND t.status = '$estado'";
    }
    
    $result = mysqli_query($con, $sql);
    
    if (!$result) {
        die("Error en la consulta de tickets: " . mysqli_error($con));
    }
    
    return $result;
}

// Función para obtener estadísticas de tickets
function obtenerEstadisticas($con, $ini, $fin) {
    // Número total de usuarios únicos
    $sqlUsuarios = "SELECT COUNT(DISTINCT email_id) as total_usuarios 
                    FROM ticket 
                    WHERE posting_date BETWEEN '$ini' AND '$fin'";
    $resultUsuarios = mysqli_query($con, $sqlUsuarios);
    $totalUsuarios = mysqli_fetch_assoc($resultUsuarios)['total_usuarios'];

    // Número total de tickets
    $sqlTotalTickets = "SELECT COUNT(*) as total_tickets 
                        FROM ticket 
                        WHERE posting_date BETWEEN '$ini' AND '$fin'";
    $resultTotalTickets = mysqli_query($con, $sqlTotalTickets);
    $totalTickets = mysqli_fetch_assoc($resultTotalTickets)['total_tickets'];

    // Número de tickets abiertos
    $sqlTicketsAbiertos = "SELECT COUNT(*) as tickets_abiertos 
                           FROM ticket 
                           WHERE status = 'open' 
                           AND posting_date BETWEEN '$ini' AND '$fin'";
    $resultTicketsAbiertos = mysqli_query($con, $sqlTicketsAbiertos);
    $ticketsAbiertos = mysqli_fetch_assoc($resultTicketsAbiertos)['tickets_abiertos'];

    // Número de tickets cerrados
    $sqlTicketsCerrados = "SELECT COUNT(*) as tickets_cerrados 
                           FROM ticket 
                           WHERE status = 'closed' 
                           AND posting_date BETWEEN '$ini' AND '$fin'";
    $resultTicketsCerrados = mysqli_query($con, $sqlTicketsCerrados);
    $ticketsCerrados = mysqli_fetch_assoc($resultTicketsCerrados)['tickets_cerrados'];

    return [
        'total_usuarios' => $totalUsuarios,
        'total_tickets' => $totalTickets,
        'tickets_abiertos' => $ticketsAbiertos,
        'tickets_cerrados' => $ticketsCerrados
    ];
}

// Verificar la conexión
if (!$con) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Obtener las fechas de inicio, fin y el estado del formulario
$ini = $_POST['ini_fecha'];
$fin = $_POST['fin_fecha'];
$estado = $_POST['estado_ticket'];

// Obtener datos de tickets según el estado seleccionado
$result = obtenerTickets($con, $ini, $fin, $estado);
$num_results = mysqli_num_rows($result);

// Obtener estadísticas de tickets
$estadisticas = obtenerEstadisticas($con, $ini, $fin);

// Crear el PDF
$pdf = new FPDF();
$pdf->AddPage();

// Encabezado y contenido del PDF
$pdf->SetFont('Arial', 'B', 11);
$pdf->Image('../assets/img/admin1.jpeg', 10, 10, 30);
$pdf->Cell(0, 10, 'Fundacion Cultural del Banco Central de Bolivia', 0, 1, 'C');
$pdf->Cell(0, 10, 'Reporte de Tickets', 0, 1, 'C');
$pdf->Cell(0, 10, 'Desde: ' . $ini . ' Hasta: ' . $fin, 0, 1, 'C');
$pdf->Ln(10);

$pdf->SetFont('Arial', '', 11);

// Mostrar estadísticas de tickets en una fila
$pdf->Cell(50, 10, 'Total de Usuarios: ' . $estadisticas['total_usuarios'], 0, 0, 'L');
$pdf->Cell(50, 10, 'Total de Tickets: ' . $estadisticas['total_tickets'], 0, 0, 'L');
$pdf->Cell(50, 10, 'Tickets Abiertos: ' . $estadisticas['tickets_abiertos'], 0, 0, 'L');
$pdf->Cell(50, 10, 'Tickets Cerrados: ' . $estadisticas['tickets_cerrados'], 0, 1, 'L');
$pdf->Ln(10);

// Alternativamente, para mostrar las estadísticas en dos filas
/*
$pdf->Cell(0, 10, 'Total de Usuarios: ' . $estadisticas['total_usuarios'], 0, 1, 'L');
$pdf->Cell(0, 10, 'Total de Tickets: ' . $estadisticas['total_tickets'], 0, 1, 'L');
$pdf->Cell(0, 10, 'Tickets Abiertos: ' . $estadisticas['tickets_abiertos'], 0, 1, 'L');
$pdf->Cell(0, 10, 'Tickets Cerrados: ' . $estadisticas['tickets_cerrados'], 0, 1, 'L');
$pdf->Ln(10);
*/

// Función para agregar encabezado de la tabla
function agregarEncabezado($pdf) {
    $pdf->Cell(10, 10, '#', 1);
    $pdf->Cell(50, 10, 'Usuario', 1);
    $pdf->Cell(50, 10, 'Fecha de Solicitud', 1);
    $pdf->Cell(50, 10, 'Fecha de Atencion', 1);
    $pdf->Cell(30, 10, 'Estado', 1);
    $pdf->Ln();
}

// Mostrar los datos en el PDF
if ($num_results == 0) {
    $pdf->Cell(0, 10, 'No se encontraron resultados para el estado seleccionado.', 0, 1, 'C');
} else {
    agregarEncabezado($pdf);
    while ($row = mysqli_fetch_assoc($result)) {
        $pdf->Cell(10, 10, $row['id'], 1);
        $pdf->Cell(50, 10, $row['user_name'], 1);
        $pdf->Cell(50, 10, $row['posting_date'], 1);
        $pdf->Cell(50, 10, $row['admin_remark_date'], 1);
        $pdf->Cell(30, 10, $row['status'], 1);
        $pdf->Ln();
    }
}

// Finalizar y enviar el PDF al navegador
$pdf_content = ob_get_clean(); // Capturar el contenido del buffer
$pdf->Output(); // Enviar el PDF al navegador
exit(); // Terminar la ejecución del script
?>
