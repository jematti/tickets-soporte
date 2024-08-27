<?php
require('../fpdf/fpdf.php');

class PDF extends FPDF
{
    function Header()
    {
        //$this->Image('images/logo.jpg',5,5,30);    
        
        $this->SetXY(40,10);
        $this->SetFont('Arial','B',14);
        $this->Cell(120,10,'SISTEMA DE GESTION DE TICKETS',0,1,'L');
        $this->SetXY(40,15);
        $this->SetFont('Arial','I',8);
        date_default_timezone_set('America/La_Paz');
        $this->Cell(120,10,date('Y-m-d H:i:s'),0,1,'L');
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}
?>
