<?php
header('Content-Type: text/html; charset=utf-8');
include('connect_database.php');
include('insert_func.php');
include('delete_func.php');
include('select_func.php');

define('FACEBOOK_SDK_V4_SRC_DIR', 'facebook-php-sdk-v4-4.0-dev/src/Facebook/');
require __DIR__ . '/facebook-php-sdk-v4-4.0-dev/autoload.php';

 use Facebook\FacebookSession;
 use Facebook\FacebookRequest;
 use Facebook\FacebookResponse;
 use Facebook\GraphUser;
 use Facebook\GraphEdge;


$finalurl = $_GET["finalurl"];

FacebookSession::setDefaultApplication('613900035419623', 'eec6258de3f9d780879c8e8040b72f1f');
$graphURL="https://graph.facebook.com/v2.4/";
 
$session = FacebookSession::newAppSession();

$accessToken=$session->getAccessToken();
$session=new FacebookSession($accessToken);
$request=new FacebookRequest($session ,'GET', $finalurl);
 
$response=$request->execute();
$graphObject=$response->getGraphObject()->asArray();

$jsonplace=$graphURL.$finalurl. "?fields=id,name,location,category,picture&access_token=".$accessToken;
$fb_page=json_decode(file_get_contents($jsonplace),true);


if (!isset( $fb_page['id'])) { $fb_page['id']= "";} 
    $page_i=$fb_page['id'];


@delete_fun(2,$page_i);
@delete_fun(1,$page_i);


?>