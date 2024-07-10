/**
 * Barranco Contact
 */

define([
    'mage/storage',
    'Magento_Customer/js/customer-data',
    'Barranco_Contact/js/model/full-screen-loader',
    'Barranco_Contact/js/model/error-processor'
], function (storage, customerData, fullScreenLoader, errorProcessor) {
    'use strict';

    return function (serviceUrl, payload) {
        fullScreenLoader.startLoader();

        return storage.post(
            serviceUrl, JSON.stringify(payload), true, 'application/json', {}
        ).done(
            function (response) {
                let successMessage = {
                    'message': 'Thanks for contacting us with your comments and questions.'
                };

                customerData.set('success-message', successMessage);
            }
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
