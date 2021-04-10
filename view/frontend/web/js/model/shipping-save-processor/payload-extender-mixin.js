define([
    'jquery',
    'mage/utils/wrapper'
], function ($, wrapper) {
    'use strict';

    return function (payloadExtender) {
        return wrapper.wrap(payloadExtender, function (originalAction, payload) {
            payload = originalAction(payload);
            payload.addressInformation.extension_attributes.input_custom_checkout_field = jQuery('[name="custom_shipping_field[input_custom_checkout_field]').val();
            return payload;
        });
    };
})
