/**
 * Barranco Contact
 */

define([
    'jquery'
], function ($) {
    'use strict';

    $.widget('contact.search', $.mage.quickSearch, {
        _onPropertyChange: function () {
            this._super();
        }
    });

    return $.contact.search;
})
