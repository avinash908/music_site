<?php 
class DB
{
	protected function connect()
	{
		$this->host = "localhost";
		$this->username = "root";
		$this->password = "";
		$this->database = "music_site";

		$connection = new mysqli($this->host,$this->username,$this->password,$this->database) or die('conntection error');
		return $connection;
	}
	public function query($query)
	{
		$db = $this->connect();
		$query = $db->query($query);
		if ($query) {
			return $query;
		}
		return false;
	}
	public function login($email,$password){
		$query = "SELECT id FROM users WHERE  email = '".$email."' AND password = '".md5($password)."' ";
		$result = $this->query($query);
		if($result){
			return $result;
		}else{
			return false;
		}
	}
	public function categories(){
		$query = "SELECT * FROM categories ORDER BY id";
		$result = $this->query($query);
		if($result){
			return $result;
		}else{
			return false;
		}
	}
	public function signup($username,$email,$password){
		$query = "INSERT into users (username,email,password)values('".$username."','".$email."','".md5($password)."')";
		$result = $this->query($query);
		if($result){
			$user_rec = $this->query("SELECT * FROM users WHERE email = '".$email."'");
			if($user = $user_rec->fetch_object()){
				$insert_image = $this->query("INSERT INTO images (name,imageable_type,imageable_id)values('avatar.png','User','".$user->id."')");
			}
			return $result;
		}else{
			return false;
		}
	}
	public function profile($id){
		$query = "SELECT * FROM users WHERE id = '".$id."' ";
		$result = $this->query($query);
		if($result){
			return $result;
		}else{
			return false;
		}
	}
	public function upload_music($data){
		session_start();
		$ext = explode(".",$data['music']);
		$new_music_file_name = round(microtime(true)) . "." . end($ext);
		$uniq_music_name = uniqid().$new_music_file_name;
		$upload = move_uploaded_file($data['music_tmp'],"music/".$uniq_music_name);
		if($upload){
			$query = "INSERT INTO songs (music_file,name,description,user_id,category)values('".$uniq_music_name."','".$data['name']."','".$data['description']."','".$_SESSION['user']."','".$data['category']."')";
			$result = $this->query($query);
			if ($result) {
				if($data['image']){

					$img_ext = explode(".",$data['image']);
					$new_image_file_name = round(microtime(true)) . "." . end($img_ext);
					$uniq_image_name = uniqid().$new_image_file_name;
					
					$upload_image = move_uploaded_file($data['image_tmp'],"img/".$uniq_image_name);
					if($upload_image){
						$rec = $this->query("SELECT id FROM songs WHERE name = '".$data['name']."' AND category = '".$data['category']."' AND user_id = '".$_SESSION['user']."' ");
						if ($dt = $rec->fetch_object()) {
							$insert = $this->query("INSERT INTO images (name,imageable_type,imageable_id)values('".$uniq_image_name."','Song','".$dt->id."')");
						}
					}
				}else{
					$rec = $this->query("SELECT id FROM songs WHERE name = '".$data['name']."' AND category = '".$data['category']."' AND user_id = '".$_SESSION['user']."' ");
						if ($dt = $rec->fetch_object()) {
							$insert = $this->query("INSERT INTO images (name,imageable_type,imageable_id)values('caset.jpg','Song','".$dt->id."')");
						}
				}
				return $result;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	public function user_music($user_id){
		$query = "SELECT * FROM songs  WHERE user_id = '".$user_id."' ORDER BY id DESC";
		$result = $this->query($query);
		if ($result) {
			return  $result;
		}else{
			return false;
		}
	}
	public function change_dp($image_name,$image_tmp,$type,$id){
		$img_ext = explode(".",$image_name);
		$new_image_name = round(microtime(true)) . "." . end($img_ext);
		$uniq_image_name = uniqid().$new_image_name;

		$upload = move_uploaded_file($image_tmp,"img/".$uniq_image_name);
		if ($upload) {
			$query = "UPDATE images set name = '".$uniq_image_name."' ,imageable_type = '".$type."' WHERE imageable_id = '".$id."' ";
			$result = $this->query($query);
			if($result){
				return $result;
			}else{
				return false;
			}
		}
	}
	public function images($type,$id){
		$query = "SELECT * FROM images WHERE imageable_type = '".$type."' AND imageable_id = '".$id."' ";
		$result = $this->query($query);
		if ($result) {
			return $result;
		}else{
			return false;
		}
	}
	public function eightsongs(){
		$query = "SELECT * FROM songs ORDER BY id DESC LIMIT 8";
		$result = $this->query($query);
		if ($result) {
			return $result;
		}else{
			return false;
		}
	}
	public function allmusic($per_page,$start){
		$query = "SELECT * FROM songs ORDER BY id DESC LIMIT ".$per_page." OFFSET ".$start." ";
		$result = $this->query($query);
		if ($result) {
			return $result;
		}else{
			return false;
		}
	}
	public function search($value){
		$query = "SELECT * FROM songs WHERE name like '%".$value."%' OR category like '%".$value."%' ";
		$result = $this->query($query);
		if ($result) {
			return $result;
		}else{
			return false;
		}
	}
	public function play($id){
		$query = "SELECT * FROM songs WHERE id = '".$id."' ";
		$result = $this->query($query);
		$found = mysqli_num_rows($result);
		if ($found>0) {
			return $result;
		}else{
			return false;
		}
	}
	public function category_wise($category){
		$query = "SELECT * FROM songs WHERE category = '".$category."' ORDER BY id DESC";
		$result = $this->query($query);
		if ($result) {
			return $result;
		}else{
			return false;
		}
	}
	public function commmets($type,$id){
		$query = "SELECT * FROM comments WHERE commentable_type = '".$type."' AND commentable_id = '".$id."' ORDER BY id";
		$result = $this->query($query);
		if ($result) {
			return $result;
		}else{
			return false;
		}
	}
	public function do_comment($commentable_type,$commentable_id,$user_id,$body){
		$query = "INSERT into comments (body,user_id,commentable_type,commentable_id)values('".$body."','".$user_id."','".$commentable_type."','".$commentable_id."')";
		$result = $this->query($query);
		if ($result) {
			return $result;
		}else{
			false;
		}
	}
}
?>