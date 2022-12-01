<html lang="en">

<?php include "../partials/header.php" ?>

<body>
    <!-- Registration form for the hospitals
Note that phone number and email are not required 
fields, we will check that atleast one was filled out before 
we add it to the database.

css for the login box can be found inside diff.css (the css files are a mess, sorry)
-->
    <div class="login-box">
        <h2>Registration Form</h2>
        <form action="hospitalAdd.php" method="POST">
            <div class="user-box">
                <input type="text" name="name" required="">
                <label>Hopsital Name</label>
            </div>
            <div class="user-box">
                <input type="text" name="username" required="">
                <label>Username</label>
            </div>
            <div class="user-box">
                <input type="password" name="password" required="">
                <label>Password</label>
            </div>

            <div class="optional-box">
                <input type="number" name="phoneNumber">
                <label>Phone Number</label>
            </div>
            <div class="optional-box">
                <input type="email" name="email">
                <label>Email</label>
            </div>

            <a>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <input type="submit" value="SUBMIT" style="font-family: Phantomsans, sans-serif; background-color:transparent;
                 border:none; color: #fff;font-size: 16px;transition: 0.5s;letter-spacing: 4px;">
                <a href="hospitalLogin.php" style=" float:right;font-family: Phantomsans, sans-serif;">Already applied? Login</a>
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