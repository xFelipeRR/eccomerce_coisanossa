<?php
$conn = mysqli_connect("localhost","root","", "testes");

$query = "SELECT * FROM PRODUTOS";
$result = $conn->query($query);
$cHtml = '';
while($row = $result->fetch_array()){
    $id = $row["ID"];
    $nome_produto = $row["NOME_PRODUTO"];
    $valor = $row["VALOR"];

    $cHtml .= "
    <form action='/development/coisanossa/backend/individual.php' method='post'>
        <div class='product-container'>
            <input type='text' name='myid' value='$id' readonly=“true”>
            <div class='name' name='nome'>$nome_produto</div>
            <div class='valor' name='valor'>$valor</div>
        </div>
        <input type='submit' value='POST'>
    </form>
    ";
}
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste Banco de dados</title>
</head>
<body>
<style>
    .product-container{
        background: red;
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

<?php echo $cHtml?>
</body>
</html>
