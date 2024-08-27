/**
 * Barranco Contact
 */

define([
    'jquery',
    'ko',
    'uiRegistry',
    'Barranco_Contact/js/action/select-reason'
], function ($, ko, registry, selectReason) {
    'use strict';

    return {

        /**
         * Init form fields binding
         *
         * @param {String} formPath
         */
        initFields: function (formPath) {
            let self = this,
                fields = this.getObservableFields();

            $.each(fields, function (index, field) {
               registry.async(formPath + '.' + field)(self.doElementBinding.bind(self));
            });
        },

        /**
         * Bind action to form element
         *
         * @param {Object} field
         */
        doElementBinding: function (field) {
            let fields = this.getObservableFields();

            if (field && fields.indexOf(field.index) !== -1) {
                this.bindHandler(field);
            }
        },

        /**
         * @param {Object} field
         */
        bindHandler: function (field) {
            field.on('value', function () {
                selectReason(field.value());
            });
        },

        /**
         * @return {Array}
         */
        getObservableFields: function () {
            return [
              'category'
            ];
        }
    }
});
