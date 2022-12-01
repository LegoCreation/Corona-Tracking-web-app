<?php include "../partials/header.php";

include '../db.php';
?>

<?php

session_start();
if (isset($_SESSION["usertype"])) {
    if($_SESSION["usertype"] == "visitor"){

    }
    else{
        header("location:/index.php");
        die;
    }
    
} else {
    header("location:visitorLogin.php");
    die;
}
?>

<!DOCTYPE html>
<html>
<head> 
    <style> 
        .button {
        background-color: #9f94ba;
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
    </style>
</head>

<body>

    <?php
    $citizen_id =  $_GET['visitor'];
    $place_id = substr($_REQUEST['place'], 6);
    if(!$citizen_id || !$place_id){
        header("location:/index.php");
        die;
    }
    $entry_date = date("Y/m/d");
    $entry_time = date("h:i:s");
    $_SESSION['entry_date'] = entry_date;
    $_SESSION['entry_time'] = entry_time;
    $exit_date = NULL;
    $exit_time = NULL; 

        echo("Recording your time in this place: ");
        echo("$place_id");
        echo("$citizen_id");
        
        $sql = "INSERT INTO visitorToPlace(citizen_id,place_id, entry_date, entry_time, exit_date, exit_time)
        VALUES (:citizen_id, :place_id, :entry_date, :entry_time, :exit_date, :exit_time)";
        $stmt = $pdo->prepare($sql);
        $success = $stmt->execute([$citizen_id, intval($place_id), $entry_date, $entry_time, $exit_date, $exit_time]);

        //if statement to check if this sql insertion was successful
        if (!$success) {
            echo "error in insertion";
        }

       //exit();
   ?>

    <br> <br> <br> <br>
    <button> 
        <a href="visitortimeended.php?visitor=<?php echo $citizen_id?>&place=<?php echo $place_id?>" class = "button"> Check-out </a> 
    </button>


    <?php include "../partials/footer.php" ?>
</body>

</html>


