/**
 * Barranco Contact
 */

define([
    'ko',
    'jquery',
    'Magento_Ui/js/form/form',
    'Barranco_Contact/js/action/redirect-on-success',
    'Barranco_Contact/js/action/submit-contact-form',
    'Barranco_Contact/js/model/contact',
    'Barranco_Contact/js/model/step-navigator',
    'uiRegistry',
    'mage/translate'
], function (
    ko,
    $,
    Component,
    redirectOnSuccessAction,
    submitContactFormAction,
    contact,
    stepNavigator,
    registry,
    $t
) {
    'use strict';

    let fieldsByReason = window.contactConfig.fieldsByReason,
        labelsByIssueType = window.contactConfig.labelsByIssueType;

    return Component.extend({
        defaults: {
            template: 'Barranco_Contact/info',
            formTemplate: 'Barranco_Contact/form/info'
        },
        visible: ko.observable(false),

        initialize: function () {
            this._super();

            stepNavigator.registerStep(
                'info',
                $t('Contact Info'),
                this.visible,
                this.sortOrder
            );
        },

        /**
         * Submit contact form handler
         *
         * @param data
         * @param event
         * @return {boolean}
         */
        submitContactForm: function (data, event) {
            event.preventDefault();

            if (this.validateContactInformation()) {
                this.getSubmitContactFormDeferredObject()
                    .done(
                        function () {
                            redirectOnSuccessAction.execute();
                        }
                    );

                return true;
            }

            return false;
        },

        /**
         * @return {boolean}
         */
        validateContactInformation: function () {
            this.source.set('params.invalid', false);
            this.source.trigger('contactInfoForm.data.validate');

            if (this.source.get('params.invalid')) {
                this.focusInvalid();
                return false;
            }

            return true;
        },

        /**
         * Get contact form data
         *
         * @return {*}
         */
        getData: function () {
            let data = this.source.get('contactInfoForm'),
                reason = contact.reason(),
                reasonFields = fieldsByReason[reason],
                contactReasonForm = contact.reasonForm(),
                filtered = Object.fromEntries(Object.entries(contactReasonForm)
                    .filter(
                        ([key, value]) => value !== "" && value !== undefined
                    )
                ),
                categoryReasonComment = `Category: ${reason}`,
                reasonFieldsComment = Object.entries(filtered)
                    .map(([key, value]) => {
                        const label = reasonFields[key] || key;

                        if (key.includes('_issue_type')) {
                            value = labelsByIssueType[value] || value;
                        }

                        return `<li>${label}: ${value}</li>`
                    }).join("");

            data.comment = `
                <ul>
                    <li>${categoryReasonComment}</li>
                    ${reasonFieldsComment}
                </ul>
                <p>${data.comment}</p>
            `;

            return data;
        },

        /**
         * @return {*}
         */
        getSubmitContactFormDeferredObject: function () {
            return $.when(
                submitContactFormAction(this.getData())
            );
        }
    });
});
