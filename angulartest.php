<!DOCTYPE html>
<html>
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
<body>

<div ng-app="myApp" ng-controller="followersCtrl">

    <ul>
        <li ng-repeat="x in followers">
            {{ x.login + ', ' + x.html_url }}
        </li>
    </ul>

</div>

<script>

    var app = angular.module('myApp', []);

    app.controller('followersCtrl', function($scope, $http)
    {
        $http.get("https://api.github.com/users/ICE-WOLF/followers")
        .then(function (response) {$scope.followers = response.data;});
    });
</script>

</body>
</html>