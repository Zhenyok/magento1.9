<?php

class Itransition_Insurance_Helper_Data extends Mage_Core_Helper_Abstract {
    const XML_CONFIG_PATH = 'insurance_options/customins/';
    public function isEnabled()
    {
        return (bool) $this->_getConfigValue('insurance_enable');
    }
    protected function _getConfigValue($key)
    {
        return Mage::getStoreConfig(self::XML_CONFIG_PATH . $key);
    }

    public function getRate()
    {
        $rateData = $this->getRateInfo();

        if ($rateData['type'] == 2) {
            return $rateData['rate'].'%';
        }

        $currency_code = Mage::app()->getStore()->getCurrentCurrencyCode();
        $symbol = Mage::app()->getLocale()->currency($currency_code)->getSymbol();

        return $rateData['rate'].$symbol;
    }

    public function getRateInfo()
    {
        $rate = $this->_getConfigValue('insurance_rate');
        $type = $this->_getConfigValue('insurace_type');
        $data = array(
          'rate' => $rate,
          'type' => $type
        );

        return $data;
    }

    public function isInsuranceEnabled()
    {
        $isEnabled = $this->isEnabled();
        $isSelectedEnsurance = (bool) Mage::getSingleton('checkout/session')->getData('isSelectedInsurance', false);

        return $isEnabled && $isSelectedEnsurance;
    }

}