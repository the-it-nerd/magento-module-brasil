define([
    'uiComponent',
    'TheITNerd_Brasil/js/lib/postcode',
    'TheITNerd_Brasil/js/model/postcode',
    'ko',
    'jquery',
    'loader'
], function(Component, postcodeClient, postcodeModel, ko, $) {
    'use strict';

    return Component.extend({
        model: postcodeModel,
        formValues: {
            region: null,
            city: null,
            street: null
        },
        postcodeOptions: ko.observable([]),
        hasSearch: ko.observable(false),

        initialize: function () {
            this._super();
            this.usePostcode.bind(this);
            this.searchPostcodes.bind(this);
        },

        searchPostcodes: function() {
            let loader = $('.postcodeSearch--wrapper');
            loader.loader();
            loader.loader('show');
            postcodeClient.searchPostcode(this.formValues.region, this.formValues.city, this.formValues.street,
                $.proxy(function(data){
                    this.hasSearch(true);
                    if(data.hasOwnProperty(0)) {
                        this.postcodeOptions(data[0]);
                    }
                    loader.loader('hide');
                }, this),
                $.proxy(function(data) {
                    this.hasSearch(true);
                    loader.loader('hide');
                }, this)
            );
        },

        usePostcode: function(data) {
            this.model.postcode(data.postcode);
        },

        /**
         * Validates if we can show the error message
         * @returns {false}
         */
        showNotFoundMessage: function() {
            return  this.postcodeOptions().length === 0 && this.hasSearch();
        }
    })
})
