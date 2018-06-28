class FlightRoutes {
    constructor($stateProvider) {
        $stateProvider.state('flight', {
            url: '/flights/{fromDate}/{toDate}/{from}/{to}/{adults}/{children}/{typeFlight}',
            //params: {model : null},
            template: require('./flight.pug'),
            controller: 'FlightCtrl',
            controllerAs: '$flightCtrl',
        });
    }

    /* @ngInject */
    static routesFactory($stateProvider) {
        FlightRoutes.instance = new FlightRoutes($stateProvider);
        return FlightRoutes.instance;
    }
}

export default FlightRoutes;






