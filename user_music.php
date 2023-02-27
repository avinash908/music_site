<?php 
 $id = $_POST['data'];
     include 'DB.php';
     $db = new DB;
     $user_music = $db->user_music($id);
    while ($music = $user_music->fetch_object()) {
        $type = "Song";
        $images = $db->images($type,$music->id);
            if($image = $images->fetch_object()){}
?>
<div class="col-md-3">
    <div class="img img-thumbnail" style="background-image:url('img/<?=$image->name?>');background-size: cover;background-position: center;width:100%;height:280px;margin:2px;">
    <a href="play.php?id=<?=$music->id?>" style="text-decoration:none;font-weight: 600;">
        <div class="overlay">
            <span class="icon">
                <i class="far fa-play-circle"></i>
            </span>
        </div>
            <div class="music-image-bottom">
                <span><?=$music->name?></span>
            </div>
        </a>         
    </div>
</div>
<?php
    }
?>