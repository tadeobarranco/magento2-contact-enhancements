/**
 * Barranco Contact
 */

define([
    'Magento_Ui/js/model/messageList',
    'mage/translate'
], function (globalMessageList, $t) {
    'use strict';

    return {

        /**
         * @param {Object} response
         */
        process: function (response) {
            let error;

            try {
                error = JSON.parse(response.responseText);
            } catch (exception) {
                error = {
                    message: $t('Something went wrong with your request. Please try again later.')
                }
            }

            globalMessageList.addErrorMessage(error);
        }
    }
});
