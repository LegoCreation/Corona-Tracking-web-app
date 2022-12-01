<!DOCTYPE html>
<html lang="en">
    
<?php 
include "./partials/footer.php";
include "./partials/header.php";

$error = $_SERVER["REDIRECT_STATUS"];
$error_title = '';
$error_message = '';

// NOTE:
// YOU MUST CHANGE THE ".htaccess" FILE IN THIS DIRECTORY IN ORDER FOR THIS PAGE TO BE CALLED

if($error = 404){
    $error_title = '404 Page Not Found';
    $error_message = 'Requeted webpage not found, please try again';
}
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ERROR 404</title>
</head>
<body>
    <div id = "container">
        <div class = "content">
            <h3><?php echo $error_title;?></h3>
            <h3><?php echo $error_message;?></h3>
        </div>
    </div>

<script type = "text/javascript">
    var container = document.getElementById('container');
    <?php include "../partials/footer.php" ?>
</body>
</html>