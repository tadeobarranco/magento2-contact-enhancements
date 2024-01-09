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
        }
    }
});
