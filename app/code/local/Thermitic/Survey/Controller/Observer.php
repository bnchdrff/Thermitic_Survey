<?php

class Thermitic_Survey_Controller_Observer
{
  //Event: adminhtml_controller_action_predispatch_start
  public function overrideTheme()
  {
      Mage::getDesign()->setArea('adminhtml')
      	->setTheme((string)Mage::getStoreConfig('design/admin/theme'));
  }
}
