<?php
class Thermitic_Survey_Model_Observer
{
  
  const ORDER_ATTRIBUTE_FHC_ID = 'survey';
      
    /**
     * Event Hook: checkout_type_onepage_save_order
     * 
     * @author Branko Ajzele
     * @param $observer Varien_Event_Observer
     */
  public function hookToOrderSaveEvent()
  {
      /**
      * NOTE:
      * Order has already been saved, now we simply add some stuff to it,
      * that will be saved to database. We add the stuff to Order object property
      * called "survey"
      */
      $order = new Mage_Sales_Model_Order();
      $incrementId = Mage::getSingleton('checkout/session')->getLastRealOrderId();
      $order->loadByIncrementId($incrementId);
      
      //Fetch the data from select box and throw it here
      $_survey_data = null;
      $_survey_data = Mage::getSingleton('core/session')->getThermiticSurvey();
      
      //Save fhc id to order obcject
      $order->setData(self::ORDER_ATTRIBUTE_FHC_ID, $_survey_data);
      $order->save();
  }



}
