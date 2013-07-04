angular.module('project', ['mongolab']).
  config(function($routeProvider) {
    $routeProvider.
      when('/', {controller:ListCtrl, templateUrl:'list.html'}).
      otherwise({redirectTo:'/'});
  });

function ListCtrl($scope, Project) {
  $scope.projects = Project.query();
  $scope.archive = function() {
    var oldTodos = $scope.projects;
    $scope.projects = [];
    $scope.doneProjects = [];
    angular.forEach(oldTodos, function(project) {
      if (!project.done) $scope.projects.push(project);
      else $scope.doneProjects.push(project);
    });
  }	
}
 
 
function CreateCtrl($scope, $location, Project) {
  $scope.save = function() {
    Project.save($scope.project, function(project) {
      $location.path('/edit/' + project._id.$oid);
    });
  }
}
 
 
function EditCtrl($scope, $location, $routeParams, Project) {
  var self = this;
 
  Project.get({id: $routeParams.projectId}, function(project) {
    self.original = project;
    $scope.project = new Project(self.original);
  });
 
  $scope.isClean = function() {
    return angular.equals(self.original, $scope.project);
  }

  
 
  $scope.destroy = function() {
    self.original.destroy(function() {
      $location.path('/list');
    });
  };
 
  $scope.save = function() {
    $scope.project.update(function() {
      $location.path('/');
    });
  };
}


function TodoCtrl($scope, Project) {

  $scope.trash = function() {
    var oldTodos = $scope.doneProjects;
    $scope.doneProjects = [];
    angular.forEach(oldTodos, function(project) {
      if (!project.done) $scope.doneProjects.push(project);
    });
  };
}
function Archive($scope, Project) { 
  $scope.archive = function() {
    var oldTodos = $scope.projects;
    $scope.projects = [];
    $scope.doneProjects = [];
    angular.forEach(oldTodos, function(project) {
      if (!project.done) $scope.projects.push(project);
      else $scope.doneProjects.push(project);
    });
  };
}


