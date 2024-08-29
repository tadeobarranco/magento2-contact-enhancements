/**
 * Barranco Contact
 */

define([
    'Barranco_Contact/js/model/contact',
    'Barranco_Contact/js/model/reason-category-service/default'
], function (contact, defaultProcessor) {
    'use strict';

    let processors = {};

    processors.default = defaultProcessor;

    contact.reason.subscribe(function () {
        let category = contact.reason();

        processors.default.getReason(category);
    });
});
