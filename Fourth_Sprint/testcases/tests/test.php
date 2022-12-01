<!DOCTYPE html>
<html lang="en">
<head>
    <title>Various testing scenarios</title>
</head>
<body>

<?php

use PHPUnit\Framework\TestCase;

class SampleTest extends TestCase
{
    public function test_true_asserts_to_true()
    {
        //
    }
}
?>

<!-- No test cases in this file were functional as of the end of sprint 2. 
     All test cases below have been remade or updated in sprint 3.
-->

<ol>
    <!-- 1 -->
    <li><b>Does DB work?</b></li>
        <?php
            $servername = "localhost";
            $dbname     = "seteam20";
            $username   = "seteam20";
            $password   = "PZiVHc7p";
            
            try {
              $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
              // set the PDO error mode to exception
              $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              echo "Connected successfully";
            } catch(PDOException $e) {
              echo "Connection failed: " . $e->getMessage();
            }
        ?> <br>

    <!-- 2 -->
    <li><b>Open Connection</b></li>
        <?php
        // Connection is opened with the previous code.
        // Double check for errors
            if ($conn->connect_error) {
                die;
            }
        ?>
        Success.<br>

    <!-- 3 -->
    <li><b>Close Connection</b></li>
        <?php
            $conn = null;
        ?>
        Success.<br>

    <!-- 4 -->
    <li><b>Open & Close Connection with <i>db.php</i> file</b></li>
        <?php
            include 'db.php';
            $conn = null;
        ?>
        Success.<br>

    <!-- Restart database connection for future test cases: -->
    <?php include 'db.php'; ?>

    <!-- 5 -->
    <li><b>Check for Visitor (returns only 1)</b></li>
        <?php
            try {
                $stmt= $pdo->prepare("SELECT * FROM visitor LIMIT 1");
                $stmt->execute();
                $row=$stmt->fetch();
                echo "Selected visitor name: ", $row['firstName'], " ", $row['lastName'];
            }
            catch (\Exception $e) {
                echo "That didn't work...";
                die;
            }
        ?>

    <!-- 6 -->
    <li><b>Check for Place (returns only 1)</b></li>
        <?php
            try {
                $stmt= $pdo->prepare("SELECT * FROM place LIMIT 1");
                $stmt->execute();
                $row=$stmt->fetch();
                echo "Selected place name: ", $row['name'];
            }
            catch (\Exception $e) {
                echo "That didn't work...";
                die;
            }
        ?>

    <!-- 7 -->
    <li><b>Check for Hospital (returns only 1)</b></li>
        <?php
            try {
                $stmt= $pdo->prepare("SELECT * FROM hospital LIMIT 1");
                $stmt->execute();
                $row=$stmt->fetch();
                echo "Selected hospital name: ", $row['name'];
            }
            catch (\Exception $e) {
                echo "That didn't work...";
                die;
            }
        ?>

    <!-- 8 -->
    <li><b>Check for Agent (returns only 1)</b></li>
        <?php
            try {
                $stmt= $pdo->prepare("SELECT * FROM admin LIMIT 1");
                $stmt->execute();
                $row=$stmt->fetch();
                echo "Selected admin name: ", $row['username'];
            }
            catch (\Exception $e) {
                echo "That didn't work...";
                die;
            }
        ?>

    <!-- 9 -->
    <li><b>Check for visitors to places (returns only 1)</b></li>
        <?php
            try {
                $stmt= $pdo->prepare("SELECT * FROM visitorToPlace LIMIT 1");
                $stmt->execute();
                $row=$stmt->fetch();
                echo "Citizen with ID ", $row['citizen_id'], " visited place with ID ", $row['place_id'], " at ", $row['entry_time'], " on ", $row['entry_date'], ".";
            }
            catch (\Exception $e) {
                echo "That didn't work...";
                die;
            }
        ?>

    <!-- 10 -->
    <li><b>Visitor Registration</b></li>
        <?php
            try {
                $sql = "INSERT INTO visitor(id, firstName, lastName, street, city, zipCode, phoneNumber, email, password, deviceId, status) VALUES ('1', 'a', 'b', 'c', 'd','0', '1','e@f.com','g', 'h', 'Infected');";
                $conn->exec($sql);
                echo "Success";
            } catch (\PDOException $e) {
                echo $sql . "<br>" . $e->getMessage();
                die;
            }
        ?> <br>

     <!-- 11 -->
     <li><b>Place Registration</b></li>
        <?php
            $sql = "INSERT INTO place(id, name, street, city, zipCode, phoneNumber, email) VALUES ('1', 'a', 'b', 'c', '1', '0', 'd@e.com');";
            $conn->exec($sql);
            echo "Success";
        ?> <br>

    <!-- 12 -->
    <li><b>Hospital Registration</b></li>
        <?php
            $sql = "INSERT INTO hospital(id, name, username, password, phoneNumber, email) VALUES ('1', 'a', 'b', 'c', '1','d@e.com');";
            $conn->exec($sql);
            echo "Success";
        ?> <br>

    <!-- 13 -->
    <li><b>Visitor gets infected?</b></li>
        <?php
            $sql = "UPDATE visitor SET status='1' WHERE id='1' AND firstName='a';";
            $conn->exec($sql);
            echo "Success";
        ?> <br>

    <!-- 14 -->
    <li><b>Deleting record from Visitor</b></li>
        <?php
            $sql = "DELETE FROM visitor WHERE id=1 AND firstName='a';";
            $conn->exec($sql);
            echo "Success";
        ?> <br>

    <!-- 15 -->
    <li><b>Deleting record from Place</b></li>
        <?php
            $sql = "DELETE FROM place WHERE id=1 AND name='a';";
            $conn->exec($sql);
            echo "Success";
        ?> <br>

    <!-- 16 -->
    <li><b>Deleting record from Hospital</b></li>
        <?php
            $sql = "DELETE FROM hospital WHERE id=1 AND name='a';";
            $conn->exec($sql);
            echo "Success";
        ?> <br> 

    <!-- 17 -->
    <!-- This code is possibly vulnerable to a timing attack if the attacker stops the deletion of this record from occurring  -->
    <li><b>Adding record from Agent</b></li>
        <?php
            $sql = "INSERT INTO admin(id, username, password) VALUES (1, 'a', 'thisIsATestPasswordPleaseDoNotUseATimingAttack');";
            $conn->exec($sql);
            echo "Success";
        ?> <br>  

    <!-- 18 (updated in sprint 3 but this modified non-test data in the database) -->
    <li><b>Deleting record from Agent</b></li>
        <?php
            $sql = "DELETE FROM admin WHERE id=1 AND username = 'a';";
            $conn->exec($sql);
            echo "Success";
        ?> <br>  

    <!-- 19 -->
    <li><b>Test session creation</b></li>
        <?php
            $name = 'test';
            $_SESSION['name']=$name;
            session_start();
        ?> 
        Success.<br> 

    <!-- 20 -->
    <li><b>Test session deletion</b></li>
        <?php
            session_destroy();
        ?> 
        Success.<br> 

    <!-- 21 -->
    <li><b>Test footer page</b></li>
        <?php
            include("../partials/footer")
        ?> 
        Success.<br> 

</body>
</html>