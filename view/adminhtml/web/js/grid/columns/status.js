/**
 * Barranco\Contact
 */

define([
    'underscore',
    'Magento_Ui/js/grid/columns/select'
], function (_, Column) {
    'use strict';

    return Column.extend({
        defaults: {
            bodyTmpl: 'Barranco_Contact/grid/cells/status'
        },

        getStatusColor: function (row) {
            return 'status-component ' + row.status;
        }
    })
});
