<?php

require_once 'Mage/Checkout/controllers/OnepageController.php';

class Thermitic_Survey_OnepageController extends Mage_Checkout_OnepageController
{
    public function doSomestuffAction()
    {
      if(true) {
          $result['update_section'] = array(
              'name' => 'payment-method',
                'html' => $this->_getPaymentMethodsHtml()
          );                    
      }
      else {
          $result['goto_section'] = 'shipping';
      }        
    }    

    public function savePaymentAction()
    {
        $this->_expireAjax();
        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost('payment', array());
            /*
            * first to check payment information entered is correct or not
            */

            try {
                $result = $this->getOnepage()->savePayment($data);
            }
            catch (Mage_Payment_Exception $e) {
                if ($e->getFields()) {
                    $result['fields'] = $e->getFields();
                }
                $result['error'] = $e->getMessage();
            }
            catch (Exception $e) {
                $result['error'] = $e->getMessage();
            }
            $redirectUrl = $this->getOnePage()->getQuote()->getPayment()->getCheckoutRedirectUrl();
            if (empty($result['error']) && !$redirectUrl) {
                $this->loadLayout('checkout_onepage_survey');

                $result['goto_section'] = 'survey';
            }

            if ($redirectUrl) {
                $result['redirect'] = $redirectUrl;
            }

            $this->getResponse()->setBody(Zend_Json::encode($result));
        }
    }

    public function saveSurveyAction()
    {
        $this->_expireAjax();
        if ($this->getRequest()->isPost()) {
            
            $_thermitic_Survey = $this->getRequest()->getPost('getsurvey');
            
            // FIXME: how to properly sanitize this?
            Mage::getSingleton('core/session')->setThermiticSurvey(htmlspecialchars(strip_tags($_thermitic_Survey)));

            $result = array();
                
            $redirectUrl = $this->getOnePage()->getQuote()->getPayment()->getCheckoutRedirectUrl();
            if (!$redirectUrl) {
                $this->loadLayout('checkout_onepage_review');

                $result['goto_section'] = 'review';
                $result['update_section'] = array(
                    'name' => 'review',
                    'html' => $this->_getReviewHtml()
                );

            }

            if ($redirectUrl) {
                $result['redirect'] = $redirectUrl;
            }

            $this->getResponse()->setBody(Zend_Json::encode($result));
        }
    }    
}
