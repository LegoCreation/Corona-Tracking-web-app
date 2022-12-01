<?php include "../partials/header.php";
include '../db.php';
session_start();
?>



<?php
  if (isset($_SESSION["id"])) {
    //check if connection was successful.
    $id=$_SESSION['id'];
    $stmt= $pdo->prepare("SELECT name FROM place WHERE id=? LIMIT 1");
    $stmt->execute([$id]);
    $row=$stmt->fetch();
    $_SESSION['name'] = $row['name']
    ?> 
    <h3>
      You're now logged in. Welcome <?php echo $row['name']?>!
    </h3>
    <?php 
  }
  else {
    header("location:./visitorLogin.php");
    die;
  } 
?>

<html lang="en">
<head>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>
</head>

<body>
    <!-- Making of the home layout -->
    <div id = "main">
      <h5>
    <a href="../logout.php">Logout</a>
    </h5>
    <br>
        <div id = "box1">
        <h3>Click on the QR Code to download it</h3>
        
            <div id = "outputbox">
                    <a id = 'qrdl'>
                    <div id="qrcode"></div>
                    </a>
                
            </div>
                    
            
        </div>
    </div>
</body>

<!-- Javascript QRCode generator from https://davidshimjs.github.io/qrcodejs/ -->
<script type="text/javascript">
    
    const makeQR = (url, filename) => {
  var qrcode = new QRCode("qrcode");
  qrcode.makeCode(url);

  setTimeout(() => {
    let qelem = document.querySelector('#qrcode img')
    let dlink = document.querySelector('#qrdl')
    let qr = qelem.getAttribute('src');
    dlink.setAttribute('href', qr);
    dlink.setAttribute('download', filename);
    dlink.removeAttribute('hidden');
  }, 500);
}

makeQR("place_" + "<?php echo $_SESSION['id'];?>", 'qr-code.jpeg')
    </script>
<?php include "../partials/footer.php" ?>
</html>
