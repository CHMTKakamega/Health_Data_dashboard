
<?php

session_start();

//Using PDO

if( isset($_SESSION['user_id']) ){
	//if there is a session from previous login then take the user straight to dashboard
	//header("location: /dashboard.html");

	 //echo "<script> window.location.assign('dashboard.html'); </script>";
}

require_once"connection.php";

//Recheck that the variables are not null
if(!empty($_POST['username']) && !empty($_POST['password'])):
	
	//Prepare the query statement -- id is autogenerate, never mind about it for now
	$records = $conn->prepare('SELECT id,username,password FROM users WHERE username = :username');
	//Bind the username sent to :username Variable
	$records->bindParam(':username', $_POST['username']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);

	//this message variable will store errors and success messages
	$message = '';

	//perfom a check before creating a session if the user can be granted access or not.
	if(count($results) > 0 && password_verify($_POST['password'], $results['password']) ){

		$_SESSION['user_id'] = $results['id'];
		//take the user to the dashboard if all is well
		//header("location: /dashboard.html");
		
		//echo "<script type='text/javascript' language='Javascript'>window.open('http://localhost/');</script>";

		 echo "<script> window.location.assign('dashboard.html'); </script>";
		
		

	} else {
		$message = 'Sorry, those credentials do not match';
	}

endif;

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Health Data dashboard</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" href="main.css">
</head>




<body>

	<div class="container">
		<div class="page-header">
			<figure>
				<img src="images/logo.jpg" alt="Logo image" width="100" height="100">
				<figcaption>Kakamega County</figcaption>
			</figure>

			<h1>Health Data Dashboard</h1>
			
		</div>

		<section>
			<div id="loginCard">
				<h3>Login</h3>
				<form action="index.php" method="POST">
					
					<p  <?php if(!empty($message)): ?>
		<p><?= $message ?></p>
	<?php endif; ?></p>
					<p>
						
						<label for="username">Username:</label>
						<input type="text" placeholder = "User name" name="username" required>
					</p>
					<p>
						<label for="password">Password:</label>
						<input type="password"  placeholder="Password" name="password" required>
					</p>
					<p>
						<input type="checkbox" name="remember me">Remember me
					</p>
					<p>
						<input type="submit" name="submit" value="Login">
					</p>
				</form>
				<a href="signUp.php">or Create an account instead</a>
			</div>
		</section>
	</div>

	<footer class="footer">
		2018@Kakamega CHMT
	</footer>
</body>
</html>