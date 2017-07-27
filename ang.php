<!DOCTYPE html>
<html>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
<body>

<div ng-app="myApp" ng-controller="myCtrl" ng-init="points=[1,15,19,2,40]" ng-init="person={firstName:'John',lastName:'Doe'}" ng-init="firstName='John';lastName='Doe'" ng-init="quantity=1;cost=5" ng-init="myCol='lightblue'">

<p>The third result is {{ points[2] }}</p>


<p>The name is {{ person.lastName }}</p>


<p>The name is {{ firstName + " " + lastName }}</p>
<p>Binding: The name is <span ng-bind="firstName + ' ' + lastName"></span></p>


  <p>My first expression: {{ 5 + 5 }}</p>

<input style="background-color:{{ myCol }}" ng-model="myCol" value="{{myCol}}">

<br/>

<p>Total in dollar: <span ng-bind="quantity * cost"></span></p>

<br/>

First Name: <input type="text" ng-model="firstName"><br>
Last Name: <input type="text" ng-model="lastName"><br>
<br>
Full Name: {{firstName + " " + lastName}}

</div>

<script>
var app = angular.module('myApp', []);
app.controller('myCtrl', function($scope) {
    $scope.firstName= "John";
    $scope.lastName= "Doe";
});
</script>


</body>
</html>