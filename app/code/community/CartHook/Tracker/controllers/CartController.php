<?php

class CartHook_Tracker_CartController extends Mage_Core_Controller_Front_Action
{

    function restoreAction()
    {
        if ($quoteId = $this->getRequest()->getParam('cart', false)) {
            $quoteId = base64_decode($quoteId);
            if (!($quote = Mage::getSingleton('checkout/session')->getQuote())
                || $quote->getId() != $quoteId
            ) {
                $restoreQuote = Mage::getModel('sales/quote')->load($quoteId);
                Mage::getSingleton('checkout/session')->replaceQuote($restoreQuote);
                Mage::getSingleton('checkout/session')->setCartWasUpdated(true);
            }
        }

        $this->_redirect('checkout/cart');
    }

}