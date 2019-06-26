<?php

session_start();

if( isset($_SESSION['user_id']) ){
	//header("Location:index.php");
}

require_once"connection.php";

//Message variable for success/Error
$message = '';


//Check the variables sent if empty
if(!empty($_POST['username']) && !empty($_POST['password'])):
	
	// create new user 
	$sql = "INSERT INTO users (email,username, password) VALUES (:email, :username, :password)";
	$stmt = $conn->prepare($sql);

	//attach the variables to their respective heads
	$stmt->bindParam(':username', $_POST['username']);
	
	$stmt->bindParam(':email', $_POST['email']);
	//remember to encrypt the password in the database, VERY IMPORTANT
	$stmt->bindParam(':password', password_hash($_POST['password'], PASSWORD_BCRYPT));

	if( $stmt->execute() ):
	
	// echo "<script> window.location.assign('index.php'); </script>";
		$message = 'Successfully registered, You will need approval to access dashboard';
	else:
	
		$message = 'Sorry your account could not be created';
	endif;

endif;

?>

<!DOCTYPE html>
<html>
<head>
	<title>Sign Up</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" href="main.css">
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
</head>
<body>

	<div class="header">
		
	</div>

<script>
	
	$('#password, #passwordconfirm').on('keyup', function () {
  if ($('#password').val() == $('#passwordconfirm').val()) {
    $('#message').html('Matching').css('color', 'green');
  } else 
    $('#message').html('Not Matching').css('color', 'red');
});
	
</script>
	
		<section>
			<div id="loginCard">
				<h3>Sign Up</h3>
				
				<span>or <a href="index.php">login here</a></span>
				<form action="signUp.php" method="POST">
					
					<p  <?php if(!empty($message)): ?>
		<p><?= $message ?></p>
	<?php endif; ?></p>
	
	
					<p>
						
						<label for="username">Username:</label>
						<input type="text" placeholder = "User name" name="username" required>
						
						
					</p>
					
						<label for="username">Email:</label>
						<input type="text" placeholder = "Email" name="email" required>
						
						</p>
						
					<p>
						<label for="password">Password:</label>
						<input type="password"  placeholder="Password" name="password" id = "password" required>
					</p>
					
					<p>
						<label for="password">Confirm Password:</label>
						<input type="password"  placeholder="confirm" name="passwordconfirm" id="passwordconfirm" required>
						<p id="message"></p>
					</p>
					
					<p>
						<input type="submit" name="submit" value="Login">
					</p>
				</form>
				
			</div>
		</section>

</body>
</html>