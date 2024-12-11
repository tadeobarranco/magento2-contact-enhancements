/**
 * Barranco Contact
 */

define([
    'jquery',
    'ko',
    'Magento_Ui/js/form/form',
    'uiRegistry',
    'Magento_Customer/js/customer-data',
    'Magento_Ui/js/model/messageList',
    'Barranco_Contact/js/model/contact',
    'Barranco_Contact/js/model/reason-service',
    'Barranco_Contact/js/model/reason-validator',
    'Barranco_Contact/js/model/step-navigator',
    'mage/translate',
    'Barranco_Contact/js/model/reason-category-service'
], function (
    $,
    ko,
    Component,
    registry,
    customerData,
    messageList,
    contact,
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
            formTemplate: 'Barranco_Contact/form/reason',
            formFieldsTemplate: 'Barranco_Contact/form/reason/fields'
        },
        visible: ko.observable(true),
        reason: reasonService.reason,
        isLoading: reasonService.isLoading,

        initialize: function () {
            let self = this,
                formPath = 'contact.steps.reason-step.contact-reason-fieldset',
                fieldsPath = 'contact.steps.reason-step.reason-form-fields';
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

            contact.reason.subscribe(function (reason) {
                reasonValidator.updateFields(reason, fieldsPath);
            });

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
            if(this.validateReasonInformation()) {
                stepNavigator.next();
            }
        },

        /**
         * @return {Boolean}
         */
        validateReasonInformation: function () {
            this.source.set('params.invalid', false);
            this.source.trigger('contactReasonForm.data.validate');

            if (this.source.get('params.invalid')) {
                this.focusInvalid();
                return false;
            }

            return true;
        }
    });
});
