<?php
	include("database.php");
	session_start();
	
	if(isset($_POST['register']))
	{	
		$name = $_POST['name'];
		$name = stripslashes($name);
		$name = addslashes($name);

		$email = $_POST['email'];
		$email = stripslashes($email);
		$email = addslashes($email);

		$password = $_POST['password'];
		$password = stripslashes($password);
		$password = addslashes($password);

		$college = $_POST['college'];
		$college = stripslashes($college);
		$college = addslashes($college);
		$str="SELECT email from user WHERE email='$email'";
		$result=mysqli_query($con,$str);
		
		if((mysqli_num_rows($result))>0)	
		{
            echo "<center><h3><script>alert('Sorry.. This email is already registered !!');</script></h3></center>";
            header("refresh:0;url=login.php");
        }
		else
		{
            $str="insert into user set name='$name',email='$email',password='$password',college='$college'";
			if((mysqli_query($con,$str)))	
			echo "<center><h3><script>alert('Congrats.. You have successfully registered !!');</script></h3></center>";
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
    <script src="https://kit.fontawesome.com/8f98b1b459.js" crossorigin="anonymous"></script>
    <title>LogIn</title>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhai+2:wght@700&family=Bree+Serif&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="CSS/registration_style.css">
</head>

<body>
    <div class="container">
        <h1>Register Here</h1>
        <form method="post" action="register.php">
        <div class="box">
            <i class="fa-solid fa-user"></i>
            <input type="username" name="name" id="username" placeholder="Username">
        </div method="post" action="register.php">
        <div class="box">
            <i class="fa-solid fa-envelope"></i>
            <input type="Email ID" name="email" id="Email ID" placeholder="Email ID">
        </div>
        <div class="box">
            <i class="fa-solid fa-building-columns"></i>
            <input type="College" name="college" id="College" placeholder="College">
        </div>
        <div class="box">
            <i class="fa-solid fa-key"></i>
            <input type="password" name="password" id="password" placeholder="Password">
        </div>
        <button class="btn" name="register">Register</button>
</form>
    </div>
</body>

</html>