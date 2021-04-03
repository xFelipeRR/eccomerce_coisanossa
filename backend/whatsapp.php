<?php
session_start();
if(null !== $_POST['person_name'] && null !== $_POST['adress']){
    $_SESSION['person_name'] = $_POST['person_name'];
    $_SESSION['adress'] = $_POST['adress'];
}
echo $_SESSION['person_name'];
$resultado = '';
$produtos = '';

$person_name = $_POST["person_name"];
$adress = $_POST["adress"];

if(isset($_POST['insere'])){
    echo 'Pode inserir os dados'.'<br>';
}
else{
    echo 'Não insira, sem POST'.'<br>';
}


$myProducts = '';
if(isset($_SESSION['array'])){
    foreach($_SESSION['array'] as $key=>$value){
        $myProducts .= $value.',';
    }
    
    $resultado = substr($myProducts,0,-1);

    if($resultado == ''){
        echo 'Seu carrinho está vazio!';
        $cHtml = '';
    }

    $conn = mysqli_connect("localhost","root","", "testes");

        $query = "SELECT * FROM PRODUTOS WHERE ID IN (".$resultado.")";
        $result = $conn->query($query);
        $cHtml = '';
        $nome_produto = '';
        $quant = '';
        $i = 0;
    while($row = $result->fetch_array()){
        $i += 1;

        $id = $row["ID"];
        $nome_produto .= $row["NOME_PRODUTO"].',';
        $valor = $row["VALOR"];

        if(isset($_SESSION['array_quant'][$i]))
            $quant = $_SESSION['array_quant'][$i];
        }

    $produtos = substr($nome_produto,0,-1);

    }
    echo $resultado;
    echo $produtos;


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
<style>
    .div{
        background: green;
        width: 200px;
        font-size: 13pt;
        height: 35px;
        border-radius: 5px;
    }
    .button{
        padding-top: 7px;
        text-decoration: none;
        display: flex;
        margin-top: auto;
        justify-content: center;

        color: black;
    }
</style>
<body>
<form action="insert_pdf.php" method="post">
    <input type="text" name="myid" hidden value=<?php echo $resultado?>>

    <input type="text" name="person_name" hidden value=<?php echo $person_name?>>
    <input type="text" name="adress" hidden value=<?php echo $adress?>>
    <input type="text" name="quant" hidden value=<?php echo $quant?>>

    <button type="submit">Terminar</button>
</form>

<script>
    if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
    }
</script>
</body>
</html>