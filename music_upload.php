<?php
include 'DB.php';
	$db = new DB;
	if (isset($_POST['music'])) {
		$image 		= 	$_FILES['music-image']['name'];
		$image_tmp 	= 	$_FILES['music-image']['tmp_name'];
		$music 		= 	$_FILES['music-file']['name'];
		$music_tmp 	= 	$_FILES['music-file']['tmp_name'];
		$name  		= 	$_POST['name'];
		$description= 	$_POST['description'];
		$category 	= 	$_POST['category'];
		if($music !=''){
			if ($name !='') {
				if($category !=''){
					$data = array('image' => $image,'image_tmp' => $image_tmp,'music' => $music,'music_tmp' => $music_tmp,'name' => $name,'description' => $description,'category' => $category);
					$upload = $db->upload_music($data);
					if($upload){
						echo "uploaded";
					}else{
						echo "<div class='alert alert-danger'>Sorry There is Proplem in Uploading your file</div>";
					}
				}else{
					echo "<div class='alert alert-danger'>Please Choose a category</div>";
				}
			}else{
				echo "<div class='alert alert-danger'>Please Type Music Name</div>";
			}
		}else{
			echo "<div class='alert alert-danger'>Please Select a Music file</div>";
		}
	}
?>