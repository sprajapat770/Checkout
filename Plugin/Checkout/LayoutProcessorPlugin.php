<?php


namespace Magento360\CheckoutField\Plugin\Checkout;


class LayoutProcessorPlugin
{
    /**
     * @param \Magento\Checkout\Block\Checkout\LayoutProcessor $subject
     * @param array $jsLayout
     * @return array
     */

    public function afterProcess(
        \Magento\Checkout\Block\Checkout\LayoutProcessor $subject,
        array  $jsLayout
    ) {
        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
        ['shippingAddress']['children']['before-shipping-method-form']['children']['input_custom_checkout_field'] = [
            'component' => 'Magento_Ui/js/form/element/abstract',
            'config' => [
                'customScope' => 'customShippingMethodFields',
                'template' => 'ui/form/field',
                'elementTmpl' => "ui/form/element/input",
                'id' => "input_custom_checkout_field"
            ],
            'dataScope' => 'customShippingMethodFields.custom_shipping_field[input_custom_checkout_field]',
            'label' => 'Custom Input Checkout Field',
            'provider' => 'checkoutProvider',
            'visible' => true,
            'validation' => [],
            'sortOrder' => 200,
            'id' => 'custom_shipping_field[input_custom_checkout_field]'
        ];
        return $jsLayout;
    }
}
