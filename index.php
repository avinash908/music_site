<?php  
  session_start();
  include 'DB.php';
  $db = new DB;
?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Music Player</title>
    <?php require 'links.php'; ?>
    <script>
      $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
      });
      </script>
  </head>

  <body>
    <!-- Navigation -->
      <?php require 'nav.php'; ?>
    <!-- end Navigation -->
    <p><br></p>
     <div class="container">
     <div class="jumbotron music-container" style="border-top:0px;">
        <form action="search.php" method="get" class="row">
          <div class="col-lg-12 ">
          <div class="input-group input-group-lg">
              <input type="text" name="value" class="form-control" placeholder="Search......" required>
              <div class="input-group-append">
                  <input type="submit" value="Search" class="btn btn-outline-warning">
              </div>
            </div>
          </div>
        </form>
      </div>
      </div>
  <!-- slider -->
     <!-- Swiper -->
    <div class="container">
     <div class="jumbotron music-container">
      <h2 class="heading">Recent Uploaded Music</h2>
      <div class="swiper-container">
        <div class="swiper-wrapper">
        <?php
          $liked_music = $db->eightsongs();
          while($music = $liked_music->fetch_object()) {
            $type = "Song";
            $images = $db->images($type,$music->id);
            if($image = $images->fetch_object()){}
        ?>
          <div class="swiper-slide" style="background-image:url(img/<?=$image->name?>)">
            <a href="play.php?id=<?=$music->id?>">
              <div class="overlay">
                <span class="icon">
                  <i class="far fa-play-circle"></i>
                </span>
              </div>
              <div class="slide-bottom">
              <span><?=$music->name?></span>
            </div>
            </a>
          </div>

        <?php } ?>
        </div>
        <div class="swiper-pagination"></div>
        </div>
      </div>
    </div>
    <!-- end slider -->

      <!-- Page Content -->
<div class="container">
    <div class="jumbotron content-container">
      <!-- Page Heading -->
      <h3 class="heading">All
        <small>Music</small>
      </h3>

    <div class="row text-center">
      <?php
        $per_page = 6;
        isset($_GET['page']) ? $page = $_GET['page'] : $page = 0;
        if ($page > 1) {
          $start = ($page * $per_page) - $per_page;
        }else{
          $start = 0;
        }
          $result = $db->query("SELECT * FROM songs");

            $allmusic = $db->allmusic($per_page,$start);

          $rows = $result->num_rows;
          $total_rec = ($rows / $per_page);
          
          while($music = $allmusic->fetch_object()) {
            $type = "Song";
            $images = $db->images($type,$music->id);
            if($image = $images->fetch_object()){}
      ?>
      <div class="col-sm-4">
        <div class="card" style="background-color: #2d2c2c;margin:8px;">
            <h5 class="card-header"><?=$music->name?></h5>
                <div class="card-body">  
                  <img src="img/<?=$image->name?>" width="280px;" height="280px">
                    <div class="overlay">
                      <a href="play.php?id=<?=$music->id?>" class="icon">
                        <i class="fa fa-play" style="color:white;"></i> 
                      </a>
                    </div>
                </div>
          </div>
        </div>
        <?php } ?>
    </div>
      <!-- /.row -->
            <br>
      <!-- Pagination -->
      <ul class="pagination justify-content-center">
        <li class="page-item">
          <a class="page-link" href="?page=<?=$page-1?>" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
          </a>
        </li>
        <?php 
          for($i = 1; $i <=$total_rec + 1; $i++){
        ?>
          <li class="page-item">
            <a class="page-link" href="?page=<?=$i?>"><?=$i?></a>
          </li>
        <?php 
          } 
        ?>
        <li class="page-item">
          <a class="page-link" href="?page=<?=$page+1?>" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Next</span>
          </a>
        </li>
      </ul>
  </div>
</div>
    <!-- /.container -->

    <!-- Footer -->
    <?php require 'footer.php'; ?>
    <!-- End Footer -->
<!-- Initialize Swiper -->
<script>
  var swiper = new Swiper('.swiper-container', {
    slidesPerView: 3,
    spaceBetween: 30,
    freeMode: true,
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
  });
</script>
  </body>

</html>
