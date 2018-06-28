class CityRoutes {
    constructor($stateProvider) {
        $stateProvider.state('cities', {
            url: '/cities',
            template: require('./cities.pug'),
            controller: 'CityCtrl',
            controllerAs: '$cityCtrl',
        });
    }

    /* @ngInject */
    static routesFactory($stateProvider) {
        CityRoutes.instance = new CityRoutes($stateProvider);
        return CityRoutes.instance;
    }
}

export default CityRoutes;