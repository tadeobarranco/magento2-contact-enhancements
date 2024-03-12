/**
 * Barranco Contact
 */

define([
    'rjsResolver'
], function (resolver) {

    /**
     * Removes provided loader element from DOM.
     *
     * @param {HTMLElement} $loader
     */
    function hideLoader($loader) {
        $loader.parentNode.removeChild($loader);
    }

    /**
     * Initializes assets loading process listener.
     *
     * @param {Object} config
     * @param {HTMLElement} $loader
     */
    function init(config, $loader) {
        resolver(hideLoader.bind(config, $loader));
    }

    return init;
});
