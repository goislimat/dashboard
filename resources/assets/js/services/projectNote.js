angular.module('app.services')
    .service('ProjectNote', ['$resource', 'appConfig', function ($resource, appConfig) {
        return $resource(appConfig.baseUrl + '/project/:project/note/:note', {project: '@project', note: '@note'}, {
            update: {
                method: 'PUT'
            }
        });
    }]);