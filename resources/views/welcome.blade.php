@extends('layouts.app')

@section('content')
    <div class="container" ng-controller="TaskListController">
        <h2>ToDo list</h2>

        <form class="form-inline">
            <div class="form-group">
                <input type="text" ng-model="newTask.description" class="form-control" size="50" ng-maxlength="50" placeholder="new task" ng-required="required">
            </div>
            <input type="submit" value="Add" ng-click="create()" class="btn btn-success">
        </form>

        <hr>

        <div class="list-group-item list-group-item-warning" ng-if="tasks.length > 0">
            <div ng-repeat="task in tasks">
                <div class="container">
                    <div class="col-sm-9"><input ng-model="task.selected" ng-change="complete(task)" type="checkbox"> <span>@{{ task.description }}</span></div>
                    <div class="col-sm-3"><button ng-click="delete(task.id)" class="btn btn-danger" style="margin-top:10px">Remove</button></div>
                </div>
            </div>
        </div>

        <hr>

        <h3>Completed tasks</h3>
        <div class="list-group-item list-group-item-warning" ng-if="ctasks.length > 0">
            <div ng-repeat="ctask in ctasks">
                <div class="container">
                    <div class="col-sm-9"><input disabled type="checkbox"> <span>@{{ ctask.description }}</span></div>
                </div>
            </div>
        </div>
    </div>
@endsection
