/**
 * Barranco Contact
 */

define([
    'Barranco_Contact/js/model/contact',
    'Barranco_Contact/js/model/reason-service'
], function (contact, reasonService) {
    'use strict';

    contact.reason.subscribe(function () {
        let category = contact.reason();

        reasonService.isLoading(true);

        if (category !== undefined) {
            reasonService.reason(category);
        }

        setTimeout(function () {
            reasonService.isLoading(false);
        }, 2000);
    });
});
