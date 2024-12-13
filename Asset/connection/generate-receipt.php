<?php
require('../../Pages/user/libs/fpdf.php');

class Receipt extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'RECEIPT', 0, 1, 'C');
        $this->Ln(5);
    }

    function Body($date, $time, $selectedSeats, $totalCost)
    {
        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 10, 'Royale Cinema', 0, 1, 'C');
        $this->Cell(0, 10, '143 Royale Street, North Caloocan City', 0, 1, 'C');
        $this->Ln(10);

        $this->Cell(50, 10, 'Cinema Name:', 0, 0);
        $this->Cell(0, 10, 'Royale Cinema', 0, 1);
        $this->Cell(50, 10, 'Cinema Room:', 0, 0);
        $this->Cell(0, 10, '1', 0, 1);
        $this->Cell(50, 10, 'Booked on:', 0, 0);
        $this->Cell(0, 10, $date . ' ' . date('g:i A', strtotime($time)), 0, 1);
        $this->Cell(50, 10, 'Screening Date:', 0, 0);
        $this->Cell(0, 10, $date, 0, 1);
        $this->Cell(50, 10, 'Movie Title:', 0, 0);
        $this->Cell(0, 10, 'Deadpool and Wolverine', 0, 1);
        $this->Cell(50, 10, 'Showtime:', 0, 0);
        $this->Cell(0, 10, '7:00 PM', 0, 1);
        $this->Cell(50, 10, 'Seats:', 0, 0);
        $this->Cell(0, 10, implode(', ', $selectedSeats), 0, 1);
        $this->Cell(50, 10, 'Price:', 0, 0);
        $this->Cell(0, 10, 'P440.00 x ' . count($selectedSeats), 0, 1);
        $this->Ln(10);

        $this->Cell(50, 10, 'Total:', 0, 0);
        $this->Cell(0, 10, 'P' . number_format($totalCost, 2), 0, 1, 'R');
        $this->Ln(10);

        $this->Cell(0, 10, 'Payment Method: Credit Card', 0, 1);
        $this->Ln(10);

        $this->Cell(0, 10, 'Thank you for choosing Royale Cinema!', 0, 1, 'C');
        $this->Cell(0, 10, 'Enjoy the movie!', 0, 1, 'C');
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

// Get the details from the basket
$date = $_POST['date'];
$time = $_POST['time'];
$selectedSeats = $_POST['selectedSeats'];
$totalCost = $_POST['totalCost'];

$pdf = new Receipt();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Body($date, $time, $selectedSeats, $totalCost);
$pdf->Output();
?>