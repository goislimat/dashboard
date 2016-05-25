angular.module('app.controllers')
    .controller('ProjectNoteNewController',
        ['$scope', '$routeParams', '$location', 'ProjectNote', function($scope, $routeParams, $location, ProjectNote)
        {
            $scope.projectNote = new ProjectNote();

            $scope.save = function()
            {
                if($scope.form.$valid)
                {
                    $scope.projectNote.project_id = $routeParams.idProject;
                    $scope.projectNote.$save({idProject: $routeParams.idProject}).then(function()
                    {
                        $location.path('/project/'+ $routeParams.idProject +'/notes');
                    });
                }
            };
        }]);