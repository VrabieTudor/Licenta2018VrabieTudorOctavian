import 'bootstrap';

import 'angular';
import "angular-animate";
import '@uirouter/angularjs';
import '../../bower_components/ng-scrollable/src/ng-scrollable';
import '../../dist/js/rzslider';
import '../../dist/js/rzslider.min.js';
import 'ui-select';
import 'angular-sanitize';
import 'angular-ui-bootstrap';
import "angular-moment";
import "moment";
import './resources';
import './pages';
import 'angularjs-slider';
import Config from './config';

angular.module('app', [
    'ui.router',
    'ui.bootstrap',
    'angularMoment',
    'app.resources',
    'app.pages',
    'ngAnimate',
    'ui.select',
    'ngScrollable',
    'rzModule',
    'ngSanitize'
]);

angular.module('app').config(/* @ngInject */ ($locationProvider, $urlRouterProvider, $qProvider) => {
    // silence unhandled rejections
    $qProvider.errorOnUnhandledRejections(false);

    // remove ! from url
    $locationProvider.hashPrefix('');

    // default route
    $urlRouterProvider.otherwise(function() {
        return '/';
    });
});

angular.module('app').value('AppConfig', Config);



