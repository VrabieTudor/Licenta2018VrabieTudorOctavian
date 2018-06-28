import CityCtrl from './cities.controller';
import CityRoutes from './cities.routes';

let homeModule = angular.module('app.cities', []);

homeModule.config(CityRoutes.routesFactory);
homeModule.controller('CityCtrl', CityCtrl);

export default homeModule;