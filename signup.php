<?php
	session_start();
	if (isset($_SESSION['user'])) {
		header('location:index.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<?php require 'links.php' ?>
	<script src="assets/js/validation.js"></script>
	<script src="assets/js/signup_ajax.js"></script>
	<link rel="stylesheet" type="text/css" href="assets/css/signup.css">
</head>
<body>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header" style="text-align: center;">
				<img src="img/logo.png" width="30%">
				<h3>Sign Up</h3>
			</div>
			<div class="card-body">
				<form method="post" id="signup-form">
					<div id="msg" style="width:100%;text-align:center;padding:2px;"></div>
					<div class="input-group form-group">	
						<div class="input-group-prepend">
							<span class="input-group-text username"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" id="username" name="username" placeholder="Username" required>	
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text email"><i class="fas fa-envelope"></i></span>
						</div>
						<input type="email" class="form-control" id="email" name="email" placeholder="email" required>	
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text password"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" id="password" name="password" placeholder="password" required>
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text password"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="confirm password" required>
					</div>
					<div class="form-group">
						<input type="hidden" id="signup" name="signup" value="signup_token">
						<input type="submit" value="Sign Up" id="reg" name="reg" class="btn float-right login_btn">
					</div>
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					If you have an account?<a href="login.php">Login</a>
				</div>
				<br>
				<a href="index.php" class="btn btn-outline-info btn-sm" style="float:right">Cancel</a>
			</div>
		</div>
	</div>
</div>
</body>
</html>