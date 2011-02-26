<?php

class Thermitic_Survey_Block_Onepage_Survey extends Mage_Checkout_Block_Onepage_Abstract
{
    protected function _construct()
    {      
        $this->getCheckout()->setStepData('survey', array(
            'label'     => Mage::helper('checkout')->__(Mage::getStoreConfig('thermitic/survey/question',Mage::app()->getStore())),
            'is_show'   => true
        ));
        
        parent::_construct();
    }
}
