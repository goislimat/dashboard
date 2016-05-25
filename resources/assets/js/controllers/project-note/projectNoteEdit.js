angular.module('app.controllers')
.controller('ProjectNoteEditController',
    ['$scope', '$routeParams', '$location', 'ProjectNote',
        function($scope, $routeParams, $location, ProjectNote)
        {
            $scope.projectNote = ProjectNote.get({idProject: $routeParams.idProject, idNote: $routeParams.idNote});

            $scope.save = function()
            {
                if($scope.form.$valid)
                {
                    ProjectNote.update({idProject: $scope.projectNote.project_id, idNote: $scope.projectNote.id}, $scope.projectNote, function() {
                        $location.path('/project/'+ $routeParams.idProject + '/notes');
                    });
                }
            };
        }]);