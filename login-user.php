<?php require_once "control.php" ?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style1.css">
</head>
<body> 
    <div class="wrapper">
        <div class="headline">
            <h1>Welcome To Our Family</h1>
        </div>
        <form class="form" method="post" action="login-user.php">
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
                <input type="email" placeholder="Email" required="" name="email">
            </div>
            <div class="form-group">
                <input type="password" placeholder="Password" required="" name="password">
            </div>
            <div class="forget-password">
                <div class="check-box">
                    <input type="checkbox" id="checkbox">
                    <label for="checkbox">Remember me</label>
                </div>
                <a href="forget_password.php">Forget password?</a>
            </div>
            <button type="submit" class="btn" name="login">LOGIN</button>
            <div class="account-exist">
                Create New a account? <a href="signup.php" id="signup">Signup</a>
            </div>
        </form>
    </div>

    <script src="main.js"></script>
</body>
</html>