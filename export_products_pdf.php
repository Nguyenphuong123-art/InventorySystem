<?php
require_once('includes/load.php');
require_once('fpdf/fpdf.php');

// Get products data from MySQL
$sql = "SELECT p.id, p.name, p.quantity, p.location, p.specification, p.recipient, c.name AS category_name, p.date
        FROM products p
        INNER JOIN categories c ON c.id = p.categorie_id";
$result = $db->query($sql);
$products = $result->fetch_all(MYSQLI_ASSOC);

// Create PDF
$pdf = new FPDF();
$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 12);

// Set table header
$pdf->Cell(10, 10, '#', 1);
$pdf->Cell(40, 10, 'Product Name', 1);
$pdf->Cell(30, 10, 'Category', 1);
$pdf->Cell(30, 10, 'Quantity', 1);
$pdf->Cell(30, 10, 'Location', 1);
$pdf->Cell(40, 10, 'Specification', 1);
$pdf->Cell(30, 10, 'Recipient', 1);
$pdf->Cell(30, 10, 'Date Added', 1);
$pdf->Ln();

$pdf->SetFont('Arial', '', 12);

// Set table data
foreach ($products as $key => $product) {
  $pdf->Cell(10, 10, $key + 1, 1);
  $pdf->Cell(40, 10, remove_junk($product['name']), 1);
  $pdf->Cell(30, 10, remove_junk($product['category_name']), 1);
  $pdf->Cell(30, 10, remove_junk($product['quantity']), 1);
  $pdf->Cell(30, 10, remove_junk($product['location']), 1);
  $pdf->Cell(40, 10, remove_junk($product['specification']), 1);
  $pdf->Cell(30, 10, remove_junk($product['recipient']), 1);
  $pdf->Cell(30, 10, read_date($product['date']), 1);
  $pdf->Ln();
}

// Output PDF
$pdf->Output('products_report.pdf', 'D');
?>
