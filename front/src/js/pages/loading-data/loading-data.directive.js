import LoadingDataController from "./loading-data.controller";

class LoadingDataDirective {
    constructor() {
        this.restrict = "E";
        this.template = require('./loading-data.pug');
        this.controller = "LoadingDataController";
    }

    static directiveFactory() {
        LoadingDataDirective.instance = new LoadingDataDirective();
        return LoadingDataDirective.instance;
    }
}

LoadingDataDirective.directiveFactory.$inject = [];

export default LoadingDataDirective;