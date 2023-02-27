<?php
  session_start();
  include 'DB.php';
	if (!isset($_SESSION['user'])) {
		header('location:login.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
  <title>upload</title>
  <?php require 'links.php'; ?>
  <script src="assets/js/upload_music_ajax.js"></script>
  <script type="text/javascript">
    function preview_image(event){
      var reader = new FileReader();
      reader.onload = function(){
        var output_img = document.getElementById('output-img');
        output_img.src = reader.result;
      }
      reader.readAsDataURL(event.target.files[0]);
    }
  </script>
</head>
<body>
    <!-- Navigation -->
      
    <!-- end Navigation -->
     <p><br></p>

    <!-- content -->
<div class="container">
  <div class="row">
    <div class="col-lg-2"></div>

    <div class="col-lg-8">
      <div class="jumbotron music-container">
        <h2 class="heading" align="center">UPLOAD MUSIC</h2>
        <div id="output"></div>
        <br>
          <form method="post" enctype="multipart/form-data" id="music-upload">
              <div class="form-group">
                <label>Music Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
              </div>
              <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" id="description" name="description"></textarea>
              </div>
              <div class="form-group">
                <label>Music File</label>
                <input type="file" accept="audio/mp3" id="music-file" name="music-file" class="form-control" required>
              </div>
              <div class="form-group">
                <label>Choose Category</label>
                <select name="category" id="category" class="form-control" placeholder="category" required>
                <option value=""></option>
                  <?php 
                    $db = new DB;
                    $categories = $db->categories();
                    while ($row = $categories->fetch_object()) {                            
                  ?>
                    <option value="<?=$row->category?>"><?=$row->category?></option>
                  <?php }?>
                <select>
              </div>
              <div class="form-group">
                <label>Music Image</label>
                <input type="file" accept="image/*" id="music-image" name="music-image" onchange="preview_image(event)" class="form-control">
              </div>
              <div class="form-group">
                <input type="hidden" value="music_token" id="music" name="music">

                <!-- Progress Bar -->
                <div class="progress" id="uploading" style="display:none">
                  <div class="progress-bar" id="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                    <span class="sr-only">0%</span>
                  </div>
                </div>
                <br>
                <input type="submit" value="UPLOAD" class="btn btn-outline-info btn-lg">
              </div>
          </form>
            <!-- prieview Zone -->
            <div class="priview-box" style="text-align:center;padding:10px;">
              <img id="output-img" width="200px" />
            </div>
      </div>
    </div>
  </div>   
</div>
  <!-- End content -->

    <!-- Footer -->
      <?php require 'footer.php'; ?>
    <!-- End Footer -->
</body>
</html>