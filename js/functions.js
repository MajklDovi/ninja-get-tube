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
      when('/videos/:videoId', {controller:PhoneDetailCtrl, templateUrl:'detail.html'}).
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
		$.getJSON('http://gdata.youtube.com/feeds/api/videos/'+video_id+'?v=2&alt=jsonc',function(data,status,xhr){
		//alert(data.data.title);
		
			// send POST request
			$.ajax({
				type: 'POST',
				contentType: 'application/json',
				url: 'index.php/add',
				dataType: "json",
				data: JSON.stringify({
					 "id": video_id,
					 "title": data.data.title,
					 "image": data.data.thumbnail.sqDefault,
					 "author": data.data.uploader,
					 "description": data.data.description,
					 "link": url
				}),
				success: function(data, textStatus, jqXHR){
					alert('Video created successfully');
				},
				error: function(jqXHR, textStatus, errorThrown){
					alert('addVideo error: ' + textStatus);
				}
			});

		});
}


function PhoneDetailCtrl($scope, $routeParams, $http) {
  $http.get('index.php/videos/' + $routeParams.videoId).success(function(data) {
    $scope.video = data;
  });
}


function ListCtrl($scope, $routeParams, $http) {
/*	$http({method: 'DELETE', url: 'index.php/videos/', headers: {'Content-Type': 'application/json'}}).
	success(function(data, status) {
		$scope.data = data;
	}).
	
	error(function(data, status) {
		$scope.data = data || "Request failed";
        $scope.status = status;
	}); */
}

function DeleteCtrl ($scope, $routeParams, $http) {
	$http({method: 'DELETE', url: 'index.php/videos/' + $routeParams.videoId, headers: {'Content-Type': 'application/json'}}).
	success(function(data, status) {
		$scope.data = data;
	}).
	
	error(function(data, status) {
		$scope.data = data || "Request failed";
        $scope.status = status;
	});	
	

}

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






