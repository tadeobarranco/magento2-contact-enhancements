/**
 * Barranco Contact
 */

define([
    'mage/url',
    'Barranco_Contact/js/model/full-screen-loader'
], function (url, fullScreenLoader) {
    'use strict';

    return {
        redirectUrl: window.contactConfig.defaultSuccessPageUrl,

        /**
         * Execute action
         */
        execute: function () {
            fullScreenLoader.startLoader();
            this.redirectToSuccessPage();
        },

        /**
         * Redirect to success page
         */
        redirectToSuccessPage: function () {
            window.location.replace(url.build(this.redirectUrl))
        }
    }
})
