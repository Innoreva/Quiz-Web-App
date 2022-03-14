<?php
	require('database.php');
	session_start();
	if(isset($_SESSION["email"]))
	{
		session_destroy();
	}
	
	$ref=@$_GET['q'];		
	if(isset($_POST['login']))
	{	
		$email = $_POST['email'];
		$pass = $_POST['password'];
		$email = stripslashes($email);
		$email = addslashes($email);
		$pass = stripslashes($pass); 
		$pass = addslashes($pass);
		$email = mysqli_real_escape_string($con,$email);
		$pass = mysqli_real_escape_string($con,$pass);					
		$str = "SELECT * FROM user WHERE email='$email' and password='$pass'";
		$result = mysqli_query($con,$str);
		if((mysqli_num_rows($result))!=1) 
		{
			echo "<center><h3><script>alert('Sorry.. Wrong email (or) Password');</script></h3></center>";
			header("refresh:0;url=login.php");
		}
		else
		{
			$_SESSION['logged']=$email;
			$row=mysqli_fetch_array($result);
			$_SESSION['name']=$row[1];
			$_SESSION['id']=$row[0];
			$_SESSION['email']=$row[2];
			$_SESSION['password']=$row[3];
			header('location: welcome.php?q=1'); 					
		}
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/9a36302444.js" crossorigin="anonymous"></script>
    <title>LogIn</title>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhai+2:wght@700&family=Bree+Serif&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="CSS/login_style.css">
</head>

<body>
    <div class="container">
        <h1>Log In</h1>
        <form method="post" action="login.php">
        <div class="box">
            <i class="fa-solid fa-envelope"></i>
            <input type="Email ID" name="email" id="Email ID" placeholder="Email ID">
        </div>
        <div class="box">
            <i class="fa-solid fa-key"></i>
            <input type="password" name="password" id="password" placeholder="Password">
        </div>
        <button class="btn" name="login">Log In</button>
        <div class="register">
            <a href="register.php">New Here ?</a>
        </div>
    </form>
    </div>  
</body>
</html>