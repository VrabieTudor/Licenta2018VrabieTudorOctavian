let footerModule = angular.module('app.footer', []);

import FooterCtrl from './footer.controller';
footerModule.controller('FooterCtrl', FooterCtrl);

import FooterDirective from './footer.directive';
footerModule.directive('mainFooter', FooterDirective.directiveFactory);

export default footerModule;