<?php

/**
 * Main block for module
 *
 * @category   CartHook
 * @package    CartHook_Tracker
 */
class CartHook_Tracker_Block_Tracking extends Mage_Core_Block_Template
{

    public function getCartItems()
    {
        $items = array();
        $mediaUrl = Mage::getBaseUrl('media');
        foreach ($this->_getQuote()->getAllItems() as $item) {
            if ($item->getParentItem()) {
                continue;
            }
            $newItem = array();
            $newItem['imgUrl']        = $mediaUrl . 'catalog/product' . $item->getProduct()->getThumbnail();
            $newItem['url']           = $item->getProduct()->getProductUrl();
            $newItem['name']          = htmlspecialchars($item->getName());
            $newItem['eachItemCost']  = strval($item->getCalculationPrice());
            $newItem['totalItemCost'] = strval($item->getRowTotal());
            $items[]                  = $newItem;
        }
        return $items;
    }

    public function getCartDataAsJson()
    {
        $cartData = '';
        if ($quote = $this->_getQuote() && ($items = $this->getCartItems())) {
            $cartData = array(
                //'price' => Mage::helper('core')->currency($this->_getQuote()->getSubtotal(), true, false),
                'price' => strval( $this->_getQuote()->getSubtotal() ),
                'items' => $items,
                'carturl' => Mage::helper('carthook_tracker')->getRestoreUrl()
            );
        }
        return str_replace('\\', '', Mage::helper('core')->jsonEncode($cartData));
    }

    protected function _getQuote()
    {
        return Mage::getSingleton('checkout/session')->getQuote();
    }

}
