<?php
    require('../../fpdf/fpdf.php');
    $pdf = new FPDF();
    $pdf->AddPage();

    $pass = $_GET['pass'];

    $conn = mysqli_connect("localhost","root","", "testes");

// Check connection
if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
}

    $query = "SELECT * FROM VENDAS WHERE PASS = '$pass'";
    $result = $conn->query($query);
    $cHtml = '';
    $nome_produto = '';

while($row = $result->fetch_array()){
    $nome_produto = $row["NOME"].',';
    $pedido = $row["PEDIDO"];

    $pdf->SetFont('Arial','B',16);
    
    $pdf->Cell(15,5,'Item:');
    $pdf->Cell(15,5,$pedido);
    $pdf->Ln(10);
}
$pdf->Cell(40,5,'Cliente: '.$nome_produto);

    
    $pdf->Output();
?>