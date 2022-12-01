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



<body>
    <?php
/**
 
 */
    $citizen_id =  $_GET['visitor'];
    $place_id = $_REQUEST['place'];
    if(!$citizen_id || !$place_id){
        header("location:/index.php");
        die;
    }
    $entry_date = strtotime($_SESSION['entry_date']);
    $entry_time = strtotime($_SESSION['entry_time']);
    $exit_date = date("Y/m/d");
    $exit_time = date("h:i:s"); 


        $sql_d = "SELECT MAX(visit_id) AS v_id FROM visitorToPlace WHERE citizen_id = ? AND place_id = ?;";
        $stmt = $pdo->prepare($sql_d);
        $stmt->execute([$citizen_id, $place_id]);
        $row=$stmt->fetch();
        $v_id = $row['v_id'];
        echo("Thank you for visiting.");
        
        $sql = "UPDATE visitorToPlace SET exit_date = ?, exit_time = ? WHERE visit_id = ?;";
        $stmt = $pdo->prepare($sql);
        $success = $stmt->execute([$exit_date, $exit_time, $v_id]);

        // if statement to check if this sql insertion was successful
        if (!$success) {
            echo "error in insertion";
        }

       // exit();
    $_SESSION['entry_date'] = NULL;
    $_SESSION['entry_time'] = NULL;
   ?>
   

    <?php include "../partials/footer.php" ?>
</body>

</html>


