<html lang="en">
<?php include "../partials/header.php";
include '../db.php';
?>

<!-- 

Action page from hospital register.
You request all the fields from the form 
and add them in the database.

Note that we also add an additional field, $status,
which is initially pending. This makes it so that 
we know this hospital needs to be first approved by the agent
before it can be a valid hospital used for logging in.
-->

<body>

    <?php

    $name =  $_REQUEST['name'];
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
    $phoneNumber = $_REQUEST['phoneNumber'];
    $email =  $_REQUEST['email'];
    $status = "pending";
    /**
     All passwords are hashed. you use password_hash() to get the hashed pass,
     and you use the password_verify(normalpass,hashedpass) to verify whether a pass 
     is correct (during login)
     */
    $hashedpass = password_hash($password, PASSWORD_DEFAULT);



    $stmt = $pdo->prepare('SELECT * FROM hospital WHERE username=:username');
    $stmt->execute([$username]);
    $count = $stmt->rowCount();
    /**
     Before we add anything to the database, make sure the username is unique
     */
    if ($count > 0) {
    ?>
        <a>Username taken.</a>
        <a href="hospitalRegister.php">To Registration</a>

    <?php
    } else if (empty($phoneNumber) && empty($email)) {
    /** 
    Here we check as I mentioned in hospitalRegister.php 
    that atleast one contact method is provided
    */
    ?>
        <a>Please provide atleast one contact method! (phone or email)</a>
        <a href="hospitalRegister.php">To Registration</a>
    <?php
    } else {
        /**
         If none of the problems mentioned above appear, add this hospital to the database
         */
        $sql = "INSERT INTO hospital(name,username,password,phoneNumber,email,status)
        VALUES (:name,:username, :hashedpass, :phoneNumber, :email,:status)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $username, $hashedpass, $phoneNumber, $email, $status]);

    ?>

        <a> Form succesfully submitted. Once an admin confirms it, you can login!</a>
        <a href="hospitalLogin.php">Back to Login</a>
    <?php }
    ?>

    <?php include "../partials/footer.php" ?>
</body>

</html>