<?php

class Itransition_Insurance_Model_Options extends Mage_Core_Model_Config_Data
{
    /**
     * Provide available options as a value/label array
     *
     * @return array
     */
    public function toOptionArray()
    {
        return array(
            array('value'=>1, 'label'=>'Fixed rate'),
            array('value'=>2, 'label'=>'% Percent rate')
        );
    }
}