import config from '../config';

const Search = /* @ngInject */ ($resource) => {
    return $resource(config.apiEndpoint + 'search', {}, {
        search: {
            method: 'GET',
            url: config.apiEndpoint + '/search',
        }
    });
};

export default Search;