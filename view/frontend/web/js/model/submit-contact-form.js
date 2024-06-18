/**
 * Barranco Contact
 */

define([
    'mage/storage',
    'Barranco_Contact/js/model/full-screen-loader',
    'Barranco_Contact/js/model/error-processor'
], function (storage, fullScreenLoader, errorProcessor) {
    'use strict';

    return function (serviceUrl, payload) {
        fullScreenLoader.startLoader();

        return storage.post(
            serviceUrl, JSON.stringify(payload), true, 'application/json', {}
        ).done(
            // TODO: reset values
        ).fail(
            function (response) {
                errorProcessor.process(response);
            }
        ).always(
            function () {
                fullScreenLoader.stopLoader();
            }
        );
    }
});
