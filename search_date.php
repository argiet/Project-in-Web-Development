<!DOCTYPE html>
<html lang="en">

<head>

    <?php
        include("header2.php");
    ?>
    
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

    <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="index2.php">
                    <i class="fa fa-play-circle"></i>  <span class="light">Home</span>
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <?php 

header('Content-Type: text/html; charset=utf-8');
session_start();

if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
$start = ($page-1) * 5; 

include('connect_database.php');


    if(isset($_POST['date1']) && isset($_POST['date2'])){
    $_SESSION['session_date1'] = $_POST['date1'];
    $_SESSION['session_date2'] = $_POST['date2'];

    check($_SESSION['session_date1'], $_SESSION['session_date2']); //elegxos an to input einai hmeromhnia

    $newdate1 = $_SESSION['session_date1'];
    $newdate2 = $_SESSION['session_date2'];

    $newdate1 = date('Y-m-d', strtotime($newdate1));
    $newdate2 = date('Y-m-d', strtotime($newdate2));

$res = mysqli_query($mysql_con,
    "SELECT * FROM events 
    WHERE day >='$newdate1' AND day <= '$newdate2' 
    ORDER BY day
    LIMIT $start, 5 
");


?>

    <!-- Intro Header -->
    <header class="events-section">
      <!--  <div class="intro-body"> -->
            <div class="container">
                <div class="row" id="admin">
                    <?php


                    while ($row = mysqli_fetch_array($res)) { 

                    $row['day'] = date('d-m-Y', strtotime($row['day']));
                    $row['time'] = date('H:i', strtotime($row['time']));
                    $id = $row['id'];
              
                    echo '<h2>'."<font color='green'>".$row['name']."</font>".'</h2>';

                    echo '<img src="'.$row['photo'].'"><br><br>';

                    echo '<h3>'."<font color='green'>Day: </font>".'</h3>';
                    echo '<h4>'.$row['day'].'</h4>';

                    echo'<h3>'. "<font color='green'>Time: </font>".'</h3>';
                    echo '<h4>'.$row['time'].'</h4>';

                    echo '<h3>'."<font color='green'>Host: </font>".'</h3>';
                    echo '<h4>'.$row['organizer'].'</h4>';

                    echo'<h3>'. "<font color='green'>Category: </font>".'</h3>';
                    echo '<h4>'.$row['category'].'</h4>';
                    
                    echo '<a href="event.php?id='.$id.'
                            "class="btn btn-danger">More Info</a><br><br>';


                    echo "<div class=\"p\"></div>";
                    echo "<hr>";
            }

            $number2=0;
            $res1 = mysqli_query($mysql_con,
                "SELECT * FROM events
                WHERE day >='$newdate1' AND day <= '$newdate2'
                ORDER BY day
            ");

            while ($row = mysqli_fetch_array($res1)) { 

                 $number2++;
            }

            $pages = ceil($number2 / 5); 
              
            for ($i=1; $i<=$pages; $i++) { 
                 echo "<a href='index2.php?page=".$i."#about' class='btn btn-danger'>".$i."</a> "; 
            }

    }

?>

<div class = "row">

<?php

function check($date1, $date2) {

            if (validateDate($date1, 'd-m-Y') && validateDate($date2, 'd-m-Y'))
            {
                return;
            }
            else echo '<h2>Date invalid</h2>';
        }

function validateDate($date, $format = 'd-m-Y')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

?>

</div>
                    
                </div>
            </div>
        </div>
    </header>

    <!-- Map Section -->
    <div id="map"></div>

    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <p>Copyright &copy; Your Website 2014</p>
        </div>
    </footer>



    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="js/jquery.easing.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/grayscale.js"></script>

    <!-- Url Splitting function -->
    <script type="text/javascript" src="js/split.js"> </script>


</body>

</html>


