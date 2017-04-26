<?php

class Itransition_Insurance_Model_Rate extends Mage_Core_Model_Config_Data
{
    public function save()
    {
        $value = $this->getValue();
        $rate_type =Mage::app()->getRequest()->getParam('groups');
        $rate_type = $rate_type['customins']['fields']['insurace_type']['value'];
        $isValid = true;


        if (!is_numeric($value) || $value <= 0) {
            $isValid = false;
        }
        if ($rate_type == 2 && $value > 100) {
            $isValid = false;
        }

        if (!$isValid) {
            Mage::getSingleton('core/session')->addError('Rate value is not valid.');
            return false;
        }

        return parent::save();
    }
}