<?php

    class Itransition_Insurance_Block_Total_SalesOrderInvoice extends Mage_Sales_Block_Order_Invoice_Totals
{
    protected $_code = 'insurance';

    protected function _initTotals()
    {
        parent::_initTotals();
        $order = $this->getOrder();
        $amount = $order->getInsurance();
        $insuranceLabel = Mage::getStoreConfig('insurance_options/customins/insurance_label');

        $this->addTotalBefore(
            new Varien_Object(
                [
                    'code' => $this->getCode(),
                    'value' => $amount,
                    'base_value' => $amount,
                    'label' => $this->helper('insurance')->__($insuranceLabel)
                ],
                'grand_total'
            )
        );

        return $this;
    }
}