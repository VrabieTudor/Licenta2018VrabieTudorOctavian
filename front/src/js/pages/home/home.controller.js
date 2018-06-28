import Config from '../../config';

class HomeCtrl {
    constructor(Search, City, $timeout, $state,moment, $scope) {
        this.Search = Search;
        this.City = City;
        this.$scope = $scope;
        this.pageLoaded = false;
        this.$state = $state;
        this.moment = moment;
        this.arrayBackup = [];
        this.getData();
        this.model = {
            typeFlight: 'round',
            children: 0,
            adults: 1
        };
        $timeout(() => {
            this.pageLoaded = true;
        },3000);
        this.$scope.getCdOnCat = (searchVal) => {
            this.cityArray = [];
            return this.getData(searchVal).$promise.then(res => {
                this.cityArray = res.data;
                this.arrayBackup = angular.copy(this.cityArray);
                return this.cityArray;
            });
        };
    }
    submitSearch() {
        if(this.model.from && this.model.to && this.model.fromDate) {
            let sendObj = {
                from: this.model.from.split(", ")[1],
                to: this.model.to.split(", ")[1],
                fromDate: this.moment(this.model.fromDate).format('L'),
                toDate: this.model.typeFlight === 'round' ? this.moment(this.model.toDate).format('L') : null,
                adults: this.model.adults,
                children: this.model.children,
                typeFlight: this.model.typeFlight
            };
            this.$state.go('flight', sendObj);
        }
    }
    getData(searchVal) {
        return this.City.list({search: searchVal});
    }
}

/* @ngInject */
export default HomeCtrl;