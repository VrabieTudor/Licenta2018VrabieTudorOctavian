import 'angular-resource';

let resourceModule = angular.module('app.resources', [
   'ngResource'
]);

import Search from './search';
import City from './city';
import Place from './place';

resourceModule.factory('Search', Search);
resourceModule.factory('City', City);
resourceModule.factory('Place', Place);

export default resourceModule;