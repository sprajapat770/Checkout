<?php


namespace Magento360\ExtraCheckoutStep\Plugin;

use Magento\Framework\View\Element\UiComponent\DataProvider\CollectionFactory;

class JoinCompanyName
{
    public function afterGetReport(
        CollectionFactory $subject,
        $collection,
        $requestName
    ) {
        if ($requestName == 'sales_order_grid_data_source') {
            $select = $collection->getSelect();
            $select->joinLeft(
                ['customer_address' => $collection->getTable('sales_order_address')],
                'main_table.entity_id = customer_address.parent_id and address_type="billing"',
                ['company']
            );
        }
        return $collection;
    }
}
