<?php
session_start();
echo $_SESSION['person_name'];
$myProducts = '';
$produto_whats = '';
$pass = '';
// Create connection
$conn = mysqli_connect("localhost","root","", "testes");
// Check connection
if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
}
 
echo "Redirecionando...";

if(isset($_SESSION['array'])){
    foreach($_SESSION['array'] as $key=>$value){
        $myProducts .= $value.',';
    }
    
    $resultado = substr($myProducts,0,-1);

    $query = "SELECT * FROM PRODUTOS WHERE ID IN (".$resultado.")";
    $result = $conn->query($query);
    $cHtml = '';
    $nome_produto = '';
    for ($x = 1; $x <= 1; $x++) 
    {
        $pass = bin2hex(random_bytes(3)); // gera uma string pseudo-randômica criptograficamente segura de 6 caracteres
    } 
    $queryPed = "INSERT INTO PEDIDOS (nome,endereco,pass) VALUES ('{$_SESSION['person_name']}','{$_SESSION['adress']}','$pass')";
    $resultPed = $conn->query($queryPed);
    $i = -1;
    while($row = $result->fetch_array()){
        $i += 1;
        $id = $row["ID"];
        $nome_produto = $row["NOME_PRODUTO"];
        $produto_whats .= $row["NOME_PRODUTO"].',';
        $valor = $row["VALOR"];

        if(isset($_SESSION['array_quant'][$i])){
            $quant = $_SESSION['array_quant'][$i];
        }


        // OBS: para usar sessions no select assim é preciso colocar entre aspas simples e colchetes
        //$sql = "INSERT INTO VENDAS (nome,cidade,pedido,pass) VALUES ('{$_SESSION['person_name']}','{$_SESSION['adress']}','$nome_produto','$pass')";
        $sql = "INSERT INTO VENDAS (pedido,quantidade,pass) VALUES ('$nome_produto','$quant','$pass')";
        if (mysqli_query($conn, $sql)) {
            $produtos = substr($produto_whats,0,-1);
            $fpdf = "<script>window.open('impressao_pedido.php?pass=$pass', '_blank');</script>";
            header("Refresh: 2; url = https://api.whatsapp.com/send?1=pt_BR&phone=55(85)996262259&text=Tenho interesse nos produtos com ID $produtos");
            //header("Refresh: 0; url = impressao_pedido.php?pass=$pass");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}
session_destroy();
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
    <?php echo $fpdf;?>
</body>
</html>
