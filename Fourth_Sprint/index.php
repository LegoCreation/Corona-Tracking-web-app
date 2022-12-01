<!DOCTYPE html>
<html lang="en">

<?php 
include "./partials/header.php";
include "./db.php";
?>

<?php

session_start();
if (isset($_SESSION["usertype"])) {
    if($_SESSION["usertype"] == "agent"){
        header("location:/agent/agentLand.php");
        die;
    }
    if($_SESSION["usertype"] == "visitor"){
        header("location:/visitor/visitorLand.php");
        die;
    }
    if($_SESSION["usertype"] == "place"){
        header("location:/place/placeLand.php");
        die;
    }
    if($_SESSION["usertype"] == "hospital"){
        header("location:/hospital/hospitalLand.php");
        die;
    }
}
?>

<body>
    <nav>
        <h3>
            <a href="/">
                Corona Archive
            </a>
        </h3>

    </nav>

    <h1>Welcome! Please choose the suitable user:</h1>


    <div class="grid">
<!-- creates a grid with 4 buttons, 
each leading to the login of the specific actor-->


<!-- you will notice that the reference is actually to 
the main landing page for
each actor, not the login as mentioned before.
but that's because inside the land pages, unless a session is active,
you get redirected to the login page.

I made it this way so that once you are logged in, 
you can go back and forth to the main
page until you logout and therefore destroy the session

-->
        <div class="visitor">
            <a href="./visitor/visitorLand.php">
                 <button class="button-64" role="button">
                    <span class="text">
                        Visitor
                    </span>
                </button>
            </a>
        </div>

        <div class="placeOwner">
            <a href="./place/placeLogin.php">
                <button class="button-64" role="button">
                    <span class="text">
                        Place Owner
                    </span>
                </button>
            </a>
        </div>


        <div class="hospital">
            <a href="./hospital/hospitalLand.php">
                <button class="button-64" role="button">
                    <span class="text">
                        Hospital
                    </span>
                </button>
            </a>
        </div>

        <div class="agent">
            <a href="./agent/agentLand.php">
                <button class="button-64" role="button">
                    <span class="text">
                        Agent
                    </span>
                </button>
            </a>
        </div>
    </div>

</body>

</html>