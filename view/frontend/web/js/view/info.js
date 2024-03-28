/**
 * Barranco Contact
 */

define([
    'ko',
    'Magento_Ui/js/form/form',
    'Barranco_Contact/js/model/step-navigator',
    'uiRegistry',
    'mage/translate'
], function (ko, Component, stepNavigator, registry, $t) {
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

        submitContactForm: function () {
            this.source.set('params.invalid', false);
            this.source.trigger('contactInfoForm.data.validate');
        }
    });
});
