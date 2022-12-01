<html lang="en">
<?php include "../partials/header.php" ?>

<!-- simple registration box, just like the other ones -->

<body>
    <div class="login-box">
        <h2>Register</h2>
        <form action="placeAdd.php" method="POST">
            <div class="user-box">
                <input type="text" name="name" required="">
                <label>Place Name</label>
            </div>
            <div class="user-box">
                <input type="text" name="street" required="">
                <label>Street</label>
            </div>
            <div class="user-box">
                <input type="text" name="city" required="">
                <label>City</label>
            </div>
            <div class="user-box">
                <input type="number" name="zipCode" required="">
                <label>Zip Code</label>
            </div>
            <div class="optional-box">
                <input type="number" name="phoneNumber">
                <label>Phone Number *</label>
            </div>
            <div class="optional-box">
                <input type="text" name="email" >
                <label>Email *</label>
            </div>
            <div class="user-box">
                <input type="password" name="password" id="password" required="">
                <label>Password</label>
            </div>

            <a>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <input type="submit" value="SUBMIT" style="font-family: Phantomsans, sans-serif; background-color:transparent;
                 border:none; color: #fff;font-size: 16px;transition: 0.5s;letter-spacing: 4px;">
                 <a href="placeLogin.php" style=" float:right;font-family: Phantomsans, sans-serif;"> Have an Account? Login</a>
            </a>

        </form>
    </div>
    <?php include "../partials/footer.php" ?>
    <footer>
        <a class="disclaimer"> * Are optional fields.<br>
            However, you must provide atleast one form of contact (Email or Phone Number). </a>
    </footer>
</body>

</html>