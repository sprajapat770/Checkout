<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento360\CheckoutField\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UninstallInterface;

/**
 * @codeCoverageIgnore
 */
class Uninstall implements UninstallInterface
{
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function uninstall(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $setup->getConnection()->dropColumn(
            $setup->getTable('quote'),
            'input_custom_checkout_field'
        );
        $setup->getConnection()->dropColumn(
            $setup->getTable('sales_order'),
            'input_custom_checkout_field'
        );
        $setup->getConnection()->dropColumn(
            $setup->getTable('sales_order_grid'),
            'input_custom_checkout_field'
        );

        $setup->endSetup();
    }

}
