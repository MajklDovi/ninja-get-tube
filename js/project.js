angular.module('project', ['mongolab']).
  config(function($routeProvider) {
    $routeProvider.
      when('/', {controller:ListCtrl, templateUrl:'list.html'}).
      otherwise({redirectTo:'/'});
  });

function ListCtrl($scope, Project) {
  $scope.videos = Project.query();
  $scope.archive = function() {
    var oldVideos = $scope.videos;
    $scope.videos = [];
    $scope.doneProjects = [];
    angular.forEach(oldTodos, function(video) {
      if (!video.done) $scope.videos.push(video);
      else $scope.doneProjects.push(video);
    });
  }	
}
 
 
function CreateCtrl($scope, $location, Project) {
  $scope.save = function() {
    Project.save($scope.video, function(video) {
      $location.path('/edit/' + video._id.$oid);
    });
  }
}
 
 
function EditCtrl($scope, $location, $routeParams, Project) {
  var self = this;
 
  Project.get({id: $routeParams.projectId}, function(video) {
    self.original = video;
    $scope.video = new Project(self.original);
  });
 
  $scope.isClean = function() {
    return angular.equals(self.original, $scope.video);
  }

  
 
  $scope.destroy = function() {
    self.original.destroy(function() {
      $location.path('/list');
    });
  };
 
  $scope.save = function() {
    $scope.video.update(function() {
      $location.path('/');
    });
  };
}


function TodoCtrl($scope, Project) {

  $scope.trash = function() {
    var oldTodos = $scope.doneProjects;
    $scope.doneProjects = [];
    angular.forEach(oldTodos, function(video) {
      if (!video.done) $scope.doneProjects.push(video);
    });
  };
}
function Archive($scope, Project) { 
  $scope.archive = function() {
    var oldVideos = $scope.videos;
    $scope.videos = [];
    $scope.doneProjects = [];
    angular.forEach(oldVideos, function(video) {
      if (!video.done) $scope.projects.push(video);
      else $scope.doneProjects.push(video);
    });
  };
}


