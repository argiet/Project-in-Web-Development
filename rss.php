<?xml version="1.0" encoding="UTF-8" ?>
<rss version="2.0">

<channel>
  <title>RSS</title>
  <link> http://localhost</link>

<?php

    header('Content-Type: text/html; charset=utf-8');

    $category = $_GET['category'];

    include('connect_database.php');

    $result = mysqli_query($mysql_con,
      "SELECT * FROM events 
      WHERE category='$category'  
      ORDER BY day LIMIT 10");

  

    while($row = mysqli_fetch_array($result)){

      $date_time = strtotime($row['day']." ".$row['time']);
      $date_time = date(DATE_RSS, $date_time);

        echo " <item>";
              echo "\n"."<title>".$row['name']. "</title>";
              echo "\n"."<link>"." http://localhost/event.php?id=".$row['id']."</link>";
              echo '<pubDate>'.$date_time.'</pubDate>';
        echo "</item>";

    }

  ?>
</channel>

</rss>