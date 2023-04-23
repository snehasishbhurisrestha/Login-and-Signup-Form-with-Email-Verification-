<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    session_start();
    require "connection.php";
    $email = "";
    $name = "";
    $errors = array();


    if(isset($_POST['sgnup'])){
        $name = mysqli_real_escape_string($conn,$_POST['name']);
        $email = mysqli_real_escape_string($conn,$_POST['mail']);
        $password = mysqli_real_escape_string($conn,$_POST['pass']);
        $cpassword = mysqli_real_escape_string($conn,$_POST['cpass']);

        if($password !== $cpassword){
            $errors['password'] = "Confirm password not matched!";
        }
        $check_email = "SELECT * FROM users WHERE Email = '$email'";
        $res = mysqli_query($conn, $check_email);
        if(mysqli_num_rows($res) > 0){
            $errors['email'] = "Email that you have entered is already exist!";
        }
        if(count($errors) === 0){
            $encpass = password_hash($password, PASSWORD_BCRYPT);
            $code = rand(999999, 111111);
            $status = "Not Verified";
            $insert_data = "INSERT INTO users (Name, Email, Password, code, Email_status)
                        values('$name', '$email', '$password', '$code', '$status')";
            $data_check = mysqli_query($conn, $insert_data);

            if($data_check){
                $mail = new PHPMailer(true);

                $mail->isSMTP();                                        
                $mail->Host       = 'smtp.gmail.com';                    
                $mail->SMTPAuth   = true;                         
                $mail->Username   = 'snehasish7031@gmail.com';               
                $mail->Password   = 'ulspkjcxzmowkfpe';                         
                $mail->SMTPSecure = 'ssl';      
                $mail->Port       = 465; 

                $mail->setFrom('snehasish7031@gmail.com');
                $mail->addAddress($email); 

                //Content
                $mail->isHTML(true);                         
                $mail->Subject = 'Email Verification Code';
                $msg = "Your verification code is <b>$code</b>";
                $mail->Body = $msg;
                if($mail->send()){
                    $_SESSION['email'] = $email;
                    $_SESSION['password'] = $password;
                    header('location: user-otp.php');
                    exit();
                }else{
                    $errors['otp-error'] = "Failed while sending code!";
                }
            }else{
                $errors['db-error'] = "Failed while inserting data into database!";
            }
        }
    }



    //if user click verification code submit button
    if(isset($_POST['check'])){
        $_SESSION['info'] = "";
        $arr = array();
        $arr[0] = (int)mysqli_real_escape_string($conn, $_POST['c1']);
        $arr[1] = (int)mysqli_real_escape_string($conn, $_POST['c2']);
        $arr[2] = (int)mysqli_real_escape_string($conn, $_POST['c3']);
        $arr[3] = (int)mysqli_real_escape_string($conn, $_POST['c4']);
        $arr[4] = (int)mysqli_real_escape_string($conn, $_POST['c5']);
        $arr[5] = (int)mysqli_real_escape_string($conn, $_POST['c6']);
        $otp_code = 0;
        for($i=0;$i<6;$i++){
            $otp_code = ($otp_code*10)+$arr[$i];
        }

        $check_code = "SELECT * FROM users WHERE code = $otp_code";
        $code_res = mysqli_query($conn, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $fetch_code = $fetch_data['code'];
            $email = $fetch_data['Email'];
            $code = 0;
            $status = 'Verified';
            $update_otp = "UPDATE users SET code = $code, Email_status = '$status' WHERE code = $fetch_code";
            $update_res = mysqli_query($conn, $update_otp);
            if($update_res){
                $_SESSION['name'] = $name;
                $_SESSION['email'] = $email;
                // echo '<script>alert("Verification Successfull. Now you can login with your Email and Password.");</script>';
                header('location: login-user.php');
                exit();
            }else{
                $errors['otp-error'] = "Failed while updating code!";
            }
        }else{
            $errors['otp-error'] = "You've entered incorrect code!";
        }
    }



    //if user click login button
    if(isset($_POST['login'])){
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $check_email = "SELECT * FROM users WHERE Email = '$email'";
        $res = mysqli_query($conn, $check_email);
        if(mysqli_num_rows($res) > 0){
            $fetch = mysqli_fetch_assoc($res);
            $fetch_pass = $fetch['Password'];
            // if(password_verify($password, $fetch_pass)){
            if($password == $fetch_pass){
                $_SESSION['email'] = $email;
                $status = $fetch['Email_status'];
                if($status == 'Verified'){
                    $_SESSION['email'] = $email;
                    $_SESSION['password'] = $password;
                    header('location: home.php');
                }else{
                    $info = "It's look like you haven't still verify your email - $email";
                    $_SESSION['info'] = $info;
                    header('location: user-otp.php');
                }
            }else{
                $errors['email'] = "Incorrect email or password!";
            }
        }else{
            $errors['email'] = "It's look like you're not yet a member! Click on the bottom link to signup.";
        }
    }

    //if user click continue button in forgot password form
    if(isset($_POST['check-email'])){
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $check_email = "SELECT * FROM users WHERE Email='$email'";
        $run_sql = mysqli_query($conn, $check_email);
        if(mysqli_num_rows($run_sql) > 0){
            $code = rand(999999, 111111);
            $insert_code = "UPDATE users SET code = $code WHERE Email = '$email'";
            $run_query =  mysqli_query($conn, $insert_code);
            if($run_query){

                $mail = new PHPMailer(true);

                $mail->isSMTP();                                        
                $mail->Host       = 'smtp.gmail.com';                    
                $mail->SMTPAuth   = true;                         
                $mail->Username   = 'snehasish7031@gmail.com';               
                $mail->Password   = 'ulspkjcxzmowkfpe';                         
                $mail->SMTPSecure = 'ssl';      
                $mail->Port       = 465; 

                $mail->setFrom('snehasish7031@gmail.com');
                $mail->addAddress($email); 

                //Content
                $mail->isHTML(true);                         
                $mail->Subject = 'Password Reset Code';
                $msg = "Your password reset code is <b>$code</b>";
                $mail->Body = $msg;
                if($mail->send()){
                    $info = "We've sent a passwrod reset otp to your email - $email";
                    $_SESSION['info'] = $info;
                    $_SESSION['email'] = $email;
                    echo $_SESSION['email'];
                    header('location: reset-code.php');
                    exit();
                }else{
                    $errors['otp-error'] = "Failed while sending code!";
                }
            }else{
                $errors['db-error'] = "Something went wrong!";
            }
        }else{
            $errors['email'] = "This email address does not exist!";
        }
    }



    //if user click check reset otp button
    if(isset($_POST['check-reset-otp'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($conn, $_POST['otp']);
        $check_code = "SELECT * FROM users WHERE code = $otp_code";
        $code_res = mysqli_query($conn, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $email = $fetch_data['Email'];
            // echo $_SESSION['email'];
            $info = "Please create a new password that you don't use on any other site.";
            $_SESSION['info'] = $info;
            header('location: new-password.php');
            exit();
        }else{
            $errors['otp-error'] = "You've entered incorrect code!";
        }
    }


    //if user click change password button
    if(isset($_POST['change-password'])){
        $_SESSION['info'] = "";
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
        if($password !== $cpassword){
            $errors['password'] = "Confirm password not matched!";
        }else{
            $code = 0;
            $email = $_SESSION['email']; //getting this email using session
            $update_pass = "UPDATE users SET code = $code, Password = '$password' WHERE Email = '$email'";
            $run_query = mysqli_query($conn, $update_pass);
            // $run_query = false;
            if($run_query){
                // $info = "Your password changed. Now you can login with your new password.";
                // $_SESSION['info'] = $info;
                // echo '<script>alert("Your password changed. Now you can login with your new password.")</script>';
                header('Location: login-user.php');
            }else{
                $errors['db-error'] = "Failed to change your password!";
            }
        }
    }

?>