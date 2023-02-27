<?php
$song_id = $_POST['id'];
$song_type = $_POST['type'];
	include 'DB.php';
	$db = new DB;
	$comments = $db->commmets($song_type,$song_id);
	if (mysqli_num_rows($comments)>0) {
		while ($comment = $comments->fetch_object()) {
			$user_rec = $db->profile($comment->user_id);
			$user_img = $db->images("User",$comment->user_id);
			$user = $user_rec->fetch_object();
			$img = $user_img->fetch_object();
?>
<div class="media mb-4">
	<img class="d-flex mr-3 rounded-circle" src="img/<?=$img->name?>" width="6%" alt="">
	<div class="media-body">
		<h5 class="mt-0"><?=$user->username?></h5>
		<?=$comment->body?>
	</div>
</div>
<?php 
	}
		}
?>