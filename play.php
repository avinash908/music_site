<?php  
	session_start();
	if (isset($_GET['id']) && is_numeric($_GET['id'])) {
		include 'DB.php';
		$db = new DB;
		$id = $_GET['id'];
		    $music = $db->play($id);
        if ($play = $music->fetch_object()) {
            $image = $db->images("Song",$play->id);
            $music_img = $image->fetch_object();
            $rec = $db->profile($play->user_id);
            $user = $rec->fetch_object();
        }else{
          header('location:index.php');
        }
  }else{
		header('location:index.php');
	}
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Play</title>
    <?php require 'links.php' ?>
    
    <script>
      $(document).ready(function(){
        var music = document.getElementById('current_song');
        music.ontimeupdate = function(){
          $(".progress-bar").css('width',music.currentTime/music.duration*100+'%');
        }
        $('#pause').click(function() {
          var music = document.getElementById('current_song');
          if (!music.paused) {
                music.pause();
                $("#pauseicon").attr('class','fa fa-play');
          } else {
                music.play();
                $("#pauseicon").attr('class','fa fa-pause');
          }
        });
        $("#stop").click(function(){
          var music = document.getElementById('current_song');
          music.pause();
          music.currentTime = 0;
          $("#pauseicon").attr('class','fa fa-play');                        
        })
        $("#next").click(function(){
          var music = document.getElementById('current_song');
          music.currentTime++;
          
        })
        $("#previous").click(function(){
          var music =document.getElementById('current_song');
          music.currentTime--;
        })
        $("#volume").click(function(){
          var music = document.getElementById('current_song');
          if(music.volume != 0){
             music.volume = 0;
            $("#volumeicon").attr('class','fa fa-volume-down');
          }else{
            music.volume = 1.0;
            $("#volumeicon").attr('class','fa fa-volume-up');
          }
        })
      })
    </script>
  </head>
  <body>

    <!-- Navigation -->
    <?php require 'nav.php' ?>
   <!-- End Navigation -->
   <p><br></p>
    <!-- Page Content -->
    <div class="container">
      
      <div class="row">

        <!-- Post Content Column -->
        <div class="col-lg-8">
          <div class="jumbotron music-container">

          <!-- Title -->
          <h2 class="heading"><?=$play->name?></h2>

          <!-- Author -->
          <p class="lead">
            by
            <a href="profile.php?id=<?=$user->id?>"><?=$user->username?></a>
          </p>

          <hr>

          <!-- Date/Time -->
          <p>Posted on <?=$play->posted_on?></p>

          <hr>

          <!-- Music Image -->
          <div class="row">
            <div class="col-lg-12">
              <div class="musicplayer" style="text-align:center">
                <img class="img img-thumbnail img-responsive" src="img/<?=$music_img->name?>" alt="" style="width:80%;height:300px;">
                <br>
                <audio style="display:none" id="current_song" autoplay>
                  <source src="music/<?=$play->music_file?>">
                </audio>
                <br>
                <div class="progress" style="width:80%;margin:auto">
                  <div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <br> 
                <div class="btn-group btn-group-justified">
                  <button class="btn btn-outline-info btn-lg" id="previous"><i class="fa fa-backward"></i></button>
                  <button class="btn btn-outline-info btn-lg" id="pause"><i class="fa fa-pause" id="pauseicon"></i></button>
                  <button class="btn btn-outline-info btn-lg" id="stop"><i class="fa fa-stop"></i></button>
                  <button class="btn btn-outline-info btn-lg" id="next"><i class="fa fa-forward"></i></button>
                  <button class="btn btn-outline-info btn-lg" id="volume"><i class="fas fa-volume-up" id="volumeicon"></i></span></button>
                </div>
              </div>
            </div>
          </div>
          <hr color="yellow">

          <!-- Post Content -->
          <p class="lead"><?=$play->description?></p>
          <hr>

          <!-- Comments Form -->
          <div class="card my-4" style="background-color: #2d2c2c;">
            <h5 class="card-header" >Leave a Comment:</h5>
            <div class="card-body">
              <form method="post" id="comment-form">
                <div class="form-group">
                  <textarea class="form-control" rows="3" id="body" name="body"></textarea>
                </div>
                <input type="hidden" id="comment_token" name="comment_token" value="comment_token">
                <input type="hidden" id="sid" name="sid" value="<?=$play->id?>">
                <input type="hidden" id="tip" name="tip" value="Song">
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
          <script>
            $(document).ready(function(){
              $("#comment-form").on('submit',function(e){
                e.preventDefault();
                $.ajax({
                  url:'do_comment.php',
                  method:'POST',
                  data:new FormData(this),
                  contentType:false,
                  cache:false,
                  processData:false,
                  success:function(data){
                    if(data == 'done'){
                      $("#comment-form")[0].reset();
                    }else{
                      swal(data,"","info");
                    }
                  }
                })
              })
            })
          </script>
          <!-- Comments -->
          <div id="comments"></div>
          <script>
            $(document).ready(function(){
              // setInterval(function(){
               var song_id = $("#sid").val();
               var song_type = $("#tip").val();
                $("#comments").load("comments.php",{'id':song_id,'type':song_type});
              // },300);
            })
          </script>
          
        </div>
      </div>
      

        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">
        <div class="jumbotron music-container">
          <!-- Search Widget -->
          <div class="card my-4" style="background-color: #2d2c2c;">
            <h5 class="card-header">Search</h5>
            <div class="card-body">
            <form action="search.php" method="get">
              <div class="input-group">
                <input type="text" class="form-control" name="value" placeholder="Search..." required>
                <span class="input-group-btn ">
                  <button class="btn btn-outline-warning" type="submit">Go!</button>
                </span>
              </div>
            </form>
            </div>
          </div>
          <?php 
            $data = $db->category_wise($play->category);
              while ($rel = $data->fetch_object()) {
                $related_images = $db->images("Song",$rel->id);
                $rel_img = $related_images->fetch_object();
          ?>
          <!-- Side Widget -->
          <div class="card my-4" style="background-color: #2d2c2c;">
            <h5 class="card-header"><?=$rel->name?></h5>
            <div class="card-body">
              
                <img src="img/<?=$rel_img->name?>" width="100%">
                  <div class="overlay">
                    <a href="play.php?id=<?=$rel->id?>" class="icon">
                      <i class="fa fa-play" style="color:white;"></i> 
                    </a>
                  </div>
            </div>
          </div>

          <?php 
              }
          ?>
          </div>
        </div>

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Footer -->
      <?php require 'footer.php' ?>
    <!-- Endfooter -->
  </body>

</html>
