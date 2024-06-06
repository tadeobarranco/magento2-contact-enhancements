/**
 * Barranco Contact
 */

define([
    'mage/storage',
    'Barranco_Contact/js/model/full-screen-loader'
], function (storage, fullScreenLoader) {
    'use strict';

    return function (serviceUrl, payload) {
        fullScreenLoader.startLoader();

        return storage.post(
            serviceUrl, JSON.stringify(payload), true, 'application/json', {}
        ).done(
            // TODO: reset values
        ).fail(
            // TODO: set error message
        ).always(
            function () {
                fullScreenLoader.stopLoader();
            }
        );
    }
});
