<?php

include('connect_database.php');
include('insert_func.php');

header('Content-Type: text/html; charset=utf-8');

define('FACEBOOK_SDK_V4_SRC_DIR', 'facebook-php-sdk-v4-4.0-dev/src/Facebook/');
require __DIR__ . '/facebook-php-sdk-v4-4.0-dev/autoload.php';

 use Facebook\FacebookSession;
 use Facebook\FacebookRequest;
 use Facebook\FacebookResponse;
 use Facebook\GraphUser;
 use Facebook\GraphEdge;


$finalurl = $_REQUEST["finalurl"];



    FacebookSession::setDefaultApplication('613900035419623', 'eec6258de3f9d780879c8e8040b72f1f');




    $graphURL="https://graph.facebook.com/v2.4/";


    // If you're making app-level requests:
    $session = FacebookSession::newAppSession();
    //to session einai ena array , ara mporw na perasw se mia thesi tou to accesstoken

    $accessToken=$session->getAccessToken();
    $session=new FacebookSession($accessToken);

    $request=new FacebookRequest($session ,'GET', $finalurl);
     
    $response=$request->execute();

    $graphObject=$response->getGraphObject()->asArray();

    

    $jsonplace=$graphURL.$finalurl. "?fields=id,name,location,category,picture&access_token=".$accessToken;
    $fb_page=json_decode(file_get_contents($jsonplace),true);


    $temp2 = '/events';
    $pageid = vsprintf("%s%s",array($finalurl,$temp2));
    $request=new FacebookRequest($session ,'GET', $pageid);
    $response=$request->execute();
    $graphObject=$response->getGraphObject()->asArray();

    $jsonplace=$graphURL.$pageid. "?fields=cover,category,description,id,name,owner,place,start_time&access_token=".$accessToken;
    $events=json_decode(file_get_contents($jsonplace),true);


        if (!isset( $fb_page['id'])) { $fb_page['id']= "";} 
        $page_i=$fb_page['id'];
        if (!isset( $fb_page['name'])) { $fb_page['name']= "";} 
        $page_name=$fb_page['name'];
        if (!isset( $fb_page['picture']['data']['url'])) { $fb_page['picture']['data']['url']= "";} 
        $page_photo=$fb_page['picture']['data']['url'];
        if (!isset( $fb_page['location']['street'])) { $fb_page['location']['street']= "";} 
        $page_address=$fb_page['location']['street'];
        if (!isset( $fb_page['category'])) { $fb_page['category']= "";} 
        $page_category=$fb_page['category'];

        //emfanish sth selida tou onomatos ths selidas, ths eikonas k ths topothesias

        echo "<h1 class="."execute".">".$page_name."</h1>";
        echo "<h2 class="."execute".">".$page_address."</h2>";
        echo '<img class="page-image" src="'.$page_photo.'"alt="">';
        echo "<br><br>";

        @insert_fun(4,$page_i,$page_name,$page_photo,$page_address,$page_category);

        //Καταχώρηση στη βάση τα στοιχεία ενός event ενός fb_page
     

            $data=$events['data'];
            foreach($data as $row => $value){

                if (!isset( $data[$row]['id'])) { $data[$row]['id']= "";} 
                $event_id=$data[$row]['id'];
                if (!isset( $data[$row]['start_time'])) { $data[$row]['start_time']= "";} 
                $event_start_time=$data[$row]['start_time'];
                
                $timestamp = strtotime($event_start_time);
                
                $new_date_format=date('Y-m-d H:i:s', $timestamp);
                
                $event_day  = date('Y-m-d', strtotime($new_date_format));
                $event_time = date('H:i:s', strtotime($new_date_format));
                
                if (!isset( $data[$row]['name'])) { $data[$row]['name']= "";} 
                $event_name=$data[$row]['name'];
                if (!isset( $data[$row]['cover']['source'])) { $data[$row]['cover']['source']= "";}
                $event_photo=$data[$row]['cover']['source'];
                if (!isset($data[$row]['owner']['name'])) { $data[$row]['owner']['name']= "";}
                $event_organizer=$data[$row]['owner']['name'];
                if (!isset( $data[$row]['description'])) { $data[$row]['description']= "";}
                $event_description=$data[$row]['description'];
                
                if (!isset($data[$row]['place']['location']['latitude'])) { $data[$row]['place']['location']['latitude']= "";}
                $event_latitude=$data[$row]['place']['location']['latitude'];
                if (!isset($data[$row]['place']['location']['longitude'])) { $data[$row]['place']['location']['longitude']= "";}
                $event_longitude=$data[$row]['place']['location']['longitude'];
                $current_day=date('Y-m-d');
                 if ($event_day>=$current_day){

                       @insert_fun(3,$event_id,$event_name,$event_day,$event_time,$event_photo,$event_organizer,
                        $page_category,$event_description,
                        $event_latitude,$event_longitude,$page_i);
                    
                }else {break;}
                    
            } //foreach




    



?>
