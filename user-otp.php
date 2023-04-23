<?php require_once "control.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
	<!-- Bootstrap 5 CDN Link -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom CSS Link -->
	<link rel="stylesheet" href="style2.css">
</head>
<body> 
    <section class="wrapper">
		<div class="container cen">
			<div class="col-sm-8 offset-sm-2 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4 text-center">
				<form class="rounded bg-white shadow p-5" method="post" action="user-otp.php">
					<h3 class="text-dark fw-bolder fs-4 mb-2">Two Step Verification</h3>

					<div class="fw-normal text-muted mb-4">
						Enter the verification code we sent to
					</div>  

                    <div class="d-flex align-items-center justify-content-center fw-bold mb-4">
                        <?php echo $_SESSION['email']; ?>
                    </div>

					<div class="otp_input text-start mb-2">
                        <?php
                            if(count($errors) > 0){
                            ?>
                            <div style="border-radius: 5px;padding: 11px 15px;box-shadow: 0 0 5px #dc3545;">
                                <?php
                                    foreach($errors as $showerr){
                                        echo $showerr;
                                    }
                                ?>
                            </div>
                            <?php
                            }
                        ?>
                        <label for="digit" style="padding-top:10px;">Type your 6 digit security code</label>
						<div class="d-flex align-items-center justify-content-between mt-2">
                            <input type="text" class="form-control" placeholder="" name="c1" >
                            <input type="text" class="form-control" placeholder="" name="c2" disabled>
                            <input type="text" class="form-control" placeholder="" name="c3" disabled>
                            <input type="text" class="form-control" placeholder="" name="c4" disabled>
                            <input type="text" class="form-control" placeholder="" name="c5" disabled>
                            <input type="text" class="form-control" placeholder="" name="c6" disabled>
                        </div> 
					</div>  

					<button type="submit" class="btn btn-primary submit_btn my-4 mx-auto" id="but" name="check">Submit</button> 

                    <div class="fw-normal text-muted mb-2">
						Didn't get the code ? <a href="#" class="text-primary fw-bold text-decoration-none">Resend</a>
					</div>
				</form>
			</div>
		</div>
	</section>
    <script>
        const inputs = document.querySelectorAll("input"),
        button = document.querySelector("button");

        inputs.forEach((input, index1) => {
            input.addEventListener("keyup", (e) => {
                const currentInput = input,
                nextInput = input.nextElementSibling,
                prevInput = input.previousElementSibling;

                if(currentInput.value.length > 1){
                    currentInput.value = "";
                    return;
                }
                if(nextInput && nextInput.hasAttribute("disabled") && currentInput.value !== ""){
                    nextInput.removeAttribute("disabled");
                    nextInput.focus();
                }

                // backpresed is pressed
                if(e.key === "Backspace"){
                    inputs.forEach((input, index2) => {
                        if(index1 <= index2 && prevInput){
                            input.setAttribute("disabled", true);
                            currentInput.value = "";
                            prevInput.focus();
                        }
                    })
                }
            })
        })

        window.addEventListener("load", () => inputa[0].focus())
    </script>
</body>
</html>

