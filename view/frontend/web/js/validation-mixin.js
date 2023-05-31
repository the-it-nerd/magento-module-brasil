define([
        'jquery'
], function($) {
    'user strict';

    return function() {
        let brValidator = {
            validCpf: function(cpf) {
                cpf = cpf.replace(/\D/g,'');

                if ( !cpf || cpf.length !== 11
                    || cpf === "00000000000"
                    || cpf === "11111111111"
                    || cpf === "22222222222"
                    || cpf === "33333333333"
                    || cpf === "44444444444"
                    || cpf === "55555555555"
                    || cpf === "66666666666"
                    || cpf === "77777777777"
                    || cpf === "88888888888"
                    || cpf === "99999999999" )
                    return false
                let soma = 0
                let resto
                for (let i = 1; i <= 9; i++)
                    soma = soma + parseInt(cpf.substring(i-1, i)) * (11 - i)
                resto = (soma * 10) % 11
                if ((resto == 10) || (resto == 11))  resto = 0
                if (resto != parseInt(cpf.substring(9, 10)) ) return false
                soma = 0
                for (let i = 1; i <= 10; i++)
                    soma = soma + parseInt(cpf.substring(i-1, i)) * (12 - i)
                resto = (soma * 10) % 11
                if ((resto == 10) || (resto == 11))  resto = 0
                if (resto != parseInt(cpf.substring(10, 11) ) ) return false
                return true
            },
            validCnpj: function(cnpj) {
                cnpj = cnpj.replace(/\D/g,'');

                if ( !cnpj || cnpj.length != 14
                    || cnpj == "00000000000000"
                    || cnpj == "11111111111111"
                    || cnpj == "22222222222222"
                    || cnpj == "33333333333333"
                    || cnpj == "44444444444444"
                    || cnpj == "55555555555555"
                    || cnpj == "66666666666666"
                    || cnpj == "77777777777777"
                    || cnpj == "88888888888888"
                    || cnpj == "99999999999999")
                    return false
                let tamanho = cnpj.length - 2
                let numeros = cnpj.substring(0,tamanho)
                let digitos = cnpj.substring(tamanho)
                let soma = 0
                let pos = tamanho - 7
                for (let i = tamanho; i >= 1; i--) {
                    soma += numeros.charAt(tamanho - i) * pos--
                    if (pos < 2) pos = 9
                }
                let resultado = soma % 11 < 2 ? 0 : 11 - soma % 11
                if (resultado != digitos.charAt(0)) return false;
                tamanho = tamanho + 1
                numeros = cnpj.substring(0,tamanho)
                soma = 0
                pos = tamanho - 7
                for (let i = tamanho; i >= 1; i--) {
                    soma += numeros.charAt(tamanho - i) * pos--
                    if (pos < 2) pos = 9
                }
                resultado = soma % 11 < 2 ? 0 : 11 - soma % 11
                return (resultado !== digitos.charAt(1));
            }
        };

        $.validator.addMethod(
            'validate-cpf',
            function(value, element) {
                return brValidator.validCpf(value);
            },
            $.mage.__('Por favor insira um CPF válido')
        );

        $.validator.addMethod(
            'validate-cnpj',
            function(value, element) {
                return brValidator.validCnpj(value);
            },
            $.mage.__('Por favor insira um CNPJ válido')
        );

        $.validator.addMethod(
            'validate-cpf-cnpj',
            function(value, element) {
                return brValidator.validCnpj(value) || brValidator.validCpf(value);
            },
            $.mage.__('Por favor insira um CPF ou CNPJ válidos')
        );

        $.validator.addMethod(
            'validate-cep',
            function(value, element) {
                let regex = new RegExp('[0-9]{5}[-]?[0-9]{3}');
                return regex.test(value);
            },
            $.mage.__('Por favor insira um CEP válido')
        );

        $.validator.addMethod(
            'validate-brazilian-phone',
            function(value, element) {
                let regex = new RegExp('[(]?[0-9]{2}[)]?[ ]?[0-9]{4,5}[-]?[0-9]{4,5}');
                return regex.test(value);
            },
            $.mage.__('Por favor insira um telefone válido')
        );
    }
});
