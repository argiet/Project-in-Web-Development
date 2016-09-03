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

    <!-- Intro Header -->
    <header class="events-section">
      <!--  <div class="intro-body"> -->
            <div class="container">
                <div class="row" id="admin">
                    <?php

                    	session_start();

                        header('Content-Type: text/html; charset=utf-8');
                        include ('connect_database.php');

						if(isset($_POST['keywords'])){
                            $_SESSION['session_keywords'] = $_POST['keywords'];
                            $findme = $_SESSION['session_keywords'];

                            $findme = trim($findme); //bgazw ta kena an yparxoun
                            $findme = stripslashes($findme); //bgazw ta '\'
                            $findme = htmlspecialchars($findme); //metatrepw eidikous xarakthres p.x.'<' se ontothtes ths HTML

                            $array=explode(" ",$findme); //xwrizetai to input string 
                                                        //kai eisagetai kathe leksh se mia thesh tou pinaka se pinaka 

                            //metrhtes
                            $i=0;
                            $k=0;
                            $m=0;
                            $n=0;

                            $ar_id[$m]=0; // array with found event ids

                            foreach($array as $line => $value){
                                $text=$array[$line];

                               
                                $i=0;
                                $query_sel = "SELECT * FROM events";
                                $result_sel = $mysql_con->query($query_sel);

                                if ($result_sel->num_rows > 0) {
                                    // output data of each row

                                    while($row = $result_sel->fetch_assoc()) {

                                        $ar[$i]=$row["name"];
                                        
                                        $q_n = $ar[$i];
                                    
                                        if (strlen(stristr($q_n,$text))>0){
                                            
                                            for($m=0; $m<sizeof($ar_id); $m++){

                                                
                                                if($ar_id[$m]!=$row["id"]){
                                                    $ar_id[$n] = $row["id"];
                                                    
                                                    $row['day'] = date('d-m-Y', strtotime($row['day']));
                                                    $row['time'] = date('H:i', strtotime($row['time']));
                                                    $id = $row['id'];

                                                    echo '<h2>'."<font color='green'>".$ar[$i]."</font>".'</h2>';
                                                   
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




                                                    $n=$n+1;
                                                    break;
                                                 }else{
                                                    echo "it's the same ,dont print again";
                                                 }
                                            }

                                           $i=$i+1;
                                           $k=$k+1;

                                      }else{

                                        $ar1[$i]=$row["description"];
                                     
                                        $q_d=$ar1[$i];

                                        if (strlen(stristr($q_d,$text))>0){

                                            for($m=0; $m<sizeof($ar_id); $m++){

                                                  if($ar_id[$m]!=$row["id"]){
                                                    
                                                    $ar_id[$n]=$row["id"];

                                                    $id = $row['id'];
                                                    $row['day'] = date('d-m-Y', strtotime($row['day']));
                                                    $row['time'] = date('H:i', strtotime($row['time']));
                                                    
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

                                                    $n=$n+1;
                                                    break;
                                                }else{
                                                    //echo "it's the same ,dont print again";
                                                }
                                            }//for

                                                $i=$i+1;

                                                $k=$k+1;
                                        } //if compare strings

                                      } // if not found in name

                                } //while name & descr

                                    
                            }//if there are results of query

                                  

                        } //foreach keyword

                                if($k==0){
                                  echo "nooooooo";
                                }
                        }

						mysqli_close($mysql_con);
                    ?>
                    
                
            </div>
        </div>
    </header>

    <!-- Map Section -->
    <div id="map"></div>

    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <p>Copyright &copy; Argyro & Ioanna 2015</p>
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