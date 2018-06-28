import config from '../config';

const Place = /* @ngInject */ ($resource) => {
    return $resource(config.apiEndpoint + 'places', {}, {
        list: {
            method: 'GET',
            url: config.apiEndpoint + '/places',
        }
    });
};

export default Place;