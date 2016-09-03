<!DOCTYPE html>
<html lang="en">

<head>

    <?php
        include("header2.php");

        session_unset();
    ?>

    <title>Events Near You</title>

</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

    <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">
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
                    <li>
                        <a class="page-scroll" href="#search"><span class="glyphicon glyphicon-search"></span>SEARCH</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#rss">RSS</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#admin">ADMIN</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Intro Header -->
    <header class="intro">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h1 class="brand-heading">Events</h1>
                        <p class="intro-text">Check all the Events Near You</p>
                        <a href="#about" class="btn btn-circle page-scroll">
                            <i class="fa fa-angle-double-down animated"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

<?php 
header('Content-Type: text/html; charset=utf-8');
session_start();

if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
$start = ($page-1) * 5; 

include('connect_database.php');

$res = mysqli_query($mysql_con,
    "SELECT * FROM events 
    ORDER BY day
    LIMIT $start, 5 
");


?>

    <!-- About Section -->
    <section id="about" class="content-section text-center">
        <div class="events-section">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h1><font color='black'>Latest Events</font></h1>
            </div>
        </div>

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
                ORDER BY day
            ");

            while ($row = mysqli_fetch_array($res1)) { 

                 $number2++;
            }

            $pages = ceil($number2 / 5); //arithmos selidwn pou tha dhmiourgithoun analoga me ton arithmo twn events
              
            for ($i=1; $i<=$pages; $i++) { 
                 echo "<a href='index2.php?page=".$i."#about' class='btn btn-danger'>".$i."</a> "; 
            }
        ?>

        <hr>
        </div>
    </section>

    <!-- Search Section -->
    <section id="search" class="content-section text-center">
        <div class="download-section">
            
            <!-- <div class="container"> -->

            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <h2 class="search"><font color= '#808080' >SEARCH</font></h2>
                </div>
            </div>

            <div class="row text-center">

                <div class="col-md-4 hero-feature text-center">
                        <div class="caption">
                            <h3 class="search"><font color= '#fff' >Choose a category:</font></h3>
                            <p>
                                <form action="search_category.php" method="POST">
                                    <input class="form-control input-sm" 
                                    placeholder="Click to see available categories" 
                                    list="categories" name="category">
                                        <datalist id="categories">
                                        <?php 

                                            header('Content-Type: text/html; charset=utf-8');
                                            //include ('connect_database.php');
                                            $query1 = "SELECT category 
                                                        FROM pages
                                                        GROUP BY category";

                                            $res2 = $mysql_con->query($query1);

                                            if ($res2->num_rows > 0) {
                                                // output data of each row
                                                while($row = $res2->fetch_assoc()) {
                                                    echo '<option value="'.$row["category"].'">';
                                                }
                                            }



                                        ?>

                                        </datalist>
                                    <br>
                                    <br>
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa fa-angle-double-down animated">
                                        </i>Select
                                    </button>
                                </form>
                            </p>
                        </div>
                </div>
            


                <div class="col-md-4 hero-feature text-center ">
                        <div class="caption">
                            <h3 class="search"><font color= '#fff' >Choose date:</font></h3>
                            <p>
                                <form action="search_date.php" method="POST">
                                    <input class="form-control input-sm" placeholder="From: dd-mm-yyyy" 
                                    id="date1" type="date" name="date1"> <br>

                                    <input class="form-control input-sm" placeholder="To: dd-mm-yyyy" 
                                    id="date2" type="date" name= "date2">
                                    <br>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-angle-double-down animated">
                                        </i>Select
                                    </button>
                                </form>
                            </p>
                        </div>
                </div>

                <div class="col-sm-4 hero-feature text-center ">
                        <div class="caption">
                            <h3 class="search"><font color= '#fff'>Search through keywords:</font></h3>
                            <p>
                                <form action="search_keywords.php" method="POST">
                                    <input class="form-control input-sm" placeholder="Keywords"
                                     id="keywords" type="text" name="keywords">
                                    <br>
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa fa-angle-double-down animated">
                                        </i>Select
                                    </button>
                                </form>
                            </p>
                        </div>
                </div>
            </div>
            </div>
        </div>
    </section>

    <!-- Admin Login Section -->
    <section id="admin" class="container content-section text-center">
        <div class="admin-section">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h2>Admin Login</h2>
                <div class="navbar-collapse collapse">
                  <form action="admin2.php" method="POST" class="navbar-form navbar-center" role="form" >
                    <div class="form-group">
                      <input type="text" placeholder="Username" class="form-control" name="user">
                    </div>
                    <div class="form-group">
                      <input type="password" placeholder="Password" class="form-control" name="pass">
                    </div>
                    <button type="submit" class="btn btn-success" >Sign in</button>
                  </form>
                </div><!--/.navbar-collapse -->
            </div>
        </div>
        </div>
    </section>

    <!--RSS-section-->
    <section id="rss" class="container content-section text-center">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <br> <br> <br>
                <h2>RSS</h2>

                <?php

                        //include('connect_database.php');

                        $query3 = "SELECT category FROM events 
                                     GROUP BY category";
                                                        
                        $res3 = $mysql_con->query($query3);

                        if (!$res3)
                            die('Invalid query: ' . $mysql_con->error);

                        while ($row = mysqli_fetch_array($res3)) { 
                      
                            $category=$row['category'];

                            echo '<a href="rss.php?category='.$category
                            .'"class="btn btn-danger">'.$row["category"].'</a><br><br>';

                        }

                    ?>

            </div>
        </div>
    </section>
    
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
