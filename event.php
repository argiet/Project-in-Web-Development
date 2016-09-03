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
                <a class="navbar-brand page-scroll" href="admin.php">
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

    <!-- Intro Header -->
    <header class="intro-admin">
        <div class="intro-body">
            <div class="container">
                <div class="row" id="admin">
                    
                    <?php

                        $id = $_GET['id'];

                        include ("connect_database.php");

                        $query = "SELECT * FROM events 
                            WHERE id = $id";
                                    
                            $res = $mysql_con->query($query);

                            if (!$res)
                                die('Invalid query: ' . $mysql_con->error);

                            $row = mysqli_fetch_array($res);

                            $row['day'] = date('d-m-Y', strtotime($row['day']));
                            $row['time'] = date('H:i', strtotime($row['time']));
                            $id = $row['id'];
                            $latitude = $row['latitude'];
                            $longitude = $row['longitude'];
                      
                            echo '<h2>'."<font color='black'>".$row['name']."</font>".'</h2>';

                            echo '<img src="'.$row['photo'].'"><br><br>';

                            echo '<div class = "des">';

                            echo'<h3>'. "<font color='green'>Description: </font>".'</h3>';
                            echo '<h4>'."<font color='black'>".$row['description']."</font>".'</h4>';

                            echo '</div>';

                            echo '<h3>'."<font color='green'>Day: </font>".'</h3>';
                            echo '<h4>'."<font color='black'>".$row['day']."</font>".'</h4>';
                            
                            echo'<h3>'. "<font color='green'>Time: </font>".'</h3>';
                            echo '<h4>'."<font color='black'>".$row['time']."</font>".'</h4>';

                            echo '<h3>'."<font color='green'>Host: </font>".'</h3>';
                            echo '<h4>'."<font color='black'>".$row['organizer']."</font>".'</h4>';
                            

                            echo'<h3>'. "<font color='green'>Category: </font>".'</h3>';
                            echo '<h4>'."<font color='black'>".$row['category']."</font>".'</h4>';

                            echo'<h3>'. "<font color='green'>MAP: </font>".'</h3><br>';


                            //MAP
                            if($row["latitude"]!=0 && $row["longitude"]!=0) {
                                $map = '<iframe width="500" height="250" frameborder="0" style="border:0" 
                                src="https://www.google.com/maps/embed/v1/place?q='.$latitude.','.$longitude.
                                '&key=AIzaSyBrhuX5x0MQEl9wmNFOwpqZiCQHN7JbQ4A"
                                allowfullscreen></iframe>';
                                echo $map;
                                    
                            }else{
                                $map=" ";
                            }


                    ?>
                    
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

    <!-- Google Maps API Key - Use your own API key to enable the map feature. More information on the Google Maps API can be found at https://developers.google.com/maps/ -->

    <!-- Custom Theme JavaScript -->
    <script src="js/grayscale.js"></script>

    <!-- Url Splitting function -->
    <script type="text/javascript" src="js/jfunctions.js"> </script>


</body>

</html>
