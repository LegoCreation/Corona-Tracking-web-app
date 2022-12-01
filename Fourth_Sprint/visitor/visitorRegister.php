<html lang="en">
<?php include "../partials/header.php";
include '../db.php';
?>

<body>
    <!-- basic register box, check the comments on 
    hospitalRegister.php for more details -->
    <div class="login-box">
        <h2>Register</h2>
        <form action="visitorAdd.php" method="POST">
            <div class="user-box">
                <input type="text" name="firstName" id="firstName" required="">
                <label>First Name</label>
            </div>
            <div class="user-box">
                <input type="text" name="lastName" id="lastName" required="">
                <label>Last Name</label>
            </div>
            <div class="user-box">
                <input type="text" name="street" id="street" required="">
                <label>Street</label>
            </div>
            <div class="user-box">
                <input type="text" name="city" id="city" required="">
                <label>City</label>
            </div>
            <div class="user-box">
                <input type="number" name="zipCode" id="zipCode" required="">
                <label>Zip Code</label>
            </div>
            <div class="user-box">
                <input type="password" name="password" id="password" required="">
                <label>Password</label>
            </div>
            <div class="optional-box">
                <input type="text" name="phoneNumber" id="phoneNumber">
                <label>Phone Number *</label>
            </div>
            <div class="optional-box">
                <input type="text" name="email" id="email">
                <label>Email *</label>
            </div>       

            <a>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <input type="submit" value="SUBMIT" style="font-family: Phantomsans, sans-serif; background-color:transparent;
                 border:none; color: #fff;font-size: 16px;transition: 0.5s;letter-spacing: 4px;">
                <a href="visitorLogin.php" style=" float:right;font-family: Phantomsans, sans-serif;"> Have an Account? Login</a>
            </a>

        </form>

        <p class="disclaimer">
            <br>
            * You must provide at least one form of contact (Email or Phone Number).
        </p>

    </div>

    <?php include "../partials/footer.php" ?>

</body>

</html>