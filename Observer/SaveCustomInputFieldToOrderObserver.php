<?php


namespace Magento360\CheckoutField\Observer;


use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;

class SaveCustomInputFieldToOrderObserver implements ObserverInterface
{
    public function execute(EventObserver $observer)
    {
        $order = $observer->getEvent()->getOrder();
        $quote = $observer->getEvent()->getQuote();
        $order->setInputCustomCheckoutField($quote->getInputCustomCheckoutField());

        return $this;
    }
}
