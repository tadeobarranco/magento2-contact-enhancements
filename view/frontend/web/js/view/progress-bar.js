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
    let progressBarWidth = stepNavigator.progressBarWidth;

    return Component.extend({
        defaults: {
            template: 'Barranco_Contact/progress-bar'
        },
        steps: steps,
        progressBarWidth: progressBarWidth,

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
        },

        /**
         * @param {Object} step
         * @returns {Boolean}
         */
        isProcessed: function (step) {
            return stepNavigator.isProcessed(step.code);
        },

        /**
         * @param {Object} step
         */
        navigateTo: function (step) {
            stepNavigator.navigateTo(step);
        }
    });
});
