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
	<link rel="stylesheet" type="text/css" href="assets/css/login.css">
	<script src="assets/js/login_ajax.js"></script>
</head>
<body>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header" style="text-align: center;">
				<img src="img/logo.png" width="30%">
				<h3>Sign In</h3>	
			</div>
			<div class="card-body">
				<form method="post" id="login-form">
				<div id="msg" style="width:100%;text-align:center;padding:2px;"></div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="email" class="form-control" id="email" name="email" placeholder="Email" required>		
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" id="password" name="password" placeholder="password" required>
					</div>
					<div class="form-group">
						<input type="hidden" id="login" name="login" value="login_token">
						<input type="submit" value="Login" class="btn float-right login_btn">
					</div>
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Don't have an account?<a href="signup.php">Sign Up</a>
				</div>
				<div class="d-flex justify-content-center">	
					<a href="#">Forgot your password?</a>
				</div>
				<br>
				<a href="index.php" class="btn btn-outline-info btn-sm" style="float:right">Cancel</a>
			</div>
		</div>
	</div>
</div>
</body>
</html>