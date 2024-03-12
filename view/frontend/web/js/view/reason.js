/**
 * Barranco Contact
 */

define([
    'jquery',
    'ko',
    'uiComponent',
    'Barranco_Contact/js/model/step-navigator',
    'mage/translate'
], function ($, ko, Component, stepNavigator, $t) {
    'use strict';

    let containerId = '#contact';

    return Component.extend({
        defaults: {
            template: 'Barranco_Contact/reason'
        },
        visible: ko.observable(true),

        initialize: function () {
            this._super();

            stepNavigator.registerStep(
              'reason',
                $t('Contact Reason'),
                this.visible,
                this.sortOrder
            );
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
