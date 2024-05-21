/**
 * Barranco Contact
 */

define([
    'ko',
    'jquery',
    'Magento_Ui/js/form/form',
    'Barranco_Contact/js/action/submit-contact-form',
    'Barranco_Contact/js/model/step-navigator',
    'uiRegistry',
    'mage/translate'
], function (ko, $, Component, submitContactFormAction, stepNavigator, registry, $t) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'Barranco_Contact/info',
            formTemplate: 'Barranco_Contact/form/info'
        },
        visible: ko.observable(false),

        initialize: function () {
            this._super();

            stepNavigator.registerStep(
                'info',
                $t('Contact Info'),
                this.visible,
                this.sortOrder
            );
        },

        submitContactForm: function (data, event) {
            let contactInfoFormData;

            event.preventDefault();

            if (this.validateContactInformation()) {
                this.getSubmitContactFormDeferredObject();

                return true;
            }

            return false;
        },

        validateContactInformation: function () {
            this.source.set('params.invalid', false);
            this.source.trigger('contactInfoForm.data.validate');

            if (this.source.get('params.invalid')) {
                this.focusInvalid();
                return false;
            }

            return true;
        },

        getData: function () {
            return this.source.get('contactInfoForm');
        },

        /**
         * @return {*}
         */
        getSubmitContactFormDeferredObject: function () {
            $.when(
                submitContactFormAction(this.getData())
            );
        }
    });
});
