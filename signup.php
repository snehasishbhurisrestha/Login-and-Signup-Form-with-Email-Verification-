<?php require_once "control.php" ?>
<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="style1.css">
</head>
<body> 
    <div class="wrapper">
        <div class="headline">
            <h1>Welcome To Our Family</h1>
        </div>
        <form class="form" method="post" action="signup.php">
            <?php
                if(count($errors) == 1){
                ?>
                <div class="form-group" id="denger">
                    <?php
                        foreach($errors as $showerr){
                            echo $showerr;
                        }
                    ?>
                </div>
                <?php
                }elseif(count($errors) > 1){
                    ?>
                    <div class="form-group" id="denger">
                        <?php
                            foreach($errors as $showerr){
                                ?>
                                <li><?php echo $showerr;?></li>
                                <?php
                            }
                        ?>
                    </div>
                    <?php
                }
            ?>
            <div class="form-group">
                <input type="text" placeholder="Full name" required="" name="name">
            </div>
            <div class="form-group">
                <input type="email" placeholder="Email" required="" name="mail">
            </div>
            <div class="form-group">
                <input type="password" placeholder="Password" required="" name="pass">
            </div>
            <div class="form-group">
                <input type="password" placeholder="Confirm Password" required="" name="cpass">
            </div>
            <button type="submit" class="btn" name="sgnup">SIGN UP</button>
            <div class="account-exist">
                Already have an account? <a href="login-user.php" id="login">Login</a>
            </div>
        </form>
    </div>

    <script src="main.js"></script>
</body>
</html>