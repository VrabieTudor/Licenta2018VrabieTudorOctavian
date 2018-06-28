import config from '../config';

const City = /* @ngInject */ ($resource) => {
    return $resource(config.apiEndpoint + 'city', {}, {
        list: {
            method: 'GET',
            url: config.apiEndpoint + '/cities',
        }
    });
};

export default City;