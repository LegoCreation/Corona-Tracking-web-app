<html lang="en">
<?php include "../partials/header.php";
include '../db.php';
session_start();
?>



<body>




    <?php

/**
 Request all the fields from the form in placeRegister.php
 */
    $name =  $_REQUEST['name'];
    $street = $_REQUEST['street'];
    $city = $_REQUEST['city'];
    $zip = $_REQUEST['zipCode'];
    $phoneNumber = $_REQUEST['phoneNumber'];
    $email =  $_REQUEST['email'];
    $password = $_REQUEST['password'];
    $hashedpass = password_hash($password, PASSWORD_DEFAULT);

    $_SESSION['name']=$name;
    $_SESSION["usertype"] = "place";



    if (empty($phoneNumber) && empty($email)) {
        //Check to have atleast one contact method
    ?>
        <a>Please provide atleast one contact method! (phone or email)</a>
        <a href="placeRegister.php">To Registration</a>
    <?php
    } else {
        $sql = "INSERT INTO place(name, street, city, zipCode, phoneNumber, email, password)
        VALUES (:name, :street, :city, :zip, :phoneNumber, :email, :hashedpass)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $street, $city, $zip, $phoneNumber, $email, $hashedpass]);
        //if added succesfully, redirect to main landing page
        header("Location: ../place/placeLand.php");
        die;
        exit();
    }
    ?>

    <?php include "../partials/footer.php" ?>
</body>

</html>