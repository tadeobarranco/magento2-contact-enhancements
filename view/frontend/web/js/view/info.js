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
        defaults: {
            template: 'Barranco_Contact/info'
        },
        visible: ko.observable(false),

        initialize: function () {
            this._super();

            stepNavigator.registerStep(
                'info',
                $t('Contact Info'),
                this.visible,
                this.sortOrder
            )
        }
    });
});
