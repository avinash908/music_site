<?php  
  session_start();
  if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
	$user_id = $_GET['id'];
		include 'DB.php';
		$db = new DB;
		$user_rec = $db->profile($user_id);
		if ($data = $user_rec->fetch_object()) {}
		echo "<input type='hidden' value='".$data->id."' id='id' name='id'>";
  }else{
	  header('location:index.php');
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
	<?php require 'links.php'; ?>
</head>
<body>
	<!-- Navigation -->
		<?php require 'nav.php' ?>
	<!-- End Navigation -->
	 <p><br></p>
	<!-- Content -->
	<div class="container">
		<div class="jumbotron music-container" style="border-top: 0px;">
			<div class="row">
				<div class="col-md-4">
					<div class="text-center" style="text-align: center!important;height: 260px;width: 80%;margin: auto;">
  						<input type="hidden" value="<?=$data->id?>" id="profile_id" value="profile_id">
							<script>
							$(document).ready(function(event){
									$("#changedp").on('submit',function(event){
										event.preventDefault();
										$.ajax({
											url:"profilepic.php",
											method:"POST",
											data: new FormData(this),
											contentType:false,
											cache:false,
											processData:false,
											success:function(data){
												if(data =="changed"){
													$("#dperror").html("<div class='alert alert-success'>Dp Changed</div>");
												}else{
													$("#dperror").html(data);
												}
											}
										})
									})		
							})
							</script>
						  <script>
							$(document).ready(function(){
								setInterval( function(){
									var id = $("#profile_id").val();
									$.ajax({
										url:'profilepic.php',
										method:'POST',
										data:{data:id},
										success:function(data){
											if (data == 'noimage') {
												$("#profile-pic").html("<img src='img/avatar.png' class='img-responsive'  style='height: 100%;width: 100%'>");
											}else{
												$("#profile-pic").html(data);
											}
										}
									})
								}, 800);
							})
					  	</script>
						
						<div id="profile-pic" style="height:100%"></div>
						<form method="post" id="changedp" enctype="multipart/form-data">
							<input type="hidden" value="change_image" id="change_token" name="change_token">
							<input type="hidden" value="<?=$data->id?>" id="puid" name="puid">
								<div class="input-group">
									<input type="file" name="profile-pic" id="profile-pic" class="form-control">
									<span class="input-group-prepend">
										<button type="submit" class="btn btn-outline-info">Change</button>
									</span>
								</div>
						</form>
				  	 <br>
				 		<br>
					</div>
				</div>
				<div class="col-md-8">
					<div class="jumbotron music-container">
					<div id="dperror"></div>
						<h2><?=$data->username?></h2>
						<br>
						<p><b>Email :</b> <?=$data->email?></p>
						<p><b>Created :</b> <?=$data->created_at?></p>
					</div>
				</div>
			</div>
			<hr color="#1ba4a4">
			<script>
				$(document).ready(function(){
					var id = $("#id").val();
					$.ajax({
						url:'user_music.php',
						method:'POST',
						data:{data:id},
						success:function(data){
							$("#display_music").html(data);
						}
					})
				})
			</script>
			<div id="display_music" class="row">
				
			</div>
		</div>
	</div>
	<!-- EndConent -->
	<!-- footer -->
		<?php require 'footer.php'; ?>
	<!-- endfooter -->
</body>
</html>