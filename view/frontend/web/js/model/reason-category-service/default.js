/**
 * Barranco Contact
 */

define([
    'Barranco_Contact/js/model/error-processor',
    'Barranco_Contact/js/model/reason-service',
    'Barranco_Contact/js/model/url-builder',
    'mage/storage'
], function (errorProcessor, reasonService, urlBuilder, storage) {
    'use strict';

    return {

        /**
         * Get reason data for specific category
         *
         * @param  {String} category
         */
        getReason: function (category) {
            let serviceUrl = urlBuilder.createUrl('/contact/us/reason-information/:category', {
                category: category
            });

            reasonService.isLoading(true);
            reasonService.reason(false);

            if (category !== undefined) {
                return storage.get(
                    serviceUrl, false
                ).done(
                    function (response) {
                        reasonService.reason(response.reason);
                    }
                ).fail(
                    function (response) {
                        errorProcessor.process(response)
                    }
                ).always(
                    function () {
                        reasonService.isLoading(false);
                    }
                );
            } else {
                setTimeout(function () {
                    reasonService.isLoading(false);
                }, 2000);
            }
        }
    }
});
