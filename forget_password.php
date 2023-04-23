<?php require_once "control.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password</title>
	<!-- Bootstrap 5 CDN Link -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom CSS Link -->
	<link rel="stylesheet" href="style3.css">
</head>
<body> 
    <section class="wrapper">
		<div class="container cen">
			<div class="col-sm-8 offset-sm-2 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4 text-center">
				<form class="rounded bg-white shadow p-5" method="post" action="forget_password.php">
					<h3 class="text-dark fw-bolder fs-4 mb-2">Forget Password ?</h3>

					<div class="fw-normal text-muted mb-4">
						Enter your email to reset your password.
					</div>  

                    <?php
                        if(count($errors) > 0){
                            ?>
                            <div class="alert alert-danger text-center" id="denger">
                                <?php 
                                    foreach($errors as $error){
                                        echo $error;
                                    }
                                ?>
                            </div>
                            <?php
                        }
                    ?>

					<div class="form-floating mb-3">
						<input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
						<label for="floatingInput">Email address</label>
					</div>  

					<button type="submit" class="btn btn-primary submit_btn my-4" name="check-email">Submit</button>
				</form>
			</div>
		</div>
	</section>
</body>
</html>

