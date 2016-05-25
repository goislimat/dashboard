angular.module('app.controllers')
.controller('ProjectEditController', 
    ['$scope', '$routeParams', '$cookies', '$location', 'Project', 'Client', 'appConfig',
    function ($scope, $routeParams, $cookies, $location, Project, Client, appConfig)
    {
        $scope.project = Project.get({id: $routeParams.id});
        $scope.clients = Client.query();
        $scope.status = appConfig.project.status;
        
        $scope.save = function()
        {
            $scope.project.owner_id = $cookies.getObject('user').id;

            Project.update(
                {
                    id: $scope.project.id
                },
                $scope.project, 
                function()
                {
                    $location.path('/projects');
                });
        };
        
    }]);