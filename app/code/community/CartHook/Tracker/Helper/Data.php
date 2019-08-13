<?php

/**
 * Generic helper for module
 *
 * @category   CartHook
 * @package    CartHook_Tracker
 */
class CartHook_Tracker_Helper_Data extends Mage_Core_Helper_Abstract
{

    const XML_PATH_CARTHOOK_ENABLED         = 'checkout/carthook_tracker/enabled';
    const XML_PATH_CARTHOOK_MERCHANT_ID     = 'checkout/carthook_tracker/merchant_id';

    public function getCartHookMerchantId()
    {
        return Mage::getStoreConfig(self::XML_PATH_CARTHOOK_MERCHANT_ID);
    }

    public function getRestoreUrl()
    {
        if ($quote = Mage::getSingleton('checkout/session')->getQuote()) {
            $url = Mage::getUrl('carthook/cart/restore', array('cart' => base64_encode($quote->getId())));
        } else {
            $url = Mage::getUrl('checkout/cart');
        }

        return $url;
    }

}
