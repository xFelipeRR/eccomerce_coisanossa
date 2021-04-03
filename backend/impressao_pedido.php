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

    $query = "
    SELECT 
        VEN.*,
        PED.NOME
    FROM VENDAS VEN
    LEFT OUTER JOIN PEDIDOS PED ON (VEN.PASS = PED.PASS)
    WHERE VEN.PASS = '$pass'
    
    ";
    $result = $conn->query($query);
    $cHtml = '';
    $nome_produto = '';

while($row = $result->fetch_array()){
    $nome = $row["NOME"].',';
    $pedido = $row["PEDIDO"];
    $qtd = $row["QUANTIDADE"];

    $pdf->SetFont('Arial','B',16);
    
    $pdf->Cell(15,5,'Item:');
    $pdf->Cell(15,5,$pedido);
    $pdf->SetX(55);
    $pdf->Cell(15,5,'Unidades:',0,0);
    $pdf->SetX(85);
    $pdf->Cell(25,5,$qtd,0,0);
    $pdf->Ln(10);
}
$pdf->Cell(40,5,'Cliente: '.$nome);

    
    $pdf->Output();
?>