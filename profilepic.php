<?php
include('DB.php');
$db = new DB;
if(isset($_POST['change_token'])){
    $image_name = $_FILES['profile-pic']['name'];
    $image_tmp = $_FILES['profile-pic']['tmp_name'];
    $type  = "User";
    $id = $_POST['puid'];
    $change = $db->change_dp($image_name,$image_tmp,$type,$id);
    if($change){
        echo "changed";
    }else{
        echo "<div class='alert alert-danger'>Something went wrong</div>";
    }
} 


if (isset($_POST['data'])) { 
  $type = "User";
  $id = $_POST['data'];
  $image = $db->images($type,$id);
    if ($dp = $image->fetch_object()) {
        echo "<img src='img/".$dp->name."' class='img-responsive' style='height: 100%;width: 100%'> ";
    }else{
        echo "noimage";
    }  
}
?>