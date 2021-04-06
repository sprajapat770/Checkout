var config = {
    'config': {
        'mixins': {
            'Magento_Checkout/js/view/shipping': {
                'Magento360_ExtraCheckoutStep/js/view/shipping-payment-mixin': true
            },
            'Magento_Checkout/js/view/payment': {
                'Magento360_ExtraCheckoutStep/js/view/shipping-payment-mixin': true
            }
        }
    }
}
