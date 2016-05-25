angular.module('app.controllers')
.controller('ProjectNoteRemoveController',
    ['$scope', '$routeParams', '$location', 'ProjectNote', function($scope, $routeParams, $location, ProjectNote)
    {
        $scope.projectNote = ProjectNote.get({idProject: $routeParams.idProject, idNote: $routeParams.idNote});

        $scope.remove = function()
        {
            $scope.projectNote.$delete(
                {
                    idProject: $routeParams.idProject,
                    idNote: $routeParams.idNote
                })
                .then(function() {
                    $location.path('/project/'+ $routeParams.idProject +'/notes');
                });
        };
    }]);