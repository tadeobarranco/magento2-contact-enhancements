/**
 * Barranco Contact
 */

define([
    'jquery',
    'ko',
    'uiComponent',
    'uiRegistry',
    'Magento_Customer/js/customer-data',
    'Magento_Ui/js/model/messageList',
    'Barranco_Contact/js/model/reason-service',
    'Barranco_Contact/js/model/reason-validator',
    'Barranco_Contact/js/model/step-navigator',
    'mage/translate'
], function (
    $,
    ko,
    Component,
    registry,
    customerData,
    messageList,
    reasonService,
    reasonValidator,
    stepNavigator,
    $t
) {
    'use strict';

    let containerId = '#contact';

    return Component.extend({
        defaults: {
            template: 'Barranco_Contact/reason',
            formTemplate: 'Barranco_Contact/form/reason'
        },
        visible: ko.observable(true),
        reason: reasonService.reason,
        isLoading: reasonService.isLoading,

        initialize: function () {
            let self = this,
                formPath = 'contact.steps.reason-step.contact-reason-fieldset';
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

            reasonService.isLoading(true);

            setTimeout(function () {
                reasonService.isLoading(false);
            }, 2000);

            /**
             * @todo Observe on reason form changes
             */
            registry.async('contactProvider')(function (contactProvider) {
                reasonValidator.initFields(formPath);
            })
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
