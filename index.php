<?php
require_once('connection.php');

if(isset($_POST['submit'])){
	if(isset($_POST['username']) && !empty(trim($_POST['username']))){
		$username = $_POST['username'];
	} else {
		echo "please set username";
		die;
	}
	if(isset($_POST['password']) && !empty(trim($_POST['password']))){
		if(isset($_POST['conf_password']) && !empty(trim($_POST['conf_password']))){
			if($_POST['conf_password'] != $_POST['password']){
				echo "password n conf pass donot match";
				die;
			}
			$pass = $_POST['password'];
		} else {
			
			die('required confirm password field');
		}
	} else {
		die('password required');
	}
	$pass = password_hash($pass, PASSWORD_DEFAULT);
	$results = mysqli_query($connect, 'INSERT INTO users (username, password) VALUES ("'.$username.'", "'.$pass.'")');
	if($results){
		header('location: http://localhost/fatimahyderi/login-assignment/login.php');
	} else{
		echo mysqli_error($connect);
	}
	
}
?>

<html><head></head>
<body>
<form method='post'>
	<label>Username:<input type='text' name='username' value='' /></label>
	<label>Password:<input type='password' name='password' value='' /></label>
	<label>Confirm Password:<input type='password' name='conf_password' value='' /></label>
	<input type='submit' name='submit' value='submit' />
</form>
<?php
