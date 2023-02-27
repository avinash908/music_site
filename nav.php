<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top n_bar">
      <div class="container">
        <a class="navbar-brand" href="#">
          <img src="img/logo.png" width="150" height="60" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <?php
            if (!isset($_SESSION['user'])) {
          ?>
              <li class="nav-item">
                <a class="nav-link" href="login.php">Login
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="signup.php">Sign Up
                </a>
              </li>
            <?php } ?>
          </ul>
            <?php if (!isset($_SESSION['user'])) { ?>
              <a class="nav-link" href="upload.php" data-toggle="tooltip" data-placement="bottom" title="You Need To Login For Upload any Music"><span class="btn btn-outline-info"> UPLOAD</span></a>
            <?php }
                else{ ?>
              <a class="nav-link" href="upload.php" data-toggle="tooltip" data-placement="bottom" title="Upload any Music"><span class="btn btn-outline-info"> UPLOAD</span></a>    
                <?php } ?>
          <?php
            if (isset($_SESSION['user'])) {
          ?>
            <a class="nav-link dropdown-toggle" id="navbarDropdownMenu" data-toggle="dropdown">
            <?php 
            $user_image = $db->images("User",$_SESSION['user']);
            $image = $user_image->fetch_object();
            ?>
                  <img src="img/<?=$image->name?>" class="rounded-circle z-depth-0" alt="username" width="32px;"> 
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-secondary" aria-labelledby="navbarDropdownMenu" style="background-color:#ffc103;">
                  <a class="dropdown-item" href="profile.php?id=<?=$_SESSION['user']?>" style="background:#000; color:white;">Profile</a>
                  <a class="dropdown-item" href="#" style="background:#000; color:white;">Settings</a>
                  <a class="dropdown-item" href="logout.php" style="background:#000; color:white;">Logout</a>
                </div>
          <?php } ?>
        </div>
      </div>
    </nav>