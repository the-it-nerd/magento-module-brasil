define([
    'jquery',
    'TheITNerd_Brasil/js/lib/postcode',
    'TheITNerd_Brasil/js/model/postcode',
    'Magento_Ui/js/modal/alert',
    'Magento_Ui/js/modal/modal',
    'jquery/ui',
    'TheITNerd_Core/js/inputMask',
    'mage/translate',
    'loader'
], function($, postcodeClient, postcodeModel, alert, modal) {
    'use strict';

    $.widget('theitnerd.postcode', {
        options: {
            mask: '00000-000',
            parent: '.field',
            form: 'form',
            addressFields: {
                street: '[name="street[0]"]',
                neighborhood: '[name="street[3]"]',
                city: '[name="city"]',
                region_id: '[name="region_id"]',
                region: '[name="region"]',
                country: '[name="country_id"]'
            }
        },

        _create: function() {
            this.initOptions()
                .initMask()
                .createPostcodeSearchLink()
                .bindEvents();
        },

        bindEvents: function() {
            postcodeModel.postcode.subscribe($.proxy(function(postcode){
                this.element.val(postcode).trigger('blur');
                $('#'+this.options.modalID).modal('closeModal');
            }, this));

            this.options.formElementWrapper.loader();

            let self = this;
            $(this.element).on('blur', function() {
                let value = $(this).val();
                if(value.length === self.options.mask.length) {

                    self.options.formElementWrapper.loader('show');

                    postcodeClient.searchAddress(value,
                        function(value) {
                            self.options.formElementWrapper.loader('hide');
                            if(value.hasOwnProperty(0)) {
                                value = value[0];
                                self.options.countryElement.val(value.country).trigger('change');
                                self.options.streetElement.val(value.street).trigger('change');
                                self.options.neighborhoodElement.val(value.neighborhood).trigger('change');
                                self.options.cityElement.val(value.city).trigger('change');
                                self.options.regionIdElement.val(value.region_id).trigger('change');
                            } else {
                                alert({
                                    title: $.mage.__('Error'),
                                    content: $.mage.__('Postcode is invalid, please check your data an try again'),
                                    modalClass: 'alert alert-error'
                                });
                            }
                        },
                        function(value) {
                            self.options.formElementWrapper.loader('hide');
                            alert({
                                title: $.mage.__('Error'),
                                content: $.mage.__('Postcode is invalid, please check your data an try again'),
                                modalClass: 'alert alert-error'
                            });
                        }
                    );
                }
            });
        },

        /**
         * Implements Mask on field
         * @returns {theitnerd.postcode}
         */
        initMask: function() {
            this.element.inputmask({mask: this.options.mask});

            return this;
        },

        /**
         * Initializee main widget options
         * @returns {theitnerd.postcode}
         */
        initOptions: function() {
            this.options.uniqueID = Math.random().toString(36).substring(2, 9);
            this.options.modalID = this.options.uniqueID+'-modal';
            this.options.parentElement = this.element.closest(this.options.parent);
            this.options.formElement = this.element.closest(this.options.form);
            this.options.formElementWrapper = this.options.formElement.parent();
            this.options.streetElement = this.options.formElement.find(this.options.addressFields.street);
            this.options.neighborhoodElement = this.options.formElement.find(this.options.addressFields.neighborhood);
            this.options.cityElement = this.options.formElement.find(this.options.addressFields.city);
            this.options.regionIdElement = this.options.formElement.find(this.options.addressFields.region_id);
            this.options.regionElement = this.options.formElement.find(this.options.addressFields.region);
            this.options.countryElement = this.options.formElement.find(this.options.addressFields.country);


            if(!this.options.hasOwnProperty('regionJson')) {
                this.options.regionJson = window.regionJson;
            }

            return this;
        },

        /**
         * Creates psotcode search link and modal
         * @returns {theitnerd.postcode}
         */
        createPostcodeSearchLink: function() {
            let linkHTML = '<div class="search-postcode"><a href="javascript:void(0)" id="' + this.options.uniqueID + '"> ' + $.mage.__('I dont know my postcode') + '</a></div>';
            this.options.parentElement.append(linkHTML);

            let modalHTML = '<div style="display:none" id="' + this.options.modalID + '">';
            modalHTML += '<div class="content">';
            modalHTML += '<div data-bind="scope: \'postcodeSearch\'">';
            modalHTML += '    <!-- ko template: getTemplate() --><!-- /ko -->';
            modalHTML += '</div>';
            modalHTML += '<script type="text/x-magento-init">';
            modalHTML += '{';
            modalHTML += '    "*" : {';
            modalHTML += '        "Magento_Ui/js/core/app" : {';
            modalHTML += '            "components" : {';
            modalHTML += '                "postcodeSearch" : {';
            modalHTML += '                    "component": "TheITNerd_Brasil/js/view/postcodeSearch",';
            modalHTML += '                    "template" : "TheITNerd_Brasil/postcode-search/postcodeSearch",';
            modalHTML += '                    "regionJson" : ' + JSON.stringify(this.options.regionJson);
            modalHTML += '                }';
            modalHTML += '            }';
            modalHTML += '        }';
            modalHTML += '    }';
            modalHTML += '}';
            modalHTML += '</script>';
            modalHTML += '</div>';
            $('body').append(modalHTML);
            let modalEl = $('#' + this.options.modalID);
            modalEl.trigger("contentUpdated");
            modalEl.applyBindings();

            let modalOptions = {
                type: 'popup',
                responsive: true,
                title: $.mage.__('Search you postcode here'),
                buttons: []
            };

            modal(modalOptions, modalEl);

            $('#'+this.options.uniqueID).on('click', $.proxy(function() {
                $('#' + this.options.modalID).modal('openModal');
            }, this));

            return this;
        }
    });

    return $.theitnerd.postcode;
});
