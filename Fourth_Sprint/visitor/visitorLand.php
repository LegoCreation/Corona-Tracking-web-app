<html lang="en">
<?php 
include "../partials/header.php";
include '../db.php';
?>

<?php
session_start();
  if (isset($_SESSION["id"])) {
    //check if connection was successful.
    $id=$_REQUEST['id'];
    $stmt= $pdo->prepare("SELECT firstName FROM visitor WHERE id=? LIMIT 1");
    $stmt->execute([$id]);
    $row=$stmt->fetch();
    ?> 
    <h3>
      You're now logged in. Welcome <?php echo $row['firstName']?>!
    </h3>
    <?php 
  }
  else {
    header("location:./visitorLogin.php");
    die;
  } 
?>

<body>
  <a>Welcome!</a> <br> 
  <br>
  <a href="../logout.php">Logout</a>
  <br><br>
  <div style="border: 1px solid white; margin: 20px;">
    <a> The following feature doesn't work without localhost or https.
      However, you can find success if you use the Jacobs University VPN Access, namely vpnasa. 
    </a>
    <br>
    <a> Please copy the website link and log in again </a> <a href="https://vpnasa.jacobs-university.de/+CSCOE+/portal.html">here.</a> 
  </div>

  <div id="reader" style="height: 400px; width: 400px; display: relative; margin: auto; margin-top: 3%;">
    <p id="demo"> </p>
    <button id="check_out_button" visibility="hidden"></button>
  </div>
  <?php include "../partials/footer.php" ?>
</body>

<script src="../js/scan.min.js"></script>
<script>
/**
 QR reader using the camera from your computer.
  Code from: https://github.com/mebjas/html5-qrcode
  However, this only works on localhost or https.
  it will NOT work on clamv.
  */

function onScanSuccess(decodedText, decodedResult) {
  // handle the scanned code as you like, for example:
    console.log(`Code matched = ${decodedText}`, decodedResult);
    alert(decodedText);
    //stop scanning, and clear the area
    html5QrcodeScanner.clear();
    window.location.href = `./visitortimestarted.php?visitor=<?php echo $_SESSION['id'] ?>&place=${decodedText}`
  
}

function onScanFailure(error) {
  // handle scan failure, usually better to ignore and keep scanning.
  // for example:
  console.warn(`Code scan error = ${error}`);
}

let html5QrcodeScanner = new Html5QrcodeScanner(
  "reader",
  { fps: 10, qrbox: {width: 400, height: 400} },
  /* verbose= */ false);
html5QrcodeScanner.render(onScanSuccess, onScanFailure);
</script>

</html>
