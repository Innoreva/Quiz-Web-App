<?php
    include_once 'database.php';
    session_start();
    if(!(isset($_SESSION['email'])))
    {
        header("location:login.php");
    }
    else
    {
        $name = $_SESSION['name'];
        $email = $_SESSION['email'];
        include_once 'database.php';
    }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Brain Quest-Dashboard</title>

  <!-- STYLESHEETS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="CSS/dashboard_style.css">
  <link rel="stylesheet" href="CSS/add_quiz_style.css">


  <!-- ICON -->
  <link rel="icon" href="icon.ico">


  <!-- FONTS -->
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Audiowide&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">


  <!-- SCRIPTS -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

  <!-- FONT AWESOME JS -->
  <script src="https://kit.fontawesome.com/7cec356310.js" crossorigin="anonymous"></script>

</head>

<body>
  <section id="navigation-bar">
    <nav class="navbar navbar-expand-lg navbar-dark">
      <a class="navbar-brand" href="index.html">
        <img src="ASSETS/icon.png" width="50" height="50" class="d-inline-block align-top" alt="">
        Brain Quest
      </a>
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li <?php if(@$_GET['q']==0) echo'class="active"'; ?> class="nav-item">
              <a class="nav-link" aria-current="page" href="dashboard.php?q=0">Home</a>
            </li>
            <li <?php if(@$_GET['q']==1) echo'class="active"'; ?>class="nav-item">
              <a class="nav-link" href="dashboard.php?q=1">User</a>
            </li>
            <li <?php if(@$_GET['q']==2) echo'class="active"'; ?> class="nav-item">
              <a class="nav-link" href="dashboard.php?q=2">Ranking</a>
            </li>
            <li class="nav-item" class="dropdown <?php if(@$_GET['q']==4) echo'active"'; ?>">
              <a class="nav-link" href="dashboard.php?q=4">Add Quiz</a>
            </li>
        </div>
      </div>
    </nav>

  </section>

    <div class="container">
      <div class="inside">

      
      <?php if(@$_GET['q']==0)
                {
                   echo "<h1> WELCOME TO Admin Page!!
					</h1>";
					
                }
                if(@$_GET['q']== 2) 
                {
                    $q=mysqli_query($con,"SELECT * FROM rank  ORDER BY score DESC " )or die('Error223');
                    echo  '<div class="row heading">
     <div class="col">
       <h1>Rank</h1>
     </div>
     <div class="col">
       <h1>Name</h1>
     </div>
     <div class="col">
       <h1>Score</h1>
     </div>
 </div>';
 $c=0;
                    while($row=mysqli_fetch_array($q) )
                    {
                        $e=$row['email'];
                        $s=$row['score'];
                        $q12=mysqli_query($con,"SELECT * FROM user WHERE email='$e' " )or die('Error231');
                        while($row=mysqli_fetch_array($q12) )
                        {
                            $name=$row['name'];
                            $college=$row['college'];
                        }
                        $c++;
                        echo'

   <div class="row content">
  <div class="col">
    <h3>'.$c.'</h3>
  </div>
  <div class="col">
    <h3>'.$e.'</h3>
  </div>
  <div class="col">
    <h3>'.$s.'</h3>
  </div></div>';
                      }

                    }
                    ?>
                     <?php 
                    if(@$_GET['q']==1) 
                    {
                        $result = mysqli_query($con,"SELECT * FROM user") or die('Error');
                        echo  '

  <div class="row heading">
 <div class="col">
   <h1>S.No</h1>
 </div>
 <div class="col">
   <h1>Name</h1>
 </div>
 <div class="col">
   <h1>College</h1>
 </div>
 <div class="col">
 <h1>Email</h1>
</div>
 </div>';
 $c=1;
                        while($row = mysqli_fetch_array($result)) 
                        {
                            $name = $row['name'];
                            $email = $row['email'];
                            $college = $row['college'];
                            echo '
 <div class="row content">
<div class="col">
  <h3>'.$c++.'</h3>
</div>
<div class="col">
  <h3>'.$name.'</h3>
</div>
<div class="col">
  <h3>'.$college.'</h3>
</div>
<div class="col">
  <h3>'.$email.'</h3>
</div>
</div>';
}
$c=0;
                    }
                    ?>
                      <?php
                    if(@$_GET['q']==4 && !(@$_GET['step']) ) 
                    {
                        echo ' <div class="row heading">
                        <h1>Enter Quiz Details</h1>
                      </div>
                      <form method="POST" action="update.php?q=addquiz" name="form                          ">
                        <div class="box">
                          <input type="text" name="name" id="name" placeholder="Enter Quiz Title">
                        </div>
                        <div class="box">
                          <input type="number" name="total" id="total" placeholder="Enter total number of questions">
                        </div>
                        <div class="box">
                          <input type="number" name="right" id="right" placeholder="Enter marks on right answer">
                        </div>
                        <div class="box">
                          <input type="number" name="wrong" id="wrong" placeholder="Enter minus marks on wrong answer without sign">
                        </div>
                
                        <button type="button" class="btn btn-outline-light">Enter</button>
                      </form>';
                    }
                    ?>
                    
            

</body>
</html>
