/**
 * Barranco Contact
 */

define([
    'ko'
], function (ko) {
    'use strict';

    let steps = ko.observableArray();

    return {
        steps: steps,

        /**
         * Push data to the steps array
         *
         * @param code
         * @param title
         * @param isVisible
         * @param sortOrder
         */
        registerStep: function (code, title, isVisible, sortOrder) {
            steps.push({
               code: code,
               title: title,
               isVisible: isVisible,
               sortOrder: sortOrder
            });
        },

        /**
         *
         * @param {Object} left
         * @param {Object} right
         * @returns {number}
         */
        sortItems: function (left, right) {
            return left.sortOrder > right.sortOrder ? 1 : -1;
        },

        /**
         * Next step
         */
        next: function () {
            let activeIndex;

            steps().sort(this.sortItems).forEach(function (step, index) {
                if (step.isVisible()) {
                    step.isVisible(false);
                    activeIndex = index;
                }
            });

            if (steps().length > activeIndex + 1) {
                steps()[activeIndex + 1].isVisible(true);
            }
        }
    }
});
