<?php

/**
 * Block to check overriding for checkout by other extensions and show warning message
 *
 * @category   CartHook
 * @package    CartHook_Tracker
 */
class CartHook_Tracker_Block_Adminhtml_Notification extends Mage_Core_Block_Template
{

    public function canShow()
    {
        if (CartHook_Tracker_Model_Notification::isNotificationViewed()) {
            return false;
        }

        if ($this->_isCoreCheckoutControllerOverridden()
            || $this->_isCoreCheckoutUrlHelperOverridden()
        ) {
            return true;
        }

        return false;
    }

    protected function _isCoreCheckoutControllerOverridden()
    {
        $frontController = new Mage_Core_Controller_Varien_Front();
        $frontController->init();

        $standard = $frontController->getRouter('standard');

        $modules = $standard->getModuleByFrontName('checkout');

        return reset($modules) != 'Mage_Checkout';
    }

    protected function _isCoreCheckoutUrlHelperOverridden()
    {
        return get_class(Mage::helper('checkout/url')) != 'Mage_Checkout_Helper_Url';
    }

}
