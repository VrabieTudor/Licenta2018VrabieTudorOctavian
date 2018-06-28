import FlightCtrl from './flight.controller';
import FlightRoutes from './flight.routes';

let flightModule = angular.module('app.flight', []);

flightModule.config(FlightRoutes.routesFactory);
flightModule.controller('FlightCtrl', FlightCtrl);

export default flightModule;



