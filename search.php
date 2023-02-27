<?php  
	session_start();
	if (isset($_GET['value'])) {
		include 'DB.php';
		$db = new DB;
		$value = $_GET['value'];
		$search = $db->search($value);
		$found = mysqli_num_rows($search);
  }else{
		header('location:index.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Search</title>
	<?php require 'links.php'; ?>
</head>
<body>
	<!-- Navigation -->
	<?php require 'nav.php'; ?>
	<!-- End Navigation -->
	<p><br></p>
	<!-- Search -->
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
	<!-- End Search -->

	<!-- Results -->
<div class="container">
	<div class="jumbotron music-container">
			<hgroup class="mb20" style="margin-left:12px;">
				<h1 class="heading">Search Results</h1>
				<h2 class="lead"><span class="badge badge-secondary"><?=$found?></span> results found for <strong class="text-warning"><?=$value?></strong></h2>								
			</hgroup>
		<section class="col-xs-12 col-sm-6 col-md-12">
		<?php 
					while($data = $search->fetch_object()){
						$type = "Song";
            $images = $db->images($type,$data->id);
						if($image = $images->fetch_object()){}
		?>
			<div class="jumbotron" style="background-color:#2d2c2c;">
				<article class="search-result row">
						<div class="col-xs-12 col-sm-12 col-md-4">
							<a href="play.php?id=<?=$data->id?>" title="<?=$data->name?>" class="thumbnail"><img src="img/<?=$image->name?>" width="100%" alt="<?=$data->name?>" /></a>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-3">
							<br>
							<p style="font-size:12px;"><i class="fa fa-user"></i> Posted By : <span style="font-size:16px;"><?="Sahir Sq"?></span></p>				
							<p style="font-size:12px;"><i class="fa fa-list-alt"></i> Categroy : <span style="font-size:16px;"><?=$data->category?></span></p>
							<p style="font-size:12px;"><i class="fa fa-calendar"></i> Posted on : <span style="font-size:12px;"><?=$data->posted_on?></span></p>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-5 excerpet">
							<h3><a href="play.php?id=<?=$data->id?>" title=""><?=$data->name?></a></h3>
							<p><?=$data->description?></p>
						</div>
						<span class="clearfix borda"></span>
				</article>
		</div>
	<?php } ?>
		</section>
	</div>
</div>
<!-- End Results -->

<!-- footer -->
	<?php require 'footer.php'; ?>
<!-- End Footer -->
</body>
</html>