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
        },

        /**
         * @returns {Number}
         */
        activeIndex: function () {
            let activeIndex = 0,
                sortedItems = steps().sort(this.sortItems);

            sortedItems.some(function (step, index) {
                if (step.isVisible()) {
                    activeIndex = index;
                    return true;
                }
                return false;
            });

            return activeIndex;
        },

        /**
         * @param {*} code
         * @returns {Boolean}
         */
        isProcessed: function (code) {
            let activeIndex = this.activeIndex(),
                requestedIndex = -1,
                sortedItems = steps().sort(this.sortItems);

            sortedItems.forEach(function (step, index) {
               if (step.code == code) {
                    requestedIndex = index;
               }
            });

            return activeIndex > requestedIndex;
        }
    }
});
