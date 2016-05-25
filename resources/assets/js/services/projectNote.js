angular.module('app.services')
    .service('ProjectNote', ['$resource', 'appConfig', function ($resource, appConfig) {
        return $resource(appConfig.baseUrl + '/project/:idProject/note/:idNote', {idProject: '@idProject', idNote: '@idNote'}, {
            update: {
                method: 'PUT'
            }
        });
    }]);