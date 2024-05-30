/**
 * Barranco Contact
 */

define([
    'jquery'
], function ($) {

    return {
        method: 'rest',
        storeCode: window.contactConfig.storeCode,
        version: 'V1',
        serviceUrl: ':method/:storeCode/:version',

        /**
         * @param {String} url
         * @param {Object} params
         * @return {*}
         */
        createUrl: function (url, params) {
            let fullUrl = this.serviceUrl + url;

            return this.bindParams(fullUrl, params);
        },

        /**
         * @param {String} url
         * @param {Object} params
         * @return {*}
         */
        bindParams: function (url, params) {
            let urlParts;

            params.method = this.method;
            params.storeCode = this.storeCode;
            params.version = this.version;

            urlParts = url.split('/');
            urlParts = urlParts.filter(Boolean);

            $.each(urlParts, function (key, part) {
               part = part.replace(':', '');

               if (params[part] !== undefined) {
                   urlParts[key] = params[part];
               }
            });

            return urlParts.join('/');
        }
    }
});
