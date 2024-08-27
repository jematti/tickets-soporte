<?php
ob_start(); // Iniciar el buffer de salida

require('../fpdf/fpdf.php');
include("dbconnection.php"); // Incluir la conexión a la base de datos

// Función para obtener datos de tickets
function obtenerTickets($con, $ini, $fin) {
    $sql = "SELECT t.id, t.email_id, t.subject, t.task_type, t.priority, t.status, t.posting_date, t.admin_remark_date, u.name as user_name
            FROM ticket t 
            JOIN user u ON t.email_id = u.email 
            WHERE t.posting_date BETWEEN '$ini' AND '$fin'";
    $result = mysqli_query($con, $sql);
    
    if (!$result) {
        die("Error en la consulta de tickets: " . mysqli_error($con));
    }
    
    return $result;
}

// Función para obtener datos de solicitudes de servicio
function obtenerServicios($con, $ini, $fin) {
    $sql = "SELECT id, name, email, contactno, company, services, query, status, posting_date, remark
            FROM prequest 
            WHERE posting_date BETWEEN '$ini' AND '$fin'";
    $result = mysqli_query($con, $sql);
    
    if (!$result) {
        die("Error en la consulta de servicios: " . mysqli_error($con));
    }
    
    return $result;
}

// Función para obtener datos combinados de tickets y solicitudes de servicio
function obtenerTodos($con, $ini, $fin) {
    // Consulta de tickets
    $sql_tickets = "SELECT t.id, t.email_id, t.subject, t.task_type, t.priority, t.status, t.posting_date, t.admin_remark_date, u.name as user_name
                    FROM ticket t 
                    JOIN user u ON t.email_id = u.email 
                    WHERE t.posting_date BETWEEN '$ini' AND '$fin'";
    $result_tickets = mysqli_query($con, $sql_tickets);
    
    if (!$result_tickets) {
        die("Error en la consulta de tickets: " . mysqli_error($con));
    }
    
    // Consulta de servicios
    $sql_servicios = "SELECT id, name, email, contactno, company, services, query, status, posting_date, remark
                      FROM prequest 
                      WHERE posting_date BETWEEN '$ini' AND '$fin'";
    $result_servicios = mysqli_query($con, $sql_servicios);
    
    if (!$result_servicios) {
        die("Error en la consulta de servicios: " . mysqli_error($con));
    }
    
    // Combinar resultados de tickets y servicios
    $todos = array();
    
    while ($row_tickets = mysqli_fetch_assoc($result_tickets)) {
        $todos[] = $row_tickets;
    }
    
    while ($row_servicios = mysqli_fetch_assoc($result_servicios)) {
        $todos[] = $row_servicios;
    }
    
    return $todos;
}

// Verificar la conexión
if (!$con) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Obtener las fechas de inicio y fin del formulario
$ini = $_POST['ini_fecha'];
$fin = $_POST['fin_fecha'];
$categoria = $_POST['categoria_reporte'];

// Verificar categoría seleccionada y obtener datos correspondientes
if ($categoria == 'tickets') {
    $result = obtenerTickets($con, $ini, $fin);
    $num_results = mysqli_num_rows($result);
} elseif ($categoria == 'servicios') {
    $result = obtenerServicios($con, $ini, $fin);
    $num_results = mysqli_num_rows($result);
} elseif ($categoria == 'todos') {
    $result = obtenerTodos($con, $ini, $fin);
    $num_results = count($result);
} else {
    die("Categoría de reporte no válida.");
}

// Crear el PDF
$pdf = new FPDF();
$pdf->AddPage();

// Encabezado y contenido del PDF
$pdf->SetFont('Arial', 'B', 12);
$pdf->Image('../assets/img/admin1.jpeg', 10, 10, 30);
$pdf->Cell(0, 10, 'Fundacion Cultural del Banco Central de Bolivia', 0, 1, 'C');
$pdf->Cell(0, 10, 'Reporte de Tickets y Servicios', 0, 1, 'C');
$pdf->Cell(0, 10, 'Desde: ' . $ini . ' Hasta: ' . $fin, 0, 1, 'C');
$pdf->Ln(10);

$pdf->SetFont('Arial', '', 12);

// Si es 'todos', mostrar un mensaje informativo
if ($categoria == 'todos') {
    $pdf->Cell(0, 10, 'Reporte combinado de Tickets y Servicios:', 0, 1);
} else {
    $pdf->Cell(0, 10, 'Reporte de ' . ucfirst($categoria) . ':', 0, 1);
}
$pdf->Ln(10);

// Función para agregar encabezado de la tabla
function agregarEncabezado($pdf) {
    $pdf->Cell(10, 10, '#', 1);
    $pdf->Cell(50, 10, 'Usuario', 1);
    $pdf->Cell(50, 10, 'Fecha de Solicitud', 1);
    $pdf->Cell(50, 10, 'Fecha de Atención', 1);
    $pdf->Cell(30, 10, 'Estado', 1);
    $pdf->Ln();
}

// Mostrar los datos en el PDF según la categoría seleccionada
if ($num_results == 0) {
    $pdf->Cell(0, 10, 'No se encontraron resultados para la categoría seleccionada.', 0, 1, 'C');
} else {
    if ($categoria == 'todos') {
        // Separar en dos tablas, una para tickets y otra para servicios
        $tickets_encontrados = false;
        $servicios_encontrados = false;

        foreach ($result as $row) {
            if (isset($row['email_id'])) { // Es un ticket
                if (!$tickets_encontrados) {
                    $pdf->Cell(0, 10, 'Tickets:', 0, 1, 'L');
                    agregarEncabezado($pdf);
                    $tickets_encontrados = true;
                }
                $pdf->Cell(10, 10, $row['id'], 1);
                $pdf->Cell(50, 10, $row['user_name'], 1);
                $pdf->Cell(50, 10, $row['posting_date'], 1);
                $pdf->Cell(50, 10, $row['admin_remark_date'], 1);
                $pdf->Cell(30, 10, $row['status'], 1);
                $pdf->Ln();
            } elseif (isset($row['name'])) { // Es un servicio
                if (!$servicios_encontrados) {
                    $pdf->Ln(10); // Espacio entre las dos tablas
                    $pdf->Cell(0, 10, 'Servicios:', 0, 1, 'L');
                    agregarEncabezado($pdf);
                    $servicios_encontrados = true;
                }
                $pdf->Cell(10, 10, $row['id'], 1);
                $pdf->Cell(50, 10, $row['name'], 1);
                $pdf->Cell(50, 10, $row['posting_date'], 1);
                $pdf->Cell(50, 10, $row['remark'], 1);
                $pdf->Cell(30, 10, $row['status'], 1);
                $pdf->Ln();
            }
        }
    } else {
        // Tabla única para tickets o servicios según la categoría seleccionada
        agregarEncabezado($pdf);
        while ($row = mysqli_fetch_assoc($result)) {
            $pdf->Cell(10, 10, $row['id'], 1);
            $pdf->Cell(50, 10, isset($row['user_name']) ? $row['user_name'] : $row['name'], 1);
            $pdf->Cell(50, 10, isset($row['posting_date']) ? $row['posting_date'] : '', 1);
            $pdf->Cell(50, 10, isset($row['admin_remark_date']) ? $row['admin_remark_date'] : $row['remark'], 1);
            $pdf->Cell(30, 10, isset($row['status']) ? $row['status'] : '', 1);
            $pdf->Ln();
        }
    }
}

// Finalizar y enviar el PDF al navegador
$pdf_content = ob_get_clean(); // Capturar el contenido del buffer
$pdf->Output(); // Enviar el PDF al navegador
exit(); // Terminar la ejecución del script

?>
