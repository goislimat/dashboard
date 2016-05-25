angular.module('app.services')
    .service('Project',
        ['$resource', '$filter', '$httpParamSerializer', 'appConfig',
            function($resource, $filter, $httpParamSerializer, appConfig)
            {
                function transformDate(data)
                {
                    if(angular.isObject(data) && data.hasOwnProperty('due_date'))
                    {
                        var dataCopy = angular.copy(data);
                        dataCopy.due_date = $filter('date')(data.due_date, 'yyyy-MM-dd');
                        return appConfig.utils.transformRequest(dataCopy);
                    }
                    return data;
                }

                return $resource(appConfig.baseUrl + '/project/:id', {id: '@id'}, {
                    save: {
                        method: 'POST',
                        transformRequest: transformDate
                    },
                    get: {
                        method: 'GET',
                        transformResponse: function(data, headers)
                        {
                            var response = appConfig.utils.transformResponse(data, headers);
                            if(angular.isObject(response) && response.hasOwnProperty('due_date'))
                            {
                                var dateArray = response.due_date.split('-');
                                var month = parseInt(dateArray[1]) - 1;
                                response.due_date = new Date(dateArray[0], month, dateArray[2]);
                            }
                            return response;
                        }
                    },
                    update:
                    {
                        method: 'PUT',
                        transformResponse: transformDate
                    }
                });
            }]);