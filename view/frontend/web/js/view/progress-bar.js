/**
 * Barranco Contact
 */

define([
    'ko',
    'uiComponent',
    'Barranco_Contact/js/model/step-navigator'
], function (ko, Component, stepNavigator) {
    'use strict';

    let steps = stepNavigator.steps;

    return Component.extend({
        defaults: {
            template: 'Barranco_Contact/progress-bar'
        },
        steps: steps,

        initialize: function () {
            this._super();
        },

        /**
         * @param left
         * @param right
         * @returns {*|Number}
         */
        sortItems: function (left, right) {
            return stepNavigator.sortItems(left, right);
        }
    });
});
