<?php session_start(); ?>


<link rel="stylesheet" href="css/style.css">
<div class="container">
    <div class="card">
        <img src="img/imagem.png" alt="decoration">

        <h2>LOGIN NOW</h2>

        <form action="process_login.php" method="POST">
            <label>Enter Your Email<span>*</span></label>
            <input type="email" name="email" placeholder="Enter Your Email" required>

            <label>Enter Your Password<span>*</span></label>
            <input type="password" name="password" placeholder="Enter Your Password" required>

            <button type="Submit">Login Now</button>
        </form>

        <div class="form-footer">
            Don't You Have an Account?
            <a href="register.php">Register Now</a>
        </div>
    </div>
</div>