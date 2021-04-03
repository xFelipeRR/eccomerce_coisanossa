<?php
session_start();

$conn = mysqli_connect("localhost","root","", "testes");

$query = "SELECT COUNT(*) AS TOT_PRODUTOS FROM PRODUTOS";
$result = $conn->query($query);
$cHtml = '';
while($row = $result->fetch_array()){
    $tot_produtos = $row['TOT_PRODUTOS'];
}

    $_SESSION['array'] = [];
    $_SESSION['array_quant'] = [];
    $qtds = '';
    $pedido_submit = '';
    $count_session = $tot_produtos;

    if($_POST <> Array()){ // Se não tiver falor no POST ele retorna Array, então não mostre os erros
        if(isset($_SESSION['carrinho'][$_POST['myid']]) && isset($_SESSION['quant'][$_POST['myid']])){
            $_SESSION['carrinho'][$_POST['myid']];
            echo 'Você já adicionou esse item <br>';
            //$count_session += 10;
            if($_SESSION['quant'][$_POST['myid']] <> $_SESSION['quant'][$_POST['myid']] = $_POST['quant']){
                $_SESSION['quant'][$_POST['myid']] = $_POST['quant'];
                // SE A QUANTIDADE JÁ GRAVADA FOR DIFERENTE DA NOVA ADIÇÃO, SUBSTITUA
            }
           
        }
        else{
            $_SESSION['carrinho'][$_POST['myid']] = $_POST['myid'];
            $_SESSION['quant'][$_POST['myid']] = $_POST['quant'];
            //$count_session += 10;
        }
    }
    
    
    $i = 0;
    //echo $count_session;
    while($i <= $count_session){
        $i += 1;
        if(isset($_SESSION['carrinho'][$i])){
            array_push($_SESSION['array'],$_SESSION['carrinho'][$i]);
            array_push($_SESSION['array_quant'],$_SESSION['quant'][$i]);
        }
        else{
            $nExiste = 'Não existe';
        }
    }

$myProducts = '';

foreach($_SESSION['array'] as $key=>$value){
    $myProducts .= $value.',';
}
foreach($_SESSION['array_quant'] as $key=>$value){
    $qtds .= $value.',';
}
$resultado = substr($myProducts,0,-1);
$quant = substr($qtds,0,-1);
if($resultado == ''){
    echo 'Seu carrinho está vazio!';
    $cHtml = '';
    $pedido_submit = "";
}
else{
    $conn = mysqli_connect("localhost","root","", "testes");

    $query = "SELECT * FROM PRODUTOS WHERE ID IN (".$resultado.")";
    $result = $conn->query($query);
    $cHtml = '';
    $pedido_submit = "
    <form action='/development/coisanossa/backend/person_data.php' method='post'>
    <input type='number' hidden name='insere' value=1>
        <button type='submit'>Finalizar Compra</button>
    </form>";

    while($row = $result->fetch_array()){
        $id = $row["ID"];
        $nome_produto = $row["NOME_PRODUTO"];
        $valor = $row["VALOR"];

        $cHtml .= "
        <form action='/development/coisanossa/backend/delete.php' method='get'>
            <div class='product-container'>
                <input type='text' name='myid' value='$id' readonly=“true”>
                <div class='name' name='nome'>$nome_produto</div>
                <div class='valor' name='valor'>$valor</div>
                <button type='submit'>Excluir</button>
            </div>
        </form> 
        <hr>
        ";
    }

}
    
    //session_destroy();
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
    .quant{
        width: 50px;
        margin-bottom: 5px;
    }
</style>
    <?php
        echo $cHtml;
        echo $pedido_submit;
    ?>

    <script>
        if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
        }
    </script>
</body>
</html>