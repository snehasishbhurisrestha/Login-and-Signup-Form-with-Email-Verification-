<?php require_once "control.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code Verification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style3.css">
</head>
<body>
    <section class="wrapper">
		<div class="container cen">
			<div class="col-sm-8 offset-sm-2 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4 text-center">
				<form class="rounded bg-white shadow p-5" method="post" action="forget_password.php">
					<h3 class="text-dark fw-bolder fs-4 mb-2">Code Verification</h3>

                    <?php 
                    if(isset($_SESSION['info'])){
                        ?>
                        <div class="alert alert-success text-center" style="padding: 0.4rem 0.4rem">
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
						<input type="number" name="otp" class="form-control" placeholder="reset code" required>
                        <label>Reset Code</label>
					</div>  

					<button type="submit" class="btn btn-primary submit_btn my-4" name="check-reset-otp">Submit</button>
				</form>
			</div>
		</div>
	</section>
</body>
</html>