/*
* *
*  @author DCKAP Team
*  @copyright Copyright (c) 2018 DCKAP (https://www.dckap.com)
*  @package Dckap_CustomFields
*/
define(
   [
       'ko',
       'Magento_Checkout/js/model/quote',
       'Magento_Checkout/js/model/resource-url-manager',
       'mage/storage',
       'Magento_Checkout/js/model/payment-service',
       'Magento_Checkout/js/model/payment/method-converter',
       'Magento_Checkout/js/model/error-processor',
       'Magento_Checkout/js/model/full-screen-loader',
       'Magento_Checkout/js/action/select-billing-address'
   ],
   function (
       ko,
       quote,
       resourceUrlManager,
       storage,
       paymentService,
       methodConverter,
       errorProcessor,
       fullScreenLoader,
       selectBillingAddressAction
   ) {
       'use strict';

       return {
           saveShippingInformation: function () {
               var payload;

               var shippingMethod = quote.shippingMethod().method_code+'_'+quote.shippingMethod().carrier_code;

               var select_instore_location = null;

               if(shippingMethod == "storepickup_storepickup") {
                   select_instore_location = jQuery('div.select-store-pickpup select').val();
               }

               if (!quote.billingAddress()) {
                   selectBillingAddressAction(quote.shippingAddress());
               }

               payload = {
                   addressInformation: {
                       shipping_address: quote.shippingAddress(),
                       billing_address: quote.billingAddress(),
                       shipping_method_code: quote.shippingMethod().method_code,
                       shipping_carrier_code: quote.shippingMethod().carrier_code,
                       extension_attributes: {
                           select_instore_location: select_instore_location
                       }
                   }
               };
               fullScreenLoader.startLoader();

               return storage.post(
                   resourceUrlManager.getUrlForSetShippingInformation(quote),
                   JSON.stringify(payload)
               ).done(
                   function (response) {
                       quote.setTotals(response.totals);
                       paymentService.setPaymentMethods(methodConverter(response.payment_methods));
                       fullScreenLoader.stopLoader();
                   }
               ).fail(
                   function (response) {
                       errorProcessor.process(response);
                       fullScreenLoader.stopLoader();
                   }
               );
           }
       };
   }
);
