<?php

	header('Content-Type: text/html; charset=utf-8');
	include('connect_database.php');
	include('insert_func.php');
	include('select_func.php');

	define('FACEBOOK_SDK_V4_SRC_DIR', 'facebook-php-sdk-v4-4.0-dev/src/Facebook/');
	require __DIR__ . '/facebook-php-sdk-v4-4.0-dev/autoload.php';

	use Facebook\FacebookSession;
	use Facebook\FacebookRequest;
	use Facebook\FacebookResponse;
	use Facebook\GraphUser;
	use Facebook\GraphEdge;

	FacebookSession::setDefaultApplication('613900035419623', 'eec6258de3f9d780879c8e8040b72f1f');

	$graphURL="https://graph.facebook.com/v2.4/";

	// If you're making app-level requests:
	$session = FacebookSession::newAppSession();
	//to session einai ena array , ara mporw na perasw se mia thesi tou to accesstoken
	
	$accessToken=$session->getAccessToken();
	$session=new FacebookSession($accessToken);

	@$temp="DELETE  FROM events";

	if ($mysql_con->query($temp) === TRUE) {
		//echo "Record deleted successfully";
		} else {
		//echo "Error deleting record: " . $mysql_con->error;
		}

	@$id_select=select_fun(3);
	@$category_select=select_fun(4);
	
	//for gia kathe page
	foreach ($id_select as $row => $value) {
		
	  		$session = FacebookSession::newAppSession();
			//to session einai ena array , ara mporw na perasw se mia thesi tou to accesstoken
			$accessToken=$session->getAccessToken();
			$session=new FacebookSession($accessToken);
			$request=new FacebookRequest($session ,'GET', $id_select[$row]);

			$response=$request->execute();

			$graphObject=$response->getGraphObject()->asArray();

			$jsonplace=$graphURL.$id_select[$row]."?fields=id,name,location,category,picture&access_token=".$accessToken;
			$fb_page=json_decode(file_get_contents($jsonplace),true);



			$temp2 = '/events';
			$pageid = vsprintf("%s%s",array($id_select[$row],$temp2));
			$request=new FacebookRequest($session ,'GET', $pageid);
			$response=$request->execute();
			$graphObject=$response->getGraphObject()->asArray();
			$jsonplace=$graphURL.$pageid."?fields=cover,category,description,id,name,owner,place,start_time&access_token=".$accessToken;
			$events=json_decode(file_get_contents($jsonplace),true);

		
			$data=$events['data'];

			//for gia kathe event
	        foreach($data as $line => $value){

	            if (!isset( $data[$line]['id'])) { $data[$line]['id']= "";} 
	            $event_id=$data[$line]['id'];

	            if (!isset( $data[$line]['start_time'])) { $data[$line]['start_time']= "";} 
	            $event_start_time=$data[$line]['start_time'];

	            $timestamp = strtotime($event_start_time);
	            $new_date_format=date('Y-m-d H:i:s', $timestamp);
	            $event_day  = date('Y-m-d', strtotime($new_date_format));
	            $event_time = date('H:i:s', strtotime($new_date_format));

	            if (!isset( $data[$line]['name'])) { $data[$line]['name']= "";} 
	            $event_name=$data[$line]['name'];

	            if (!isset( $data[$line]['cover']['source'])) { $data[$line]['cover']['source']= "";}
	            $event_photo=$data[$line]['cover']['source'];

	            if (!isset($data[$line]['owner']['name'])) { $data[$line]['owner']['name']= "";}
	            $event_organizer=$data[$line]['owner']['name'];


	            if (!isset( $data[$line]['description'])) { $data[$line]['description']= "";}
	            $event_description=$data[$line]['description'];

	            if (!isset($data[$line]['place']['location']['latitude'])) { $data[$line]['place']['location']['latitude']= "";}
	            $event_latitude=$data[$line]['place']['location']['latitude'];

	            if (!isset($data[$line]['place']['location']['longitude'])) { $data[$line]['place']['location']['longitude']= "";}
	            $event_longitude=$data[$line]['place']['location']['longitude'];

	            $current_day=date('Y-m-d');

				if ($event_day>=$current_day){

					@$update_event=insert_fun(3,$event_id,$event_name,$event_day,$event_time,$event_photo,$event_organizer,$category_select[$row],$event_description,$event_latitude,$event_longitude,$id_select[$row]);



	            }else {
	            	break;
	            }
	        }

	    }

	    echo "<h2>Records updates succesfully</h2>";

?>