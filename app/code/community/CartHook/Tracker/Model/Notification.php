<?php

class CartHook_Tracker_Model_Notification
{
    protected static $_flagCode  = 'admin_notification_carthook';
    protected static $_flagModel = null;

    /**
     * Return core flag model
     *
     * @return Mage_Core_Model_Flag
     */
    protected static function _getFlagModel()
    {
        if (self::$_flagModel === null) {
            self::$_flagModel = Mage::getModel('core/flag', array('flag_code' => self::$_flagCode))->loadSelf();
        }
        return self::$_flagModel;
    }

    /**
     * Check if notification was viewed
     *
     * @return boolean
     */
    public static function isNotificationViewed()
    {
        $flagData = self::_getFlagModel()->getFlagData();
        if (isset($flagData['notification_viewed']) && $flagData['notification_viewed'] == 1) {
            return true;
        }
        return false;
    }
    
    /**
     * Save notification viewed flag in core flag
     *
     * @param boolean $viewed
     */
    public static function saveNotificationViewed()
    {
        self::_getFlagModel()->setFlagData(array('notification_viewed' => true))->save();
    }
}
