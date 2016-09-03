<?php
    
    header('Content-Type: text/html; charset=utf-8');

    include('header2.php');

    include('connect_database.php');

    if(isset($_POST['user']) && isset($_POST['pass'])){
        session_start();    
        $_SESSION['session_username'] = $_POST['user'];
        $_SESSION['session_pass'] = $_POST['pass'];

        $newusername = check($_SESSION['session_username']); //elegxos timwn me th sunarthsh check
        $newpassword = check($_SESSION['session_pass']);

        $my_query = "SELECT * FROM admin WHERE username = '$newusername' AND password = '$newpassword'";
            
        $result = $mysql_con->query($my_query);

        if (!$result)
            die('Invalid query: ' . $mysql_con->error);

        $count = mysqli_num_rows($result);
        if($count==1){

?>

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
                <a class="navbar-brand page-scroll" href="admin2.php">
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
                        <a class="page-scroll" href="logoff.php">LOGOUT</a>
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
                <div class="row">

                    <div class="col-md-4 col-md-offset-1">
                        <h1 class="admin-heading">Give URL</h1>
                        <div class="col-sm-8 col-md-offset-2">
                        <input class="form-control input-sm" id="myURL" type="url">
                        <br>
                    </div>
                        
                        
                    <div class="btn-group btn-group-lg">
                        <button type="button" onclick="Function_Enter()" class="btn btn-success page-scroll">
                            <i class="fa fa-angle-double-down animated"></i>
                            Insert</button>
                        <button type="button" onclick="Function_Delete()" class="btn btn-danger">
                            <i class="fa fa-angle-double-down animated"></i>Delete</button>
                    </div>

                    </div>
                    <div class="col-md-4 col-md-offset-2">
                            <h1 class="admin-heading">Ανανέωσε τα events</h1>
                            <button onclick="Function_Updates()"class="btn btn-circle page-scroll">
                                <i class="fa fa-angle-double-down animated"></i>
                            </button>
                            <br>
                            <br>
                    </div>
                </div>
            </div>
        </div>
    </header>

<section id="results" class="content-section text-center">
            <div class="result-section">
                <div class="row" id="admin">
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

    <!-- Url Splitting function -->
    <script type="text/javascript" src="js/jfunctions.js"> </script>


</body>

</html>


<?php
        }

        else{
            echo "<div class='container text-center'>";
            echo "<br><br><h2>Wrong Username or Password</h2>";
            echo "<a href='index2.php#admin' class='btn btn-success'>Try Again</a>";
            echo "</div>";
            session_unset(); //epistrofh sthn arxikh selida kai eleutherwnoume tis session metablhtes
        }

    }else { //an kapoios prospathisei na mpei sth selida me to url stelnetai sthn arxikh
        header('location:index2.php');
    }



    function check($data) {
        $data = trim($data); //bgazw ta kena an yparxoun 
        $data = stripslashes($data); //bgazw ta '\'
        $data = htmlspecialchars($data); //metatrepw eidikous xarakthres p.x.'<' se ontothtes ths HTML
        return $data;
    }
?>



