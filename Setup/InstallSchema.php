<?php

namespace Magento360\CheckoutField\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{

   /**
    * {@inheritdoc}
    * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
    */
   public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
   {
       $installer = $setup;
       $installer->startSetup();

       $installer->getConnection()->addColumn(
           $installer->getTable('quote'),
           'input_custom_checkout_field',
           [
               'type' => 'text',
               'nullable' => false,
               'comment' => 'Custom Input Checkout Field',
           ]
       );

       $installer->getConnection()->addColumn(
           $installer->getTable('sales_order'),
           'input_custom_checkout_field',
           [
               'type' => 'text',
               'nullable' => false,
               'comment' => 'Custom Input Checkout Field',
           ]
       );

       $installer->getConnection()->addColumn(
           $installer->getTable('sales_order_grid'),
           'input_custom_checkout_field',
           [
               'type' => 'text',
               'nullable' => false,
               'comment' => 'Custom Input Checkout Field',
           ]
       );

       $setup->endSetup();
   }
}
