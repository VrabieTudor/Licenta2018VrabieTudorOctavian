class HomeRoutes {
    constructor($stateProvider) {
        $stateProvider.state('home', {
            url: '/',
            template: require('./home.pug'),
            controller: 'HomeCtrl',
            controllerAs: '$homeCtrl',
        });
    }

    /* @ngInject */
    static routesFactory($stateProvider) {
        HomeRoutes.instance = new HomeRoutes($stateProvider);
        return HomeRoutes.instance;
    }
}

export default HomeRoutes;