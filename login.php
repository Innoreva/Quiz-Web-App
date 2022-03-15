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
  <title>LogIn</title>

  <!-- STYLESHEETS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="CSS/login_style.css">

  <!-- GOOGLE FONTS -->
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Audiowide&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">

  <!-- SCRIPTS -->
  <script src="https://kit.fontawesome.com/9a36302444.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>


</head>

<body>

  <section id="navigation-bar">
    <nav class="navbar navbar-expand-lg navbar-dark">
      <a class="navbar-brand" href="../front page/index.php">
        <img src="ASSETS/icon.png" width="50" height="50" class="d-inline-block align-top" alt="">
        Brain Quest
      </a>
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Log in</a>

            </li>
            <li class="nav-item">
              <a class="nav-link" href="register.php">Register</a>
            </li>
        </div>
      </div>
    </nav>

  </section>

  <div class="container">
    <div class="Login">
      <h1>Log In</h1>
    </div>
    <div class="box">
      <i class="fa-solid fa-user"></i>
      <input type="username" name="useranme" id="username" placeholder="Username">
    </div>
    <div class="box">
      <i class="fa-solid fa-key"></i>
      <input type="password" name="password" id="password" placeholder="Password">
    </div>
    <button class="spec">Enter</button>
    <div class="register">
      <a class="new_here" href="register.php">New Here ?</a>
    </div>
  </div>
</body>

</html>
