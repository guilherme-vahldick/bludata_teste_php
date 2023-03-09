/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

var SPMaskBehavior = function (val) {
        return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
    },
    spOptions = {
        onKeyPress: function(val, e, field, options) {
            field.mask(SPMaskBehavior.apply({}, arguments), options);
        }
    };

$(function(){
    // Mascaras de Campo
    $('.mask-phone').mask(SPMaskBehavior, spOptions);
    $('.mask-cnpj').mask('00.000.000/0000-00', {reverse: true});
    $('.mask-cpf').mask('000.000.000-00', {reverse: true});
    $('.mask-date').mask('00/00/0000');
})
