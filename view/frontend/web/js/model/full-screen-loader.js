/**
 * Barranco Contact
 */

define([
    'jquery',
    'rjsResolver'
], function ($, resolver) {
    'use strict';

    let containerId = '#contact';

    return {

        /**
         * Start full page loader action
         */
        startLoader: function () {
            $(containerId).trigger('processStart');
        },

        /**
         * Stop full page loader action
         *
         * @param {Boolean} forceStop
         */
        stopLoader: function (forceStop) {
            let $elem = $(containerId),
                stop = $elem.trigger.bind($elem, 'processStop');

            forceStop ? stop() : resolver(stop);
        }
    }
});
