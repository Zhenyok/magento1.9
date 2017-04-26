<?php

class Itransition_Insurance_Block_Onepage_Insurance extends Mage_Checkout_Block_Onepage_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $insuranceLabel = Mage::getStoreConfig('insurance_options/customins/insurance_label');

        $this->getCheckout()->setStepData('insurance', array(
            'label' => $this->helper('insurance')->__($insuranceLabel),
            'is_show' => true
        ));

    }
}