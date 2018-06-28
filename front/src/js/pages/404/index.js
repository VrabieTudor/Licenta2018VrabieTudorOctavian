import ErrorRoutes from './404.routes';

let errorModule = angular.module('app.404', []);

errorModule.config(ErrorRoutes.routesFactory);

export default errorModule;