class HeaderDirective {
    constructor() {
        this.restrict = "E";
        this.template = require('./header.pug');
        this.controller = "HeaderCtrl";
    }

    static directiveFactory() {
        HeaderDirective.instance = new HeaderDirective();
        return HeaderDirective.instance;
    }
}

HeaderDirective.directiveFactory.$inject = [];

export default HeaderDirective;