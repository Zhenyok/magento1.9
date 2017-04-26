<?php

class Itransition_Insurance_Model_Enabled extends Mage_Core_Model_Config_Data
{
    /**
     * Provide available options as a value/label array
     *
     * @return array
     */
    public function toOptionArray()
    {
        return array(
            array('value'=>0, 'label'=>'Disabled'),
            array('value'=>1, 'label'=>'Enabled'),
        );
    }
}