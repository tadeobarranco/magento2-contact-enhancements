/**
 * Barranco Contact
 */

define([
    'ko',
    'domReady!'
], function (ko) {
    'use strict';

    let reason = ko.observable(null);

    return {
        reason: reason
    }
});
