
<?php

	// session_start();

	require_once("autoload.php");
	require_once('src/TwitterOAuth.php');
	use Abraham\TwitterOAuth\TwitterOAuth;
  $lat = '';
  $lng = '';
  $out="";
 
	if(isset($_GET['submit'])){
		$val = htmlentities($_GET['inputSearch']);
		$searchType = htmlentities($_GET['searchType']);
		$lat = htmlentities($_GET['lat']);
		$lng = htmlentities($_GET['lng']);
		
		$geoLoc = $lat."\n".$lng."\n";

		$geoFile = fopen("geoLocations.txt", "w") or die("Unable to open file!");
		fwrite($geoFile, $geoLoc);
		fclose($geoFile);
    //$result = $val; 
	}

  function searchRelevance($query, $count, $latitude, $longitude, $radius)
  {
    $apikey = "oTk1GPfPsepAvcRkTITqwi4fd";
    $apisecret = "WMYmOzRbLcfW5lPbuFwQtoKqyWkubsKYUDhsgnpTDqe9Zq5u04";
    $accesstoken = "357659837-4NI7LhZr76ybwvw4HhG0ZwcofroXEZIG2k06QkAi";
    $accesssecret = "oKTzLO6iGHOR1PNwD56tgLhB7zUEaU0bSRDFSEHYEYF9F";
    
    $connection = new TwitterOAuth($apikey, $apisecret, $accesstoken, $accesssecret);
    $lat = $latitude;
    $lng = $longitude;
    $geo = ''.$latitude.','.$longitude.','."1000".'mi';
    //echo $geo;
    $results = $connection->get("search/tweets", ["q" => $query, "count" => 10, "geocode" => $geo]);
    $i = 1;
    // $resultlist = $results.statuses; //gets an array of statuses returned
    // print_r($results);
    $out = "";
	$users = "";
	$geoLocations = "";
	
    foreach ($results as $result) //goes through each status
    {
     foreach($result as $tweet)  //goes through each componenet of the status and spits out relevant info
     {
        //echo $i;
        //echo ". ";
        //echo $tweet->text;
        //echo $tweet->coordinates;
        //echo " by ";
        //echo $tweet->users->screen_name;
        $out = $out.$tweet->text."\n";
		$users = $users.$tweet->user->screen_name."\n";
		/*
		if($tweet->geo == null || $tweet->geo == ""){
			$geoLocations = $geoLocations."null\n";
		}else{
			$geoLocations = $geoLocations.$tweet->coordinates."\n";
		}*/
        // echo "<br>";
        $i++;
     }
     if ($i > $count){
	   break;
     }
    }
    $myfile = fopen("tweetList.txt", "w") or die("Unable to open file!");
	fwrite($myfile, $out);
	fclose($myfile);
	$userFile = fopen("tweetUsers.txt", "w") or die("Unable to open file!");
	fwrite($userFile, $users);
	fclose($userFile);
	//$geoFile = fopen("geoLocations.txt", "w") or die("Unable to open file!");
	//fwrite($geoFile, $geoLocations);
	//fclose($geoFile);
    //echo $out;
    
  }

	function searchUser($query){

		$apikey = "oTk1GPfPsepAvcRkTITqwi4fd";
		$apisecret = "WMYmOzRbLcfW5lPbuFwQtoKqyWkubsKYUDhsgnpTDqe9Zq5u04";
		$accesstoken = "357659837-4NI7LhZr76ybwvw4HhG0ZwcofroXEZIG2k06QkAi";
		$accesssecret = "oKTzLO6iGHOR1PNwD56tgLhB7zUEaU0bSRDFSEHYEYF9F";

		$connection = new TwitterOAuth($apikey, $apisecret, $accesstoken, $accesssecret);

		$results = $connection->get("users/search" , ['q' => $query, "count" => "10"]);
		// return json_encode($results);

		$i = 1;
		$out = "";
		// print_r($results);
		foreach ($results as $result) //goes through each result
		{
			$out = $out."<li class = \"list-group-item\"><a class = \"custom-link\" href = \""."https://twitter.com/".$result->screen_name."\">".$result->screen_name."</a></li>";
			// 	// echo $result->status->text;
			$i++;
			if($i>10)
				break;
		}
		echo $out;
	}

	function tweetsbyUser($screen_name, $count)
	{

		$apikey = "oTk1GPfPsepAvcRkTITqwi4fd";
		$apisecret = "WMYmOzRbLcfW5lPbuFwQtoKqyWkubsKYUDhsgnpTDqe9Zq5u04";
		$accesstoken = "357659837-4NI7LhZr76ybwvw4HhG0ZwcofroXEZIG2k06QkAi";
		$accesssecret = "oKTzLO6iGHOR1PNwD56tgLhB7zUEaU0bSRDFSEHYEYF9F";



		$connection = new TwitterOAuth($apikey, $apisecret, $accesstoken, $accesssecret);
		
		// $tweets = $connection->get('statuses/user_timeline', array('screen_name' => $screen_name, 'count' => $count));
		$tweets = $connection->get("statuses/home_timeline", ['screen_name' => $screen_name, 'count' => $count]);
		// return json_encode($tweets);
		//print_r($tweets); prints objects
		//echo "Latest 10 tweets by " + $screen_name;
		//echo "<br>";
		//echo "<br>";
		$i = 1;
		$out = "";
		foreach ($tweets as $tweet)
		{
			//echo $i;
			//echo ". ";
			//echo $tweet->text;
			$out.$tweet->text."\n";
			//echo "<br>";
			$i++;

			if($i>=$count)
				break;
		}
		
		$myfile = fopen("tweetsByUser.txt", "w") or die("Unable to open file!");
		fwrite($myfile, $out);
		fclose($myfile);
		//echo $out;
	}

  function topHashtags()
  {
    $apikey = "oTk1GPfPsepAvcRkTITqwi4fd";
    $apisecret = "WMYmOzRbLcfW5lPbuFwQtoKqyWkubsKYUDhsgnpTDqe9Zq5u04";
    $accesstoken = "357659837-4NI7LhZr76ybwvw4HhG0ZwcofroXEZIG2k06QkAi";
    $accesssecret = "oKTzLO6iGHOR1PNwD56tgLhB7zUEaU0bSRDFSEHYEYF9F";


    $connection = new TwitterOAuth($apikey, $apisecret, $accesstoken, $accesssecret);

    $trendsloc = $connection->get("trends/place", ["id"=>'1']);
    $i = 1;
    $out = "";
    foreach ($trendsloc as $trends){
     $tlist = $trends->trends;
     foreach($tlist as $trend){
      $out = $out.$trend->name."\n";
      $i++;
      if($i>10)
        break;
      
     }
    }
    //echo $out;
	$myfile = fopen("topHashTags.txt", "w") or die("Unable to open file!");
	fwrite($myfile, $out);
	fclose($myfile);
  }



?>

<!-- <div class="col-xs-3 nopadding" style="background-color: grey; border-right: 1px solid; border-right-color: black;" id="left">


        <h2 class="simplepadding" style="color:#ffffff;">Top 10 Hashtags</h2>

     	<?php 

     		// searchUser("Ndinani_8965");
     		// tweetsbyUser("techedrob","10");

		?>
      </div> -->
<!DOCTYPE html>
<html ng-app="tWorld">
<head>
    <title>T-World</title>
  <meta charset="utf-8" />
    <!--Styles (CDN)-->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link href='https://fonts.googleapis.com/css?family=Titillium+Web' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Styles (Author)-->
    <link href="css/styles.css" rel="stylesheet">
    <!--Scripts (Critical Dependencies)-->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.0/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyA6_u0eLSwz39Nwu3OWPwI5EF4JSQs42B0"></script>
    <script src="js/globe.js"></script>
    
    <style>
    /*  ******************** Colour reference chart****************
           *************************** comment ********* colour ********
box navbar colour                 dark-blue               #4A89DC
box navbar light colour           light-blue              #5D9CEC
box background colour             dark-gray               #434A54
box backgrounf light colour       light-gray              #656D78
*/
</style>
</head>
<body ng-controller="mainCtrl">
  <!-- begin template -->
  <div class="navbar navbar-custom navbar-fixed-top">
   <div class="navbar-header"><a class="navbar-brand" href="#"><b style="font-size:25px;">T-World</b></a>
        <a class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>
      </div>
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li class="active"><a href="#">All</a></li>
          <li><a href="#">Twitter</a></li>
          <li><a href="#">Instagram</a></li>
          <li><a href="#">Facebook</a></li>
          <li>&nbsp;</li>
        </ul>
        <form class="navbar-form" method="get" action="">
          <div class="form-group pull-right" style="display:inline; ">
            <div class="input-group" style="padding-left:20px;">
              <label for="sel1">Select list:</label>
              <input name="user" type="radio" ng-model="searchType" value="User"></input><label for="user">User</label>
              <input name="tweets" type="radio" ng-model="searchType" value="Tweets"></input></input><label for="tweets">Tweets</label>
              <input name="tu" type="radio" ng-model="searchType" value="TweetsByUser"></input></input><label for="tu">Tweets By User</label>
              <input name="inputSearch" id="inputSearch"  class="blue-form" type="text" style="width:250px;" placeholder="What are you searching for?"></input>
              <input ng-show="RESULTS_DISPLAY" id="searchType" name="searchType" ng-value="searchType"></input>
              
              <input ng-model="lat" ng-show="RESULTS_DISPLAY" id="lat" name="lat" ng-value="lat"></input>
              <input ng-model="lng" ng-show="RESULTS_DISPLAY" id="lng" name="lng" ng-value="lng"></input>
                   
              <input name="submit" type="submit"></input>
            </div>
          </div>
        </form>
      </div>
  </div>
  <div id="map-canvas"></div>
  <div class="container-fluid" id="main">
    <div class="row">
      <div class="col-xs-3 nopadding" style="background-color:#434A54; border-right: 1px solid; border-right-color: black;" id="left">
        <h2 class="simplepadding" style="color:#ffffff;">Top 10 Hashtags</h2>

        <p class="simplepadding" style="color:#ccc; font-size:13px;">The following are the ten most popular hashtags found given your query result</p>
        <br>
		<ul id="tweetList" class = "list-group" style ="width:85%; margin:auto">
          <?php 
            if(isset($val)){

              if($searchType == "User"){
                searchUser($val,10);
              }
              else if($searchType == "Tweets"){
                searchRelevance($val, 10, $lat, $lng, 1000);
              }
              else if($searchType == "TweetsByUser"){
                tweetsbyUser($val, 10);
              }
            }
            else
              {
                topHashtags();
              }

            // searchRelevance($val, 10, 1, 1, 0);
            // topHashtags();

        ?>
        </ul>
        <br>
          

      </div>
      <div id="mapContainer" class="col-xs-9"></div>
      </div>
    </div>
  
  <!-- end template -->
    <!--Scripts (CDN)-->
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.0/angular-animate.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.0/angular-aria.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.0/angular-messages.min.js"></script>
    
</body>
</html>