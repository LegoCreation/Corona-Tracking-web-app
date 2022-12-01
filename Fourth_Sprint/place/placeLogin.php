<html lang="en">

<?php
session_start();
include "../partials/header.php";
include '../db.php';
?>


<?php

if (isset($_SESSION["usertype"])) {
    if($_SESSION["usertype"] == "place"){
        header("location:/index.php");
        die;
    }
    
} 

function connect(&$statement, &$password): void
{ 
    $count = $statement->rowCount();
    if ($count == 1) {
        $statement = $statement->fetch();
        if (is_array($statement)) {
            // Check if the visitor is in the database
            if (password_verify($password, $statement['password'])) {
                // Check if the passwords match
                // if they do, start a session and redirect
                $_SESSION["id"] = $statement['id'];
                $_SESSION["usertype"] = "place";
                header("location:placeLand.php?id=".$statement['id']);
                die;
            } else {
                ?>
                <div class="alert-box">
                    <div>
                        <a>
                            Invalid Password
                        </a>
                        <br><br>
                        <a href="placeLogin.php">
                            Back to Login
                        </a>
                    </div>
                </div>
                <script>
                    alert("Wrong password, please try again")
                </script>
                <?php die;
            }
        } 
    } else {
        ?>
        <div class="alert-box">
            <div>
                <a>
                    User not found!
                </a>
                <br><br>
                <a href="placeLogin.php">
                    Back to Login
                </a>
            </div>
        </div>
        <script>
            alert("User not found!")
        </script>
        <?php die;
    }
}

try {
    if (isset($_POST["login"])) {
        /** This algorithm isn't completely correct as it assumes 
            that email/phonenumber are unique, which may not be true.
            they merely serve as placeholders until deviceId 
            (which is unique) is implemented.
        */
        if (!empty($_POST['email'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $query = "SELECT * FROM place WHERE email = :email LIMIT 1";
            $statement = $pdo->prepare($query);
            $statement->execute([$email]);
           connect($statement,$password);
        } else if (!empty($_POST['phoneNumber'])) {
            $phoneNumber = $_POST['phoneNumber'];
            $password = $_POST['password'];
            $query = "SELECT * FROM place WHERE phoneNumber = :phoneNumber LIMIT 1";
            $statement = $pdo->prepare($query);
            $statement->execute([$phoneNumber]);
           connect($statement,$password);
            } 
            else {
                ?>
                <div class="alert-box">
                    <div>
                        <a>
                            Please enter either a phone number or email!
                        </a>
                        <br><br>
                        <a href="placeLogin.php">
                            Back to Login
                        </a>
                    </div>
                </div>
                <script>
                    alert("Please enter either a phone number or email!")
                </script>
                <?php die;
            }
    }
} catch (PDOException $err) {
    $message = $err->getMessage();
}


?>

<body>
    <div class="login-box">
        <h2>Login</h2>
        <form method="POST">


            <div class="user-box">
                <!-- Note: phone number must be entered as text because 
                           it is stored as a varchar in the database -->
                <input type="text" name="phoneNumber"> 
                <label>Phone Number</label>
            </div>
            <div class="user-box">
                <input type="email" name="email" >
                <label>Email</label>
            </div>
            <div class="user-box">
                <input type="password" name="password" required="">
                <label>Password</label>
            </div>
            <a>
                <span></span>
                <span></span>
                <span></span>
                <span></span>

                <input type="submit" name="login" value="LOGIN" style="font-family: Phantomsans, sans-serif; background-color:transparent;
                 border:none; color: #fff;font-size: 16px;transition: 0.5s;letter-spacing: 4px;">
                 <a href="placeRegister.php" style=" float:right;font-family: Phantomsans, sans-serif;"> Don't have an account? Register</a>
            </a>

        </form>
    </div>


    <?php include "../partials/footer.php" ?>



</body>

</html>