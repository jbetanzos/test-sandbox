require('./bootstrap');
import 'angular';

var app = angular.module('taskLisApp', [], ['$httpProvider', function ($httpProvider) {
    $httpProvider.defaults.headers.post['X-CSRF-TOKEN'] = $('meta[name=csrf-token]').attr('content');
    $httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
}]);

app.controller('TaskListController', ['$scope', '$http', function($scope, $http) {
    $scope.tasks = [];
    $scope.ctasks = [];
    $scope.newTask = {
        description: ''
    };

    $scope.loadTasks = function () {
        $http.get('/api/tasks').then(function success(e) {
            $scope.tasks = e.data;
        });
    };

    $scope.delete = function (id) {
        $http.delete('/api/task/' + id).then(function success(e) {
            $scope.loadTasks();
        });
    };

    $scope.complete = function (task) {
        if (task.selected) {
            $http.put('/api/task/' + task.id).then(function success(e) {
                $scope.loadTasks();
                $scope.loadCompleteTasks();
            });
        }
    };

    $scope.loadCompleteTasks = function () {
       $http.get('/api/tasks/done').then(function success(e) {
           $scope.ctasks = e.data;
       });
    };

    $scope.create = function () {
        $http.post(
            '/api/task',
            $.param({description: $scope.newTask.description})
        ).then(function success(e){
            $scope.loadTasks();
            $scope.newTask.description = '';
        });
    };

    $scope.loadTasks();
    $scope.loadCompleteTasks();
}]);