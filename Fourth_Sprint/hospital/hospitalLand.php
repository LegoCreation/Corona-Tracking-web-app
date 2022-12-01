<html lang="en">
<?php include "../partials/header.php";

include '../db.php';
?>

<script src="../js/markVisitor.js"></script>


<?php

session_start();
  if (isset($_SESSION["username"])) {
    //if a session was succesfuly created in hospitalLogin.php
    $id=$_REQUEST['id'];
    $stmt= $pdo->prepare("SELECT name FROM hospital WHERE id=:id LIMIT 1");
    $stmt->execute([$id]);
    $row=$stmt->fetch();
    ?>
    <h3>
        Login Success, Welcome <?php echo $row['name']?>!
    </h3>
    <?php
    }else {
        header("location:./hospitalLogin.php");
        die;
        }?>

<body>


<?php $visitors= $pdo->query("SELECT * from visitor ");
/**
 Similar idea as the one implemented in agentLand. 
 Have a div with every user and their status
 For each user, if you press mark infected, 
 it changes their status to infected. Analogous mark uninfected.

 Functions in markVisitor.js and markVisitor.php
 */
?>

<div class="login-box">
 <?php foreach($visitors as $visitor) { ?>
        <p>
            <span class="close" data-visitor-id="<?=$visitor['id']?>">
                <?php
                    echo "$visitor[firstName] $visitor[lastName] $visitor[email] <b>$visitor[status]</b>";
                ?>
                <div id="infected-buttons">
                    <button  role="button" class="update-status" onclick="accept(event)">
                        Mark Infected
                    </button>
                    
                    <button  role="button" class="update-status" onclick="reject(event)">
                        Mark Uninfected
                    </button>
                </div>
            </span>
        </p>
    <?php } ?>
 </div>
    <a>Welcome!</a>
    <br>
    <a> Hospital things <a>
            <a href="../logout.php">Logout</a>
            <?php include "../partials/footer.php" ?>
</body>

</html>