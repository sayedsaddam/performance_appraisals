<?php
/* Filename: exam_login.php
*  Location: views/test-system/exam_login.php
*  Author: Saddam
*/
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login | Performance Appraisal</title>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta property="og:locale" content="en_US" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="" />
	<meta property="og:description" content="" />
	<meta property="og:url" content="" />
	<meta property="og:site_name" content="" />
	<meta name="og:card" content="" />
	<meta name="og:description" content="" />
	<meta name="og:title" content="" />
	<meta name="og:image" content="" />
	<link href="https://fonts.googleapis.com/css?family=Lato:400,700,900|Open+Sans:400,700,800|Roboto:400,700,900" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
	<script src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
</head>
<body>
	<section class="secLogin">
	<div class="container">
		<div class="loginWhite">
			<div class="row">
				<div class="col-md-6">
					<div class="mainLeftImg">
						<div class="loginLogo">
							<img src="<?php echo base_url('assets/img/loginLogo.png'); ?>" alt="">
						</div>
						<img src="<?php echo base_url('assets/img/login.png'); ?>" alt="">
						<p>
							Hiring staff for Civil Society Human and Institutional development Program (CHIP) in Pakistan.
						</p>
					</div>
				</div>
				<div class="col-md-6">
					<form action="<?php echo base_url('Perf_login/validate'); ?>" method="post">
						<div class="rightLoginMain">
							<div class="aligmentWrap">
								<h3 style="margin-bottom: 4px;">Appraisal's Login</h3>
								<small>Enter your Name & CNIC to proceed.</small>
								<div class="loginInput">
									<input type="hidden" name="eval_date" value="<?php echo date('Y-m-d'); ?>">
									<input name="peo_name" type="text" class="form-control" placeholder="Enter your name here..." required><br>
									<input name="peo_cnic" type="text" class="form-control" placeholder="Enter your cnic as password here..." required>
								</div>
								<div class="loginInput">
									<button type="submit" class="btn btn-block">
										proceed
									</button>
								</div>
								<?php if($failed = $this->session->flashdata('failed')): ?>
								<div class="alert alert-danger alert-dismissable text-center">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									<p><?php echo $failed; ?></p>
								</div>
								<?php endif; ?>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/custom.js'); ?>"></script>
</body>
</html>