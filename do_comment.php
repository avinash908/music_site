<?php 
session_start();
if (isset($_SESSION['user'])) {
    include 'DB.php';
    $db = new DB;
    if (isset($_POST['comment_token'])) {
        $body = $_POST['body'];
        $song_type = $_POST['tip'];
        $song_id = $_POST['sid'];
        $user_id = $_SESSION['user'];
        $do_comment = $db->do_comment($song_type,$song_id,$user_id,$body);
        if ($do_comment) {
            echo "done";
        }else{
            echo "Something Went Wrong";
        }
    }else{
        echo "<script>window.location.replace('index.php')</script>";
    }
    
}else{
    echo "You Can Not Comment Without Login";
}
?>