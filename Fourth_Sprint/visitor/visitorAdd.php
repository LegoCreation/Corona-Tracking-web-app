<html lang="en">
<?php include "../partials/header.php";
include '../db.php';
?>

<body>
  <?php
  /**
   Add a new visitor to the database.
  deviceId is left unfilled, because (members from sprints 1, 2, and 3) 
  do not know what that means nor how to implement it.
  */
  $firstName =  $_REQUEST['firstName'];
  $lastName = $_REQUEST['lastName'];
  $street = $_REQUEST['street'];
  $city = $_REQUEST['city'];
  $zip = $_REQUEST['zipCode'];
  $phoneNumber = $_REQUEST['phoneNumber'];
  $email =  $_REQUEST['email'];
  $password = $_REQUEST['password'];
  $hashedpass = password_hash($password, PASSWORD_DEFAULT);
  $status="uninfected";

  if (empty($phoneNumber) && empty($email)) {?>
    <div class="alert-box">
      <div>
        <a>
          Please provide atleast one contact method! (phone or email)
        </a>
        <br><br>
        <a href="visitorRegister.php">
          Back to Registration
        </a>
      </div>
    </div>
  <?php 
  } else {
    $sql = "INSERT INTO visitor(firstName,lastName, street, city, zipCode, phoneNumber, email, password,status)
    VALUES (:firstName, :lastName, :street, :city, :zip, :phoneNumber, :email, :hashedpass, :status)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$firstName, $lastName, $street, $city, $zip, $phoneNumber, $email, $hashedpass,$status]);
    header("Location: ../visitor/visitorLand.php");
    exit();
  }?>

  <?php include "../partials/footer.php" ?>
</body>

</html>