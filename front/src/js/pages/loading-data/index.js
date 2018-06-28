const loadingDataModule = angular.module('app.loading-data', []);


import LoadingDataController from './loading-data.controller';
loadingDataModule.controller('LoadingDataController', LoadingDataController);
import LoadingDataDirective from './loading-data.directive';
loadingDataModule.directive('loadingData', LoadingDataDirective.directiveFactory);

export default loadingDataModule;
