<html lang="en">
    <script src="../js/hospitalManage.js"></script>
<?php include "../partials/header.php";
include '../db.php';
?>


<?php

session_start();
if (isset($_SESSION["usertype"])) {
    if($_SESSION["usertype"] == "agent"){

    }
    else{
        header("location:/index.php");
        die;
    }
    
} else {
    header("location:agentLogin.php");
    die;
}
?>

<body>

<?php  
  $hospitals= $pdo->query("SELECT * from hospital WHERE status='pending'");
   //get all the hospitals from the database that need to be approved 
/**
 So the idea is , for each hopital that has the status 'pending'
 have two buttons: a tick and a cross
 if you press the tick, it updates the status in the database as 'accepted'
 and you can login with those credentials now.

 However , if you press the cross, it updates the status in the database as 'rejected'
 and you won't be able to use those credentials to log in.

 This is using ajax , functions can be found in hospitalManage.js and ajax.php
 */
?>

<div class='login-box'>
    <?php foreach($hospitals as $hospital) { ?>
        <p>
            <span class="close" data-hospital-id="<?=$hospital['id']?>">
                <?php
                    echo "$hospital[name] $hospital[email] $hospital[phoneNumber]";
                ?>
                <a href="#" class="tick">
                    <button id="tick-mark" role="button" onclick="accept(event)">
                    </button>
                </a> 
                <a href="#" class="cross">
                    <button id="close" role="button" onclick="reject(event)">
                    </button>
                </a>
            </span>
        </p>
    <?php } ?>
</div>
    <a>Welcome!</a>

    
            <a href="../logout.php">Logout</a><br><br>
            <a href="./agent-see-options.php">Do you want to see user details?</a>
            <?php include "../partials/footer.php" ?>

           
</body>

</html>
