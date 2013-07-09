/*
 *
 *  Copyright (c) Michal Dovičovič
 *
 */


angular.module('project', []).
  config(function($routeProvider) {
    $routeProvider.
      when('/', {controller:ListCtrl, templateUrl:'list.html'}).
      when('/add', {controller:CreateCtrl, templateUrl:'list.html'}).
      otherwise({redirectTo:'/'});
  });

function VideoListCtrl() {
   // this.videos = Video.query();

}




// Input form with link parser
function inputForm() {
		var url = document.forms["form"]["link"].value;
		// URL parser
		var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
		var match = url.match(regExp);
		if (match&&match[7].length==11){
			var b=match[7];
		var video_id = b;
		}else{
			alert("Not a YouTube address!");
		}

		$.getJSON('http://gdata.youtube.com/feeds/api/videos/'+video_id+'?v=2&alt=jsonc',function(data,status,xhr){
			alert(data.data.title);
			

		});
}

function ListCtrl($scope, $http) {
	$scope.video_id = "3f3n4DZvaIg";
	$http({method: 'POST', url: 'http://www.stud.fit.vutbr.cz/~xdovic00/tube/videos', data: { "ID" : $scope.video_id }}).
		success(function(data, status) {
			$scope.data = data;
			alert(data);
		}).	
		error(function(data, status, headers, config) {
			$scope.status = status;
		});
}

function CreateCtrl($scope, $http) {
	$http({method: 'GET', url: '#/'}).
	success(function(data, status) {
		$scope.data = data;
	}).
	
	error(function(data, status) {
		$scope.data = data || "Request failed";
        $scope.status = status;
	});	
}



