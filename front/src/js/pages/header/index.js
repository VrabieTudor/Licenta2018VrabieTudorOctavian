let headerModule = angular.module('app.header', []);

import HeaderCtrl from './header.controller';
headerModule.controller('HeaderCtrl', HeaderCtrl);

import HeaderDirective from './header.directive';
headerModule.directive('mainHeader', HeaderDirective.directiveFactory);

export default headerModule;