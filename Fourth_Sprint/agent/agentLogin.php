<html lang="en">

<?php include "../partials/header.php";
include "../db.php";
session_start(); ?>

<?php
if (isset($_SESSION["usertype"])) {
    if($_SESSION["usertype"] == "agent"){
        header("location:/index.php");
        die;
    }
    
}
try {
    /**
     If the login button was pressed
     try to create a session and redirect to 
     main landing page for the agent
     */
    if (isset($_POST["login"])) {
        $username =  $_POST['username'];
        $password = $_POST['password'];
        $query = "SELECT * FROM admin WHERE username = :username AND password = :password";
        $statement = $pdo->prepare($query);
        $statement->execute(
            array(
                'username'     =>     $_POST["username"],
                'password'     =>     $_POST["password"]
            )
        );
        $count = $statement->rowCount();
        if ($count == 1) {
            $_SESSION["username"] = $_POST["username"];
            $_SESSION["usertype"] = "agent";
            header("location:agentLand.php");
            die;
        } else {
            header("location:../error.php");
            die;
        }
    }
} catch (PDOException $err) {
    $message = $err->getMessage();
}


?>

<body>
    <div class="login-box">
        <h2>
            Login
        </h2>
        <form method="post">
            <div class="user-box">
                <input type="text" name="username" required>
                    <label>
                        Username
                    </label>
            </div>
            <div class="user-box">
                <input type="password" name="password" required="">
                    <label>
                        Password
                    </label>
            </div>




            <a>
                <span></span>
                <span></span>
                <span></span>
                <span></span>

                <input type="submit" name="login" value="LOGIN" style="font-family: Phantomsans, sans-serif; background-color:transparent;
                 border:none; color: #fff;font-size: 16px;transition: 0.5s;letter-spacing: 4px;">
            </a>

        </form>
    </div>
    <?php include "../partials/footer.php" ?>

</body>

</html>