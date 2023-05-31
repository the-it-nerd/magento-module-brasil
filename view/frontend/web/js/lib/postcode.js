define([
    'jquery',
    'mage/translate'
], function($) {
    'use strict';

    class PostcodeClient {
        constructor() {
            this.postcodeEndpoint = '/rest/V1/postcode/search';
            this.addressEndpoint = '/rest/V1/address/search';
        }

        /**
         * Search address by postcode
         *
         * @param postcode
         * @param callbackSuccess
         * @param callbackError
         */
        searchAddress(postcode, callbackSuccess, callbackError) {

            let form = new FormData();
            form.append("postcode", postcode);

            this.callApi(form, this.addressEndpoint, callbackSuccess, callbackError);
        }

        /**
         * Search postcode by address information
         *
         * @param region
         * @param city
         * @param street
         * @param callbackSuccess
         * @param callbackError
         */
        searchPostcode(region, city, street, callbackSuccess, callbackError) {
            let form = new FormData();
            form.append("region", region);
            form.append("city", city);
            form.append("street", street);

            this.callApi(form, this.postcodeEndpoint, callbackSuccess, callbackError);
        }

        /**
         * Call backend api to search for data
         *
         * @param form
         * @param endpoint
         * @param callbackSuccess
         * @param callbackError
         */
        callApi(form, endpoint, callbackSuccess, callbackError) {

            $.ajax({
                url: endpoint,
                method: "POST",
                timeout: 0,
                processData: false,
                mimeType: "multipart/form-data",
                contentType: false,
                data: form,
                success: function (response) {
                    callbackSuccess(JSON.parse(response));
                },
                error : function(response) {
                    callbackError(JSON.parse(response.responseText));
                }
            });
        }


    }

    return new PostcodeClient;
});
