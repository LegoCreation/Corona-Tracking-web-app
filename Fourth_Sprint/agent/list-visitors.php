<html lang="en">

<?php include "../partials/header.php";
include "../db.php";
session_start(); ?>

<?php

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

<form action="./list-visitors.php" method="post">
	<input type="text" name="search" placeholder="visitor name">
	<input type="submit" value="search">
</form>
<a href="./agent-see-options.php">back</a>

<?php
$name = $_POST['search'];

$stmt= $pdo->prepare("SELECT * FROM visitor where firstName LIKE '%$name%' OR lastName LIKE '%$name%'");
$stmt->execute();
$returned_values=$stmt->fetchAll();
// var_dump($returned_values);


if (!empty($returned_values)) {

	echo "<table>";
	echo "<tr><td>id</td><td>first_name</td><td>last_name</td><td>email</td>
	<td>address</td><td>phone_number</td><td>infection_status</td></tr>";
	foreach ($returned_values as $row) {
		echo "<tr><td>" . $row['id']  . "</td><td>" . $row['firstName'] . "</td>
		<td>" . $row['lastName'] . "</td><td>" . $row['email'] . "</td>
		<td>" . $row['street'] . "</td><td>" . $row['phoneNumber'] . "</td>
		<td>" . $row['status'] . "</td></tr>";
	}
	echo "</table>";
} else {
	echo "<h3>No visitors found.</h3>";
}
?>



</body>

</html>
