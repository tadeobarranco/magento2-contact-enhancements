/**
 * Barranco Contact
 */

define([
    'jquery',
    'ko',
    'uiComponent',
    'Magento_Customer/js/customer-data',
    'Magento_Ui/js/model/messageList',
    'Barranco_Contact/js/model/step-navigator',
    'mage/translate'
], function ($, ko, Component, customerData, messageList, stepNavigator, $t) {
    'use strict';

    let containerId = '#contact';

    return Component.extend({
        defaults: {
            template: 'Barranco_Contact/reason',
            formTemplate: 'Barranco_Contact/form/reason'
        },
        visible: ko.observable(true),
        reason: ko.observable(false),

        initialize: function () {
            this._super();

            stepNavigator.registerStep(
              'reason',
                $t('Contact Reason'),
                this.visible,
                this.sortOrder
            );

            let successMessageData = customerData.get('success-message');

            if (successMessageData && successMessageData().message) {
                messageList.addSuccessMessage({
                    message: successMessageData().message
                });

                customerData.set('success-message', {});
            }
        },

        /**
         * Set contact reason information
         */
        setReasonInformation: function () {
            $(containerId).trigger('processStart');

            setTimeout(function () {
                stepNavigator.next();
                $(containerId).trigger('processStop');
            }, 2000);
        }
    });
});
