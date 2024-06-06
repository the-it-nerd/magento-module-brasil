define([
    'jquery',
    'jquery/ui',
    'TheITNerd_Core/js/inputMask',
    'mage/translate'
], function($) {
    'use strict';

    $.widget('theitnerd.cpfCnpjField', {
        options: {
            cnpj: true,
            cpf: true,
            masks: {
                cpf: '000.000.000-00',
                cnpj: '00.000.000/0000-00'
            },
            parent:  'div.field',
            label: 'label.label > span'
        },

        _create: function() {
            this.initOptions()
                .createCnpjCheckbox()
                .changeField();
        },

        initOptions: function() {

            this.options.uniqueID = Math.random().toString(36).substring(2, 9);
            this.options.parentElement = this.element.closest(this.options.parent);
            this.options.labelElement = this.options.parentElement.find(this.options.label);

            return this;
        },

        createCnpjCheckbox: function() {

            if (!this.options.cpf || !this.options.cnpj) {
                return this;
            }

            let html = '<div class="cnpj-checkbox"><label><input type="checkbox" id="' + this.options.uniqueID + '"/> ' + $.mage.__('Usar CNPJ') + '</label></div>';
            this.options.parentElement.append(html);

            let self = this;
            $('#'+this.options.uniqueID).on('change', function() {
                self.changeField();
            });

            return this;
        },

        isCNPJ: function() {
            if (!this.options.cpf && this.options.cnpj) {
                return true
            }
            return $('#'+this.options.uniqueID).is(':checked');
        },

        changeLabel: function() {
            if(this.isCNPJ()) {
                this.options.labelElement.html($.mage.__('CNPJ'));
            } else {
                this.options.labelElement.html($.mage.__('CPF'));
            }
        },

        changeField: function() {
            if(typeof this.element.data('theitnerdInputmask') != 'undefined') {
                this.element.data('theitnerdInputmask').remove();
            }

            if(this.isCNPJ() && this.options.cnpj) {
                this.element.inputmask({mask: this.options.masks.cnpj});
                this.element.removeClass('validate-cpf');
                this.element.addClass('validate-cnpj');
            } else if (this.options.cpf) {
                this.element.inputmask({mask: this.options.masks.cpf});
                this.element.removeClass('validate-cnpj');
                this.element.addClass('validate-cpf');
            }


            this.changeLabel();
        }
    });

    return $.theitnerd.cpfCnpjField;
});
