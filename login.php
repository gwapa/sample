<?php
	session_start();
	
	include 'dbhandler.php';
	
	$error = '';

	if(isset($_POST['login'])){
		$username = $_POST['username'];
		$password = $_POST['password'];		
		if(empty($username)){
			$error .= 'username is empty <br />'; 
		}
		if(empty($password)){
			$error .= 'password is empty <br />'; 
		}
		
		if(empty($error)){
			$query="SELECT * from email_list WHERE email='$username' AND password='$password'";

			$result = retrieve($dbc, $query, TRUE);
			
			if(!empty($result)){
				//kong success
				//1) ibutang og session variable ang first_name og id
				$_SESSION['name'] = $result['first_name'];
				$_SESSION['id'] = $result['id'];
				//2) redirect to retrieve page
				header('Location: http://localhost/crud/retrieve.php');
			}else {
				$error = 'username or password incorrect';
			}
		}
	}
?>
<html>
	<head>
		<title>Log-in</title>
		<style>
			#container{
				border: 0px solid black;
				padding: 20px;
				width: 300px;
				border-radius: 10px;
				background-color: thistle;
				margin: auto;
				margin-top: 100px;
				box-shadow: 2px 2px violet;
			}
			#button{
				border-radius: 5px;
				padding: 5px;
				margin-top: 5px;
			}
		</style>
	</head>
	<body>
		<div id="container">
			<?php echo $error; ?>
			<form method="post">
				<table>
					<tr>
						<td><label for="username">Username: </label></td>
						<td><input type="text" id="username" name="username" placeholder="email" /></td>
					</tr>
					<tr>
						<td><label for="password">Password: </label></td>
						<td><input type="text" id="password" name="password" placeholder="password" /> </td>
					</tr>
					<tr>
						<td><input type="submit" value="Login" name="login" id="button"></td>
					</tr>
				</table>
			</form>
		</div>
	</body>
</html>