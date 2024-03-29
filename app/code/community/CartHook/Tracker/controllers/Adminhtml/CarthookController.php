<?php

class CartHook_Tracker_Adminhtml_CarthookController extends Mage_Adminhtml_Controller_Action
{

    public function denyNotificationAction()
    {
        if ($this->getRequest()->getParam('isAjax', false)) {
            CartHook_Tracker_Model_Notification::saveNotificationViewed();
        }
        $this->getResponse()->setBody(Zend_Json::encode(array('deny_notification_saved' => 1)));
    }

    /**
     * Check if user has enough privileges
     *
     * @return boolean
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('all');
    }
}
