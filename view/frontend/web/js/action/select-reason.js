/**
 * Barranco Contact
 */

define([
    'Barranco_Contact/js/model/contact'
], function (contact) {
    'use strict';

    return function (reason) {
        contact.reason(reason);
    }
})
