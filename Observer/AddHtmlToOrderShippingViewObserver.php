<?php


namespace Magento360\CheckoutField\Observer;

use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;

class AddHtmlToOrderShippingViewObserver implements ObserverInterface
{

    /**
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_objectManager;

    /**
     * @param \Magento\Framework\ObjectManagerInterface $objectmanager
     */
    public function __construct(\Magento\Framework\ObjectManagerInterface $objectmanager)
    {
        $this->_objectManager = $objectmanager;
    }

    public function execute(EventObserver $observer)
    {
        if($observer->getElementName() == 'order_shipping_view')
        {
            $orderShippingViewBlock = $observer->getLayout()->getBlock($observer->getElementName());
            $order = $orderShippingViewBlock->getOrder();
            $customInputField = $order->getInputCustomCheckoutField();
            $customBlock = $this->_objectManager->create('Magento\Framework\View\Element\Template');
            $customBlock->setInputCustomCheckoutField($customInputField);
            $customBlock->setTemplate('Magento360_CheckoutField::order_info_shipping_info.phtml');
            $html = $observer->getTransport()->getOutput() . $customBlock->toHtml();
            $observer->getTransport()->setOutput($html);
        }
    }
}
