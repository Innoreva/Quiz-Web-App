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
  <title>Registation</title>

  <!-- STYLESHEETS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="CSS/registration_style.css">

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
      <a class="navbar-brand" href="../front page/index.html">
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
              <a class="nav-link" href="login.php">Log in</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Register</a>
            </li>
        </div>
      </div>
    </nav>

  </section>

    <div class="container">
        <h1>Register Here</h1>
        <form method="post" action="register.php">
        <div class="box">
            <i class="fa-solid fa-user"></i>
            <input type="username" name="name" id="username" placeholder="Username">
        </div>
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
        <button class="spec" name="register">Register</button>
       </form>
    </div>
</body>

</html>
