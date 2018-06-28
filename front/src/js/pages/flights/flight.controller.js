import Config from '../../config';

class FlightCtrl {
    constructor(Search, Place, City, $timeout, $state, moment, $scope, $stateParams, $uibModal) {
        this.Search = Search;
        this.City = City;
        this.Place = Place;
        this.pageLoaded = false;
        this.modalLoaded = true;
        this.$scope = $scope;
        this.$uibModal = $uibModal;
        this.$stateParams = $stateParams;
        this.$scope.duration = 200;
        this.$scope.price = 5000;
        this.$state = $state;
        this.$timeout = $timeout;
        this.$scope.getCdOnCat = (searchVal) => {
            this.cityArray = [];
            return this.getData(searchVal).$promise.then(res => {
                this.cityArray = res.data;
                this.arrayBackup = angular.copy(this.cityArray);
                return this.cityArray;
            });
        };

        this.popover = (lat, lng, keyword = "hotel") => {
            const param = {
                lat,
                lng,
                keyword,
            };
            this.Place.list(param).$promise.then(res => {
                this.places = res.data;
                this.modalLoaded = true;
            });
        };
        this.openPlacesModal = (lat, lng, airportCode) => {
            this.airport = airportCode;
            this.lat = lat;
            this.lng = lng;
            this.modalLoaded = false;
            this.popover(lat, lng);
        };
        this.shut = {};
        this.shut.adults = parseInt(this.$stateParams.adults);
        this.shut.children = parseInt(this.$stateParams.children);
        this.shut.from = this.$stateParams.from;
        this.shut.to = this.$stateParams.to;
        this.shut.sortBy = 'asc';
        this.shut.fromDate = new Date(this.$stateParams.fromDate);
        this.shut.toDate = new Date(this.$stateParams.toDate);
        this.shut.connection = 'unlimited';
        this.shut.typeFlight = this.$stateParams.typeFlight;
        this.$scope.flightOptions = {
            onChange: (sliderId, modelValue, highValue, pointerType) => {
                this.shut.flightDuration = modelValue;
            }
        };
        this.$scope.priceOptions = {
            onChange: (sliderId, modelValue, highValue, pointerType) => {
                this.shut.maxPrice = modelValue;
            }
        };
        this.submitSearch(this.shut);
    }
    submitSearch(model) {
        this.pageLoaded = false;
        this.Search.search(model).$promise.then(res => {
            this.response = res.data;
            if(this.response.flights.length === 0) {
                this.$state.go('404');
            }
            this.height = this.response.maxRoutes * 262;
            this.pageLoaded = true;
        });
    }

    buy(link) {
        window.open(
            link,
            '_blank'
        );
    }
    searchModal() {
        this.modalLoaded = false;
        this.popover(this.lat, this.lng, this.searchModalValue);
    }
}

/* @ngInject */
export default FlightCtrl;