/**
 * Barranco Contact
 */

define([
    'ko',
    'Barranco_Contact/js/model/url-builder',
    'Barranco_Contact/js/model/submit-contact-form'
], function (ko, urlBuilder, submitContactFormService) {
    'use strict';

    return function (contactFormData) {
        let serviceUrl = urlBuilder.createUrl('/contact/us/submit-form', {}),
            payload = {
                formData: contactFormData
            };

        return submitContactFormService(serviceUrl, payload);
    }
});
