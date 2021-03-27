<?php
    session_start();
    $SESSION['array_id'] = [0];
    $arr_id = array_push($SESSION['array_id'],$_POST['myid']);

    //array_push($arr_id,$_POST['myid']);
    
   // $arr_id = array($_POST['myid']);
    $SESSION['id'] = $SESSION['array_id'];

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
    <?php
        foreach($SESSION["id"] as $key=>$value) {
            echo "The value of this particular session is: ".$key." - val: ".$value."<br>";
        }
    ?>
</body>
</html>