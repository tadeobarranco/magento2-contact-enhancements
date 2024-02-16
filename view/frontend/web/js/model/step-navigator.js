/**
 * Barranco Contact
 */

define([
    'ko'
], function (ko) {
    'use strict';

    let steps = ko.observableArray();
    let progressBarWidth = ko.observable('0%');

    return {
        steps: steps,
        currentStep: ko.observable(1),
        progressBarWidth: progressBarWidth,

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
                this.currentStep(this.currentStep() + 1);
                this.setProgressBarWidth();
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
        },

        /**
         * Set progress bar width
         */
        setProgressBarWidth: function () {
            let width = ((this.currentStep() - 1) / (steps().length - 1)) * 100;
            this.progressBarWidth(width+'%');
        },

        /**
         * @param {Object} step
         */
        navigateTo: function (step) {
            let self = this,
                sortedItems = steps().sort(this.sortItems);

            if (!this.isProcessed(step.code)) {
                return;
            }

            sortedItems.forEach(function (element) {
                if (element.code == step.code) {
                    self.currentStep(parseInt(step.sortOrder));
                    self.setProgressBarWidth();
                    element.isVisible(true);
                } else {
                    element.isVisible(false);
                }
            });
        }
    }
});
