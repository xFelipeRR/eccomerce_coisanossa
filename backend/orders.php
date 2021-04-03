<?php
$conn = mysqli_connect("localhost","root","", "testes");

// Check connection
if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT * FROM PEDIDOS";
$result = $conn->query($query);
$cHtml = '';
$nome = '';

while($row = $result->fetch_array()){
    $id = $row["ID"];
    $nome_cliente = $row["NOME"];
    $adress = $row["ENDERECO"];
    $pass = $row["PASS"];

    $cHtml .= "
    <form action='/development/coisanossa/backend/impressao_pedido.php?pass=$pass' method='post'>
        <div class='product-container'>
            <input type='text' name='myid' value='$id' readonly=“true”>
            <div class='name' name='nome'>$nome_cliente</div>
            <div class='valor' name='adress'>$adress</div>

            <input type='text' hidden name='pass' value='$pass' readonly=“true”>
        </div>
        <input type='submit' value='Verificar pedido'>
    </form>
    <br>
    <hr>
    ";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php echo $cHtml;?>
</body>
</html>