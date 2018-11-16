<?php
	session_start();
	$conn = mysqli_connect("localhost","root","","store");
	$message="";
	if(!empty($_POST["login"])) {
		$result = mysqli_query($conn,"SELECT * FROM user WHERE
		 username = '". $_POST["username"]."' AND 
		  password = '". $_POST["password"]."'");
		$row  = mysqli_fetch_array($result);
		if(is_array($row)) {
		$_SESSION["id"] = $row['id'];
		header('Location: index.php');
		} else {
		$message = "Wrong username or password!";
		}
	}

	?>
<html>
<head>
<title>User Login</title>
<style>

body {
	background: url("img/gray.jpg");
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
	background-size: cover;
}

#frmLogin {
	text-align: center;
	padding: 30px 60px;
	background: rgba(100, 30, 10, 0.);
	border: 5px double rgba(120, 20, 20, 0.5);
	border-radius: 25px;
	display: inline-block;
}

.field-group { 
	margin:20px 100px; 
}

.content {
    max-width: 500px;
    margin: auto;
}

.input-field {
	padding: 8px;
	width: 200px;
	border: #A3C3E7 1px solid;
	border-radius: 4px; 
}
.form-submit-button {
	background: rgba(120, 20, 20, 0.5);
	border: 0;
	padding: 8px 20px;
	border-radius: 4px;
	color: white;
}

.form-submit-button:hover {
	background: rgba(20, 20, 20, 0.5);
	border-radius: 4px;
	color: white;
}

.member-dashboard {
	padding: 40px;
	background: #D2EDD5;
	color: #555;
	border-radius: 4px;
	display: inline-block;
	text-align:center; 
}

.error-message {
	text-align:center;
	color:#FF0000;
}
.demo-content label{
	width:auto;
}
</style>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</head>
<body>
<div>
<div style="display:block;margin:0px auto;">
<?php if(empty($_SESSION["id"])) { ?>

<div class="content">
  
<form action="" method="post" id="frmLogin">
	<div class="error-message"><?php if(isset($message)) { echo $message; } ?></div>	
	<div class="field-group">
		<div><label for="login">Username: </label></div>
		<div><input name="username" type="text" class="input-field"></div>
	</div>
	<div class="field-group">
		<div><label for="password">Password: </label></div>
		<div><input name="password" type="password" class="input-field"> </div>
	</div>
	<div class="field-group">
		<div><input type="submit" name="login" value="Sign in" class="form-submit-button"></span></div>
	</div>       
</form>
</div>

<?php 
	} else { 
	$result = mysqlI_query($conn,"SELECT * FROM user WHERE id='" . $_SESSION["id"] . "'");
	$row  = mysqli_fetch_array($result);
?>

</form>
</div>
</div>
<?php } ?>
</body></html>