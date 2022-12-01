<!-- <html lang="en">



<body>


    <br />
    <button><a href="http://clabsql.clamv.jacobs-university.de/~sgurubacha/SE/agent/Agent-sees-details.php?see=visitors"> See the list of Visitors</a></button>
    <button><a href="http://clabsql.clamv.jacobs-university.de/~sgurubacha/SE/agent/Agent-sees-details.php?see=placeowners"> See the list of Places and Place owners</a></button>
    <button><a href="http://clabsql.clamv.jacobs-university.de/~sgurubacha/SE/agent/Agent-sees-details.php?see=visitorentrydetails"> See visitor entry detais</a></button>
    <button><a href="http://clabsql.clamv.jacobs-university.de/~sgurubacha/SE/agent/Agent-sees-details.php?see=activehospitals"> See Active Hospitals</a></button>

</body>

</html> -->

<!DOCTYPE html>
<html lang="en">

<?php include "../partials/header.php";
include '../db.php';
session_start();
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

    <nav>
        <h3>
            <a href="/">
                Agent Features
            </a>
        </h3>

    </nav>

    <h1>Please choose your option:</h1>



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
		<a href="./list-visitors.php">
                 <button class="button-64" role="button">
                    <span class="text">
                        List Visitors
                    </span>
                </button>
            </a>
        </div>

        <div class="placeOwner">
        <a href="./Agent-sees-details.php?see=placeowners">
                <button class="button-64" role="button">
                    <span class="text">
                        Places and Owners
                    </span>
                </button>
            </a>
        </div>


        <div class="hospital">
        <a href="./Agent-sees-details.php?see=visitorentrydetails">
                <button class="button-64" role="button">
                    <span class="text">
                        Visitor Entry Details
                    </span>
                </button>
            </a>
        </div>

        <div class="agent">
        <a href="./Agent-sees-details.php?see=activehospitals">
                <button class="button-64" role="button">
                    <span class="text">
                        Approved Hospitals
                    </span>
                </button>
            </a>
        </div>
    </div>

</body>

</html>
