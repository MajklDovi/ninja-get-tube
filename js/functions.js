/*
 *
 *  Copyright (c) Michal Dovičovič
 *
 */

// Define route provider
angular.module('project', []).
  config(['$routeProvider', function($routeProvider) {
    $routeProvider.
      when('/videos', {controller:ListCtrl, templateUrl:'list.html'}).
      when('/add', {controller:CreateCtrl, templateUrl:'list.html'}).
      when('/videos/:videoId', {controller:VideoDetailCtrl, templateUrl:'detail.html'}).
      otherwise({redirectTo:'/videos'});
  }]);


// Input form with link parser
function inputForm() {
		var url = document.forms["form"]["link"].value;
		// URL parser
		var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
		var match = url.match(regExp);
		if (match&&match[7].length==11){
			var b=match[7];
		var video_id = b; // URL is parsed
		}else{
			alert("Not a YouTube address!");
		}

		// get video information in JSON format
		$.getJSON('http://gdata.youtube.com/feeds/api/videos/'+video_id+'?v=2&alt=jsonc', function(data,status,xhr){
		//alert(status);
		
			// send POST request
			$.ajax({
				type: 'POST',
				contentType: 'application/json',
				url: 'index.php/add',
				dataType: "json",
				data: JSON.stringify({
					 "p": video_id,
					 "title": data.data.title,
					 "image": data.data.thumbnail.sqDefault,
					 "author": data.data.uploader,
					 "description": data.data.description,
					 "link": url
				}),
				success: function(data, textStatus, jqXHR){
					alert('Video created successfully');
					document.location.reload(true);
				},
				error: function(jqXHR, textStatus, errorThrown){
					alert('addVideo error: ' + textStatus);
					document.location.reload(true);
				}
			});

		});
}

// Controller of video detail (gets one video from database)
function VideoDetailCtrl($scope, $routeParams, $http) {
	$http.get('index.php/videos/' + $routeParams.videoId).success(function(data) {
		$scope.video = data;
	}).
	error(function(data, status) {
		$scope.data = data || "Request failed";
        $scope.status = status;
	});
}

// Controller of video list (gets all videos from database)
function ListCtrl($scope, $routeParams, $http) {
	$http({method: 'GET', url: 'index.php/videos', headers: {'Content-Type': 'application/json'}}).
	success(function(data, status) {
		$scope.data = data;
	}).
	
	error(function(data, status) {
		$scope.data = data || "Request failed";
        $scope.status = status;
	});	
}

// Controller of video deleting (deletes video from database)
function DeleteCtrl ($scope, $routeParams, $http) {
	$scope.delete = function (){
		$http({method: 'DELETE', url: 'index.php/videos/' + $routeParams.videoId, headers: {'Content-Type': 'application/json'}}).
		success(function(data, status) {
			$scope.data = data;
			alert('Video ' +data.title+ ' successfully deleted.')
		}).
		
		error(function(data, status) {
			$scope.data = data || "Request failed";
			$scope.status = status;
		});	
	}

}

// Controller of video list creating
function CreateCtrl($scope, $http) {
	$http({method: 'GET', url: 'index.php/videos', headers: {'Content-Type': 'application/json'}}).
	success(function(data, status) {
		$scope.data = data;
	}).
	
	error(function(data, status) {
		$scope.data = data || "Request failed";
        $scope.status = status;
	});	
}






