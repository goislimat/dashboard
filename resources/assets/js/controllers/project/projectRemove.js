angular.module('app.controllers')
.controller('ProjectRemoveController',
    ['$scope', '$routeParams', '$location', 'Project',
    function($scope, $routeParams, $location, Project)
    {
        $scope.project = Project.get({id: $routeParams.id});

        $scope.remove = function()
        {
            $scope.project.$delete().then(function() {
                $location.path('/projects');
            });
        }
    }]);