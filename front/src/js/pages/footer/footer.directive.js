class FooterDirective {
    constructor() {
        this.restrict = "E";
        this.template = require('./footer.pug');
        this.controller = "FooterCtrl";
    }

    static directiveFactory() {
        FooterDirective.instance = new FooterDirective();
        return FooterDirective.instance;
    }
}

FooterDirective.directiveFactory.$inject = [];

export default FooterDirective;