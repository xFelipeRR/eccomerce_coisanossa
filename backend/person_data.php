<?php
session_start();
$qtds = '';
foreach($_SESSION['array_quant'] as $key=>$value){
    $qtds .= $value.',';
}
$quant = substr($qtds,0,-1);

echo $quant;
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
<form action="whatsapp.php" method="post">
    <label for="person_name">Nome Completo:</label>
        <input type="text" name="person_name">
    <label for="adress">Endereço:</label>
        <input type="text" name="adress">

    <input type='number' hidden name='insere' value=1>

        <input type="submit" value="1">
</form>

<script>
    if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
    }
</script>
</body>
</html>