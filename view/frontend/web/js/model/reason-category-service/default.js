/**
 * Barranco Contact
 */

define([
    'Barranco_Contact/js/model/reason-service'
], function (reasonService) {
    'use strict';

    return {

        /**
         * Get reason data for specific category
         *
         * @param  {String} category
         */
        getReason: function (category) {
            reasonService.isLoading(true);
            reasonService.reason(false);

            if (category !== undefined) {
                reasonService.reason(category);
            }

            setTimeout(function () {
                reasonService.isLoading(false);
            }, 2000);
        }
    }
});
