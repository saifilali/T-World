<?php
	
	session_start();

	require_once("autoload.php");
	// use Abraham\TwitterOAuth\TwitterOAuth;
	require_once('src/TwitterOAuth.php');
	use Abraham\TwitterOAuth\TwitterOAuth;

	$apikey = "oTk1GPfPsepAvcRkTITqwi4fd";
	$apisecret = "WMYmOzRbLcfW5lPbuFwQtoKqyWkubsKYUDhsgnpTDqe9Zq5u04";
	$accesstoken = "357659837-4NI7LhZr76ybwvw4HhG0ZwcofroXEZIG2k06QkAi";
	$accesssecret = "oKTzLO6iGHOR1PNwD56tgLhB7zUEaU0bSRDFSEHYEYF9F";

	$connection = new TwitterOAuth($apikey, $apisecret, $accesstoken, $accesssecret);



	// // $tweets = $connection->get('statuses/user_timeline', array('screen_name' => "telebots_TAMU", 'count' => 10));

	// $tweets = $connection->get("statuses/home_timeline", ["count" => 10, "exclude_replies" => true]);

	// // print_r($tweets);

	// echo "Latest 10 tweets by @techedrob";

	// echo "<br>";

	// echo "<br>";
	
	// $i = 1;
	// foreach ($tweets as $tweet){
		
	// 	echo $i;

	// 	echo ". ";

	// 	echo $tweet->text;

	// 	echo "<br>";

	// 	$i++;
	// }

	//top 10 hashtags 

	// echo "Top 10 HashTags by everyone";
	// echo "<br><br>";
	// $trendsloc = $connection->get("trends/place", ["id" => '1']);
	// $i = 1;
	// foreach ($trendsloc as $trends){
	// 	$tlist = $trends->trends;
	// 	foreach($tlist as $trend){
	// 		echo $i;
	// 		echo ". ";
	// 		echo $trend->name;
	// 		echo "<br>";
	// 	$i++;
	// 	}
		
	// }

	// tristan work in progress 

	// echo "Search Results";

	// echo "<br><br>";

	// $results = $connection->get("search/tweets" , ["search parameter"]);

	// $i = 1;
	// $resultlist = $results->statuses; //gets an array of statuses returned
	// foreach ($resultlist->statuses as $result) //goes through each status
	// {
	// 	foreach($result as $tweet)	//goes through each componenet of the status and spits out relevant info
	// 	{
	// 		echo $i;

	// 		echo ". ";

	// 		echo $tweet->text;

	// 		echo " by "; //for tristan 
	// 		echo $tweet->user->name;
	// 		echo "<br>";

	// 		$i++;
	// 	}
		
	// }


	// 38.9072° N, 77.0369° W
	

	// echo "Top 10 tweets in that area";
	// echo "<br><br>";
	// $results = $connection->get("search/tweets", ["q" => 'game of thrones', "count" => '100']);

	// $i = 1;
	// // $resultlist = $results.statuses; //gets an array of statuses returned
	// // print_r($results);
	// foreach ($results as $result) //goes through each status
	// {
	// 	foreach($result as $tweet)	//goes through each componenet of the status and spits out relevant info
	// 	{
	// 		echo $i;

	// 		echo ". ";

	// 		echo $tweet->text;

	// 		// echo " by ";
	// 		// echo $tweet->user->screen_name;
	// 		echo "<br>";

	// 		$i++;



	// 	}
	// 	if ($i > 100){
	// 		break;
	// 	}
	// }

	// echo "User Search Results";

	// echo "<br><br>";

	// $results = $connection->get("users/search" , ['q' => "dj"]);

	// $i = 1;
	// // print_r(json_encode($results))
	// // print_r($results);
	// foreach ($results as $result) //goes through each result
	// {
	// 	echo $result->screen_name;
	// 			echo "<br>";
	// 			echo "<br>";
	// 	// echo $result->status->text;
	// 	/*relevant functions 
			
	// 		$result->name 						difference?
	// 		$result->profile_image_url
	// 		$result->status->text; //returns differenec
	// 	*/
	// }


		// if($favorites>=5){

	// 		$embed = $connection->get("https://api.twitter.com/1/statuses/oembed.json?id=".$tweet->id);

	// 		echo $embed->html;

	// 		print_r("success");

			// print_r($tweets);
		// }
	
?>



