<?php require_once "control.php"; ?>
<?php 
    $email = $_SESSION['email'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style3.css">
</head>
<body>
    <section class="wrapper">
		<div class="container cen">
			<div class="col-sm-8 offset-sm-2 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4 text-center">
				<form class="rounded bg-white shadow p-5" action="new-password.php" method="POST">
					<h3 class="text-dark fw-bolder fs-4 mb-2">New Password</h3>  

                    <?php 
                    if(isset($_SESSION['info'])){
                        ?>
                        <div class="alert alert-success text-center">
                            <?php echo $_SESSION['info']; ?>
                        </div>
                        <?php
                    }
                    ?>
                    <?php
                    if(count($errors) > 0){
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>

					<div class="form-floating mb-3">
                        <input class="form-control" type="password" name="password" placeholder="Create new password" required>
                        <label>Create new password</label>
					</div>  
                    <div class="form-floating mb-3">
                        <input class="form-control" type="password" name="cpassword" placeholder="Confirm your password" required>
                        <label>Confirm your password</label>
					</div>  
                    

					<button type="submit" class="btn btn-primary submit_btn my-4" name="change-password">Submit</button>
				</form>
			</div>
		</div>
	</section>
    
</body>
</html>