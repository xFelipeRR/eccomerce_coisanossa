<?php 
$conn = mysqli_connect("localhost","root","", "testes");

$query = "
    SELECT * FROM PRODUTOS
    WHERE ID = ".$_POST["myid"]."
    ";
$result = $conn->query($query);
$cHtml = '';
while($row = $result->fetch_array()){
    $id = $row["ID"];
    $nome_produto = $row["NOME_PRODUTO"];
    $valor = $row["VALOR"];
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
<style>
    .product-container{
        background: gray;
        margin-bottom: 10px;
        width: 10%;
    }
    .id{
        background: black;
        color: white;
    }
    .name{
        background: gray;
        
    }
</style>

<form action="/development/coisanossa/backend/carrinho.php" method="POST">
    <div class='product-container'>
        <label for="id">Código do Produto:</label>
        <input type="number" name="myid" value='<?php echo $id?>' readonly=“true”>
        <div class='name'>PRODUTO: <?php echo $nome_produto?> <br>VALOR: <?php echo $valor?></div>
        <input type="submit" value="Adicionar ao carrinho de compras">
    </div>
</form>

</body>
</html>