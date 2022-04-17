<?php
include_once 'database.php';
session_start();
if (!(isset($_SESSION['email']))) {
    header("location:login.php");
} else {
    $name = $_SESSION['name'];
    $email = $_SESSION['email'];
    include_once 'database.php';
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Brain Quest</title>

    <!-- STYLESHEETS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/history.css">
    <link rel="stylesheet" href="CSS/ranking.css">
    <link rel="stylesheet" href="CSS/question_style.css">


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
                        <li class="nav-item" <?php if (@$_GET['q'] == 1) echo 'class="active"'; ?>>
                            <a href="welcome.php?q=1" class="nav-link" aria-current="page" href="index.html">Home</a>
                        </li>
                        <li class="nav-item" <?php if (@$_GET['q'] == 2) echo 'class="active"'; ?>>
                            <a href="welcome.php?q=2" class="nav-link" href="#">History</a>
                        </li>
                        <li class="nav-item" <?php if (@$_GET['q'] == 3) echo 'class="active"'; ?>>
                            <a href="welcome.php?q=3" class="nav-link" href="#">Ranking</a>
                        </li>
                        <li <?php echo ''; ?> class="nav-item">
                            <a class="nav-link" href="logout.php?q=welcome.php">Log Out</a>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>
    </section>

    <div class="container">
        <div class="inside">
            <?php if (@$_GET['q'] == 1) {
                $result = mysqli_query($con, "SELECT * FROM quiz ORDER BY date DESC") or die('Error');
                echo
                '  <div class="row heading">  <div class="col">
                    <h1>S. No.</h1>
                </div>
                <div class="col">
                    <h1>Topic</h1>
                </div>
                <div class="col">
                    <h1>Total Questions</h1>
                </div>
                <div class="col">
                    <h1>Marks</h1>
                </div>
                <div class="col">
                    <h1>Action</h1>
                </div>
                </div>';
                $c = 1;
                while ($row = mysqli_fetch_array($result)) {
                    $title = $row['title'];
                    $total = $row['total'];
                    $sahi = $row['sahi'];
                    $eid = $row['eid'];
                    $q12 = mysqli_query($con, "SELECT score FROM history WHERE eid='$eid' AND email='$email'") or die('Error98');
                    $rowcount = mysqli_num_rows($q12);
                    if ($rowcount == 0) {
                        echo

                        '<div class="row content">
                <div class="col">
                    <h3>' . $c++ . '</h3>
                </div>
                <div class="col">
                    <h3>' . $title . '</h3>
                </div>
                <div class="col">
                    <h3>' . $total . '</h3>
                </div>
                <div class="col">
                    <h3>' . $sahi * $total . '</h3>
                </div>
                <div class="col">
                    <h3><b><a href="welcome.php?q=quiz&step=2&eid=' . $eid . '&n=1&t=' . $total . '" class="btn sub1" style="color:black;margin:0px;background:#1de9b6"><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Start</b></span></a></b></h3>
                </div>';
                    } else {
                        echo

                        '<div class="row content" style="color:#99cc32">
                            <div class="col">
                                <h3>' . $c++ . '</h3>
                            </div>
                            <div class="col">
                                <h3>' . $title . '&nbsp;<span title="This quiz is already solve by you" class="glyphicon glyphicon-ok" aria-hidden="true"></span></h3>
                            </div>
                            <div class="col">
                                <h3>' . $total . '</h3>
                            </div>
                            <div class="col">
                                <h3>' . $sahi * $total . '</h3>
                            </div>
                            <div class="col">
                                <h3><b><a href="update.php?q=quizre&step=25&eid=' . $eid . '&n=1&t=' . $total . '" class="pull-right btn sub1" style="color:black;margin:0px;background:red"><span class="glyphicon glyphicon-repeat" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Restart</b></span></a></b></h3>
                            </div>';
                    }
                }
                $c = 0;
                echo '</table></div></div>';
            } ?>
            <?php
            if (@$_GET['q'] == 'quiz' && @$_GET['step'] == 2) {
                $eid = @$_GET['eid'];
                $sn = @$_GET['n'];
                $total = @$_GET['t'];
                $q = mysqli_query($con, "SELECT * FROM questions WHERE eid='$eid' AND sn='$sn' ");
                echo ' <div id="countdown">
                <div id="countdown-number"></div>
                <svg>
                  <circle r="18" cx="20" cy="20"></circle>
                </svg>
               </div>
            <div class="question">';
                while ($row = mysqli_fetch_array($q)) {
                    $qns = $row['qns'];
                    $qid = $row['qid'];
                    echo '<p><b>' . $qns . '</b></p></div>';
                }
                $q = mysqli_query($con, "SELECT * FROM options WHERE qid='$qid' ");
                echo '<form action="update.php?q=quiz&step=2&eid=' . $eid . '&n=' . $sn . '&t=' . $total . '&qid=' . $qid . '" method="POST"  class="form-horizontal">
                        <br />';

                while ($row = mysqli_fetch_array($q)) {
                    $option = $row['option'];
                    $optionid = $row['optionid'];
                    echo ' <div class="options"><ol style="list-style: none;"> <li class="button"><input type="radio" name="ans" value="' . $optionid . '">&nbsp;' . $option . '</li></ol></div>';
                }
                echo '<div><form id="form-id">
                <input type="submit"  value="Submit">
                     </form></div>';
            }

            if (@$_GET['q'] == 'result' && @$_GET['eid']) {
                $eid = @$_GET['eid'];
                $q = mysqli_query($con, "SELECT * FROM history WHERE eid='$eid' AND email='$email' ") or die('Error157');

                while ($row = mysqli_fetch_array($q)) {
                    $s = $row['score'];
                    $w = $row['wrong'];
                    $r = $row['sahi'];
                    $qa = $row['level'];
                    echo ' <div class="row heading">
                    <div class="col">
                    <h1>Result 📝</h1>
                   </div>
                    </div>
                    <div class="row content" style="color:#FFFFFF">
                        <div class="col">
                            <h3>Total Questions</h3>
                        </div>
                        <div class="col">
                            <h3>' . $qa . '</h3>
                        </div>
                        </div>
                        <div class="row content" style="color:#99cc32">
                        <div class="col">
                            <h3>Right Answers ✅</h3>
                            <span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>
                        </div>
                        <div class="col">
                            <h3>' . $r . '</h3>
                        </div>
                        </div>
                        <div class="row content" style="color:red">
                        <div class="col">
                            <h3>Wrong Answers ❌</h3>
                            <span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
                        </div>
                        <div class="col">
                            <h3>' . $w . '</h3>
                        </div>
                        </div>
                        <div class="row content" style="color:#66CCFF">
                        <div class="col">
                            <h3>Score 📝</h3>
                            <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                        </div>
                        <div class="col">
                            <h3>' . $s . '</h3>
                        </div>
                        </div>';
                }
                $q=mysqli_query($con,"SELECT * FROM rank WHERE  email='$email' " )or die('Error157');
                        while($row=mysqli_fetch_array($q) )
                        {
                            $s=$row['score'];
                            echo ' <div class="row content" style="color:#66CCFF">
                            <div class="col">
                                <h3>Overall Score </h3>
                                <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                            </div>
                            <div class="col">
                                <h3>' . $s . '</h3>
                            </div>
                            </div>
                           ';
                        }
            }
            ?>

            <?php
            if (@$_GET['q'] == 2) {
                $q = mysqli_query($con, "SELECT * FROM history WHERE email='$email' ORDER BY date DESC ") or die('Error197');
                echo  '
                            <div class="row heading">
                                <div class="col">
                                    <h1>S.No</h1>
                                </div>
                                <div class="col">
                                    <h1>Quiz 🧠</h1>
                                </div>
                                <div class="col">
                                    <h1>Total Questions </h1>
                                </div>
                                <div class="col">
                                    <h1>Right ✅</h1>
                                </div>
                                <div class="col">
                                    <h1>Wrong ❌</h1>
                                </div>
                                <div class="col">
                                    <h1>Marks 📋</h1>
                                </div>
                            </div>';
                $c = 0;
                while ($row = mysqli_fetch_array($q)) {
                    $eid = $row['eid'];
                    $s = $row['score'];
                    $w = $row['wrong'];
                    $r = $row['sahi'];
                    $qa = $row['level'];
                    $q23 = mysqli_query($con, "SELECT title FROM quiz WHERE  eid='$eid' ") or die('Error208');

                    while ($row = mysqli_fetch_array($q23)) {
                        $title = $row['title'];
                    }
                    $c++;
                    echo '<div class="row content">
                        <div class="col">
                            <h3>' . $c . '</h3>
                            </div> <div class="col">
                            <h3>' . $title . '</h3>
                            </div> <div class="col">
                            <h3>' . $qa . '</h3>
                            </div> <div class="col">
                            <h3>' . $r . '</h3>
                            </div> <div class="col">
                            <h3>' . $w . '</h3>
                            </div> <div class="col">
                            <h3>' . $s . '</h3>
                            </div></div>';
                }
            }

            if (@$_GET['q'] == 3) {
                $q = mysqli_query($con, "SELECT * FROM rank ORDER BY score DESC ") or die('Error223');
                echo  ' 
                
                            <div class="row heading">
                                <div class="col">
                                    <h1>Rank</h1>
                                </div>
                                <div class="col">
                                    <h1>Name</h1>
                                </div>
                                <div class="col">
                                    <h1>Email id</h1>
                                </div>
                                <div class="col">
                                    <h1>Score</h1>
                                </div>
                            </div>
                ';
                $c = 0;

                while ($row = mysqli_fetch_array($q)) {
                    $e = $row['email'];
                    $s = $row['score'];
                    $q12 = mysqli_query($con, "SELECT * FROM user WHERE email='$e' ") or die('Error231');
                    while ($row = mysqli_fetch_array($q12)) {
                        $name = $row['name'];
                    }
                    $c++;
                    echo '<div class="row content">
                                <div class="col">
                                <h3>' . $c . '</h3>
                                </div>
                                <div class="col">
                                <h3>' . $name . '</h3>
                                </div> <div class="col">
                                <h3>' . $e . '</h3>
                                </div> <div class="col">
                                <h3>' . $s . '</h3>
                                </div></div>';
                }
            }
            ?>
        </div>
    </div>
    <script src="Question.js"></script>
</body>

</html>