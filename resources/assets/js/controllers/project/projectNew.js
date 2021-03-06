angular.module('app.controllers')
    .controller('ProjectNewController',
        ['$scope', '$location', '$cookies', 'Project', 'Client', 'appConfig',
        function($scope, $location, $cookies, Project, Client, appConfig)
        {
            $scope.project = new Project();
            $scope.clients = Client.query();
            $scope.status = appConfig.project.status;

            $scope.project.owner_id = $cookies.getObject('user').id;

            $scope.save = function() {
                console.log($scope.project);
                if ($scope.form.$valid)
                {
                    $scope.project.$save().then(function () {
                        $location.path('/projects');
                    });
                }
            }
        }]);