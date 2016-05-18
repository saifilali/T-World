//Control visibility of member functions with closure
//Globe Renderer

var tWorld = angular.module('tWorld', []);

tWorld.controller('mainCtrl', ['$scope', '$window', '$http', function ($scope, $window, $http) {

    //Google Maps API calls
    //Will only be called once on page load so doesn't need to be in $scope

    var MAX_TWEETS = 10;
    $scope.searchTrend = '';
    $scope.RESULTS_DISPLAY = false;
    $scope.lat = 30.6280;
    $scope.lng = -96.3344;
    $scope.tweetList = "";
	$scope.tweetUsers = "";
	$scope.tweetsByUser = "";
    $scope.searchType = "";
	$scope.geoLocation = "";
	
    var map = new google.maps.Map(document.getElementById('mapContainer'), {
        //College Station
        center: {
            lat: 30.6280,
            lng: -96.3344
        },
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        zoom: 5,
		styles: [
	  {
		"elementType": "geometry",
		"stylers": [
		  { "hue": "#00c3ff" },
		  { "invert_lightness": true },
		  { "visibility": "on" }
		]
	  },{
		"featureType": "water",
		"stylers": [
		  { "visibility": "off" }
		]
	  },{
		"featureType": "administrative.locality",
		"stylers": [
		  { "hue": "#00ddff" },
		  { "visibility": "simplified" }
		]
	  },{
		"featureType": "road.highway.controlled_access",
		"stylers": [
		  { "visibility": "off" }
		]
	  },{
		"featureType": "transit.line",
		"stylers": [
		  { "visibility": "off" }
		]
	  },{
		"featureType": "transit.station",
		"stylers": [
		  { "visibility": "off" }
		]
	  },{
		"featureType": "water",
		"stylers": [
		  { "visibility": "on" },
		  { "color": "#000000" }
		]
	  },{
		"featureType": "road.highway",
		"stylers": [
		  { "visibility": "simplified" }
		]
	  },{
		"elementType": "labels.text.stroke",
		"stylers": [
		  { "visibility": "on" },
		  { "hue": "#00d4ff" },
		  { "color": "#00d4ff" }
		]
	  }
	]
    });
	
	function readTweetList(file)
	{
		var rawFile = new XMLHttpRequest();
		rawFile.open("GET", file, false);
		rawFile.onreadystatechange = function ()
		{
			if(rawFile.readyState === 4)
			{
				if(rawFile.status === 200 || rawFile.status == 0)
				{
					$scope.tweetList = rawFile.responseText;
				}
			}
		}
		rawFile.send(null);
	}
	
	function readTweetUsers(file)
	{
		var rawFile = new XMLHttpRequest();
		rawFile.open("GET", file, false);
		rawFile.onreadystatechange = function ()
		{
			if(rawFile.readyState === 4)
			{
				if(rawFile.status === 200 || rawFile.status == 0)
				{
					$scope.tweetUsers = rawFile.responseText;
				}
			}
		}
		rawFile.send(null);
	}
	function readGeolocation(file)
	{
		var rawFile = new XMLHttpRequest();
		rawFile.open("GET", file, false);
		rawFile.onreadystatechange = function ()
		{
			if(rawFile.readyState === 4)
			{
				if(rawFile.status === 200 || rawFile.status == 0)
				{
					$scope.geoLocation = rawFile.responseText;
				}
			}
		}
		rawFile.send(null);
	}
    
    google.maps.event.addDomListener(window, 'load', function(event){
		
		readTweetList("http://localhost/tweetList.txt");
		readTweetUsers("http://localhost/tweetUsers.txt");
		readGeolocation("http://localhost/geoLocations.txt");
		//readUserTweets("http://localhost/tweetsByUser.txt");
		var location = $scope.geoLocation.split('\n');
		
		$scope.lat = Number(location[0]);
		$scope.lng = Number(location[1]);
		placeMarker({lat: $scope.lat, lng: $scope.lng}, false);    
    });

    function placeMarker(location, isClickEvent) {
		
		if(!isClickEvent){
			var tweetTemplate = "<div class=\"tweetWrapper\">";
			var tweets = $scope.tweetList.split('\n');
			var users = $scope.tweetUsers.split('\n');
			
			
			for (var i = 0; i < tweets.length; i++) {
				 var user = users[i];
				 var status = tweets[i];
				 var tweet = "<div><blockquote class='twitter-tweet'><p>" + status + "</p>-" + user + "</blockquote></div>";
				 tweetTemplate += tweet;
			 }
			tweetTemplate += "</div>"
			console.log($scope.tweetList);
			var marker = new google.maps.Marker({
				position: location,
				map: map
			});
			var infowindow = new google.maps.InfoWindow({
				content: tweetTemplate
			});
			infowindow.open(map, marker);
		}
        
    }

    google.maps.event.addDomListener(map, 'click', function (event) {
        placeMarker(event.latLng, true);
        //$scope.geoLocation = 
        // longitude is lng()
        $scope.lat = event.latLng.lat();
        $scope.lng = event.latLng.lng();
        document.getElementById("lat").value = $scope.lat;
        document.getElementById("lng").value = $scope.lng;
        console.log($scope.searchTrend);
        console.log($scope.searchType);
        console.log($scope.lat);
        console.log($scope.lng);
    });
    // $scope.showList(){
    //     if($scope.searchType == "Users"){
    //         return true;
    //     }
    //     return false;
    // }
    //end of google maps api calls
    $scope.search = function () {
        

    }


}]);




   
