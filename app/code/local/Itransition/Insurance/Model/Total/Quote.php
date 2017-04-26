<?php

class Itransition_Insurance_Model_Total_Quote extends Mage_Sales_Model_Quote_Address_Total_Abstract
{
    protected $_code = 'insurance';

    public function collect(Mage_Sales_Model_Quote_Address $address)
    {
        parent::collect($address);

        if (Mage::helper('insurance')->isInsuranceEnabled()) {
            $items = $this->_getAddressItems($address);

            if (!count($items)) {
                return $this;
            }
            $price = $this->calculateInsurancePrice($address);
            $this->setInsurance($address, $price);
        }

        return $this;
    }

    public function fetch(Mage_Sales_Model_Quote_Address $address)
    {
        $amount = $address->getInsurance();
        $insuranceLabel = Mage::getStoreConfig('insurance_options/customins/insurance_label');

        $address->addTotal(
            ['code' => $this->getCode(),
                'title' => Mage::helper('insurance')->__($insuranceLabel),
                'value' => $amount]
        );

        return $this;
    }

    /**
     * @param \Mage_Sales_Model_Quote_Address $address
     * @return float|int
     */
    protected function calculateInsurancePrice(Mage_Sales_Model_Quote_Address $address)
    {
        $type = Mage::getStoreConfig('insurance_options/customins/insurace_type');
        $rate = Mage::getStoreConfig('insurance_options/customins/insurance_rate');
        $quote = Mage::getSingleton('checkout/session')->getQuote();
        $items = $quote->getAllItems();
        $subTotals = 0;

        foreach ($items as $item) {
            $subTotals += $item->getRowTotalInclTax();
        }
        $price = 0;

        if ($type == 1) {
            $price = round($rate, 4, PHP_ROUND_HALF_UP);
        } elseif ($type == 2) {
            $price = round(($subTotals * $rate) / 100, 4, PHP_ROUND_HALF_UP);
        }

        return $price;
    }

    /**
     * @param \Mage_Sales_Model_Quote_Address $address
     * @param $insuranceValue
     */
    protected function setInsurance(Mage_Sales_Model_Quote_Address $address, $price)
    {
        $quote = $address->getQuote();
        $quote->setInsurance($price);
        $address->setInsurance($price);
        $address->setGrandTotal($address->getGrandTotal() + $address->getInsurance());
        $address->setBaseGrandTotal($address->getBaseGrandTotal() + $address->getInsurance());
    }
}