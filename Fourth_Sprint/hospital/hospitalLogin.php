<html lang="en">

<?php
session_start();
include "../partials/header.php";
include '../db.php';


if (isset($_SESSION["usertype"])) {
    if($_SESSION["usertype"] == "hospital"){
        header("location:/index.php");
        die;
    }
    
}


function connect(&$statement, &$password, $username): void
{ 
    $count = $statement->rowCount();
    if ($count == 1) {
        $hospital = $statement->fetch();
        if (is_array($hospital)) {
            ///Check if this hospital is in the database
            if ( ///if so, verify the password AND  if the agent approved it
                //see more about that in agentLand.php
                password_verify($password, $hospital['password'])
                && $hospital['status'] == "accepted"
            ) {//if all worked wellm create a session and redirect to main landing page
                $hospital['id']=$_POST['id'];
                $_SESSION["username"] = $username;
                $_SESSION["usertype"] = "hospital";
                header("location:hospitalLand.php?id=".$hospital['id']);
                die;
            } else {?>
                    <a>
                        Wrong pass! OR Form not accepted.
                    </a>
                <?php include "../partials/footer.php" ?>
                <?php   die;
                    }
                                }
    } else {
        header("location:../error404.php");
        die;
        }
}
try {
    if (isset($_POST["login"])) {//checks if the login button was pressed
        $username =  $_POST['username'];
        $password = $_POST['password'];
        //get user and pass from the login form
        $query = "SELECT * FROM hospital WHERE username = :username";
        $statement = $pdo->prepare($query);
        $statement->execute([$username]);
        connect($statement, $password, $username);
    }
} catch (PDOException $err) {
    $message = $err->getMessage();
}


?>


<body>
    <div class="login-box">
        <h2>Hospital Login</h2>
        <form method="POST">
<!-- simple login form with the method post -->
            <div class="user-box">
                <input type="text" name="username" required="">
                <label>Username</label>
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
                <a href="hospitalRegister.php" style=" float:right;font-family: Phantomsans, sans-serif;"> Didnt submit form? Go to Registration</a>
            </a>

        </form>
    </div>
    <?php include "../partials/footer.php" ?>
</body>

</html>