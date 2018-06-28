import HomeCtrl from './home.controller';
import HomeRoutes from './home.routes';

let homeModule = angular.module('app.home', []);

homeModule.config(HomeRoutes.routesFactory);
homeModule.controller('HomeCtrl', HomeCtrl);

export default homeModule;