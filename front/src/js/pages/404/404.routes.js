class ErrorRoutes {
    constructor($stateProvider) {
        $stateProvider.state('404', {
            url: '/404',
            template: require('./404.pug'),
        });
    }

    /* @ngInject */
    static routesFactory($stateProvider) {
        ErrorRoutes.instance = new ErrorRoutes($stateProvider);
        return ErrorRoutes.instance;
    }
}

export default ErrorRoutes;