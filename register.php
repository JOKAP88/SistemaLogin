<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Register</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div class="card">
            <img src="img/0.web" alt="decoration">
            <h2>Register Now</h2>
            <form action="process_register.php" method="POST">
                <lable>Your Name<span>*</span></lable>
                <input type="text" name="nome" placeholder="Enter Your Name" require>

                <label>Your Email<sapan>*</sapan></label>
                <input type="email" name="email" placeholder="Enter Your Email" require>

                <label>Password<span>*</span></label>
                <input type="password" name="password" placeholder="Enter your Password" require>

                <label>Confirm Password<sapan>*</sapan></label>
                <input type="password" name="confirm_password" placeholder="Confirm Your Password" require>

                <label>User Type<span>*</span></label>
                <select name="tipo" require>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>

                <button type="submit">Register Now</button>
            </form>
            <div class="form-footer">
                Already Have an Account?
                <a href="login.php">Login Now</a>
            </div>
            <?php
                if(isset($_SESSION['erro'])){
                    echo"<p style='color:red; margin-top:15px;'>".$_SESSION['erro']."</p>";
                    unset($_SESSION['erro']);
                }
            ?>
        </div>
    </body>
</html>