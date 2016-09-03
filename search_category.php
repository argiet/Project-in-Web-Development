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

session_start();

header('Content-Type: text/html; charset=utf-8');
include ('connect_database.php');

if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 

$start = ($page-1) * 5; 

$res = mysqli_query($mysql_con,
        "SELECT category FROM pages 
        GROUP BY category");
$k=0;
while ($row = mysqli_fetch_array($res)) { 

        if($_POST['category'] == $row['category']) {
            $k = $k+1;
        }
    }

if ($k != 1) header('location:index2.php#search');

    $_SESSION['session_category'] = $_POST['category'];

    $newcat = $_SESSION['session_category'];

    $my_query = "SELECT * FROM events 
                WHERE category = '$newcat'
                LIMIT $start, 5";
        
    $result = $mysql_con->query($my_query);

    if (!$result)
        die('Invalid query: ' . $mysql_con->error);

?>

    <!-- Intro Header -->
    <header class="events-section">
      <!--  <div class="events-section"> -->
            <div class="container">
                <div class="row" id="admin">
                    <?php

                                while ($row = mysqli_fetch_array($result)) { 

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
                            WHERE category = '$newcat'
                        ");

                        while ($row = mysqli_fetch_array($res1)) { 

                             $number2++;
                        }

                        $pages = ceil($number2 / 5); 
                          
                        for ($i=1; $i<=$pages; $i++) { 
                             echo "<a href='index2.php?page=".$i."#about' class='btn btn-danger'>".$i."</a> "; 
                        }

                        //mysqli_close($mysql_con);

        ?>

              
            </div>
        </div>
    </header>

    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <p>Copyright &copy; Ioanna & Argyro 2015</p>
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


</body>

</html>
