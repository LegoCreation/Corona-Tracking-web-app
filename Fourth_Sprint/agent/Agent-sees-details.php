<html lang="en">
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

    if ($_GET['see'] == 'visitors') {
        echo"visitor";


        $stmt= $pdo->prepare("SELECT * FROM visitor");
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
    } elseif ($_GET['see'] == 'placeowners') {
        echo "place Owner";
        $stmt= $pdo->prepare("SELECT * FROM place");
        $stmt->execute();
        $returned_values=$stmt->fetchAll();
        // var_dump($returned_values);
       

        if (!empty($returned_values)) {
            echo "<table>";
            echo "<tr><td>id</td><td>Place name</td><td>Place owner email</td></tr>";
            foreach ($returned_values as $row) {
                echo "<tr><td>" . $row['id']  . "</td><td>" . $row['name'] . "</td>
                <td>" . $row['email'] . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "<h3>No visitors found.</h3>";
        }
    } elseif ($_GET['see'] == 'activehospitals') {
        echo "Active Hospitals";
        $stmt= $pdo->prepare("SELECT * FROM hospital WHERE status = 'accepted' ");
        $stmt->execute();
        $returned_values=$stmt->fetchAll();
        //var_dump($returned_values);
       

        if (!empty($returned_values)) {
            echo "<table>";
            echo "<tr><td>id</td><td>Place name</td><td>Place owner email</td></tr>";
            foreach ($returned_values as $row) {
                echo "<tr><td>" . $row['id']  . "</td><td>" . $row['name'] . "</td>
                <td>" . $row['email'] . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "<h3>No visitors found.</h3>";
        }
    } elseif ($_GET['see'] == 'visitorentrydetails') {

        echo("visitorentrydetails");


        $stmt= $pdo->prepare("SELECT * FROM visitorToPlace");
        $stmt->execute();
        $returned_values=$stmt->fetchAll();

    
        // var_dump($returned_values);
        // echo "check";

        if (!empty($returned_values)) {
            echo "<table>";
            echo "<tr><td>id</td><td>Place id</td><td>entry_date</td><td>entry_time</td></tr>";
            foreach ($returned_values as $row) {
                echo "<tr><td>" . $row['citizen_id']  . "</td><td>" . $row['visit_id'] . "</td>
                <td>" . $row['entry_date'] . "</td><td>" . $row['entry_time']  .  "</td></tr>";
            }
            echo "</table>";

        } else {
            echo "<h3>No visitors found.</h3>";
        }
    } else {
        echo "<h3> Sorry, no data available</h3>";
    }


    ?>
</body>

</html>