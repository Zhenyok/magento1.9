<?php

class Itransition_Insurance_Block_Onepage extends Mage_Checkout_Block_Onepage
{
    public function getSteps()
    {
        $steps = array();

        if (!$this->isCustomerLoggedIn()) {
            $steps['login'] = $this->getCheckout()->getStepData('login');
        }
		
        if (Mage::helper('insurance')->isEnabled()) {
        	$stepCodes = array('billing', 'shipping', 'shipping_method', 'insurance', 'payment', 'review');
        }
        else {
        	$stepCodes = array('billing', 'shipping', 'shipping_method', 'payment', 'review');
        }
        foreach ($stepCodes as $step) {
            $steps[$step] = $this->getCheckout()->getStepData($step);
        }
        
        return $steps;
    }
}