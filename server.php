<?php
session_start();
if (isset($_SESSION['user'])) {
	header('location:index.php');
}
	include 'DB.php';
	$db = new DB;
	// login form request 
	if (isset($_POST['login'])) {
		$email = $_POST['email'];
		$password = $_POST['password'];
		if($email != '' && $password != ''){	
			$login = $db->login($email,$password);
			if($user = $login->fetch_object()){
				$_SESSION['user'] = $user->id;
				echo "login";
			}else{
				$error = "<div class='alert alert-danger'>Invalid Email Or Password</div>";
				echo $error; 
			}
		}else{
			$error = "<div class='alert alert-danger'>Please Fill Fields*</div>";
			echo $error;
		}
	}

	// signup form request
	if(isset($_POST['signup']) && !empty($_POST)){
		$username = $_POST['username'];
		$email= $_POST['email'];
		$password = $_POST['password'];
		$confirm_password = $_POST['confirm_password'];
		if(preg_match("/^[a-zA-Z ]*$/",$username)){
			if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
				if(strlen($password)>5){
					if($password == $confirm_password){
						$signup = $db->signup($username,$email,$password);
						if($signup){
							$login = $db->login($email,$password);
							if ($user = $login->fetch_object()) {
								$_SESSION['user'] = $user->id;
								echo  "signup";
							}else{
								echo "<div class='alert alert-danger'>Something Went wrong</div>";
							}
						}else{
							echo "<div class='alert alert-danger'>Invalid Data Inserted</div>";
						}
					}else{
						echo "<div class='alert alert-danger'>Password Not Match</div>";
						echo "<script>$(document).ready(function(){ $('#password,#confirm_password').css('border','1px solid red'); $('.password').css('background-color','red');})</script>";
					}
				}else{
					echo "<div class='alert alert-danger'>Password Must Be at least 6 long</div>";
					echo "<script>$(document).ready(function(){ $('#password,#confirm_password').css('border','1px solid red'); $('.password').css('background-color','red');})</script>";
				}	
			}else{
				echo "<div class='alert alert-danger'>Invalid Email</div>";	
				echo "<script>$(document).ready(function(){ $('#email').css('border','1px solid red'); $('.email').css('background-color','red');})</script>";
			}

		}else{
			echo "<div class='alert alert-danger'>Invalid Username</div>";
			echo "<script>$(document).ready(function(){ $('#username').css('border','1px solid red'); $('.username').css('background-color','red');})</script>";
		}
	}

?>
