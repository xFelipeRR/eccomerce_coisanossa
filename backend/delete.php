<?php

    session_start();
    $id = $_GET['myid'];
    $alert = '';

    if(isset($_SESSION['carrinho'][$id]))
    {
        $id = intval($_GET['myid']);
    }        
        if(isset($_SESSION['carrinho'][$id]))
        {
            unset($_SESSION['carrinho'][$id]);
            unset($_SESSION['quant'][$id]);
            $alert = '<script>alert("Item '.$id.' excluído do carrinho")</script>';
            header("Refresh: 0; url = carrinho.php");
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
    <?php echo $alert;?>

    <script>
        if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
        }
    </script>
    
</body>
</html>