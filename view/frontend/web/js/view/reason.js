/**
 * Barranco Contact
 */

define([
    'ko',
    'uiComponent',
    'Barranco_Contact/js/model/step-navigator',
    'mage/translate'
], function (ko, Component, stepNavigator, $t) {
    'use strict';

    return Component.extend({
        visible: ko.observable(true),

        initialize: function () {
            this._super();

            stepNavigator.registerStep(
              'reason',
                $t('Contact Reason'),
                this.visible,
                this.sortOrder
            );
        }
    });
});