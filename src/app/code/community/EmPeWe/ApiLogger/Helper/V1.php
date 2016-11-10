<?php

class EmPeWe_ApiLogger_Helper_V1 extends Mage_Core_Helper_Abstract
{
    /**
     * @param mixed $store
     * @return bool
     */
    public function getIsActive($store = null)
    {
        return Mage::getStoreConfigFlag('apilogger_options/config/apilogger_v1_log_active', $store);
    }

    /**
     * @param mixed $store
     * @return bool
     */
    public function getIsVerboseEnabled($store = null)
    {
        return Mage::getStoreConfigFlag('apilogger_options/config/apilogger_v1_log_verbose', $store);
    }

    /**
     * @param mixed $store
     * @return string
     */
    public function getLogFilename($store = null)
    {
        return (string)Mage::getStoreConfig('apilogger_options/config/apilogger_v1_log_file', $store);
    }

    /**
     * @param mixed $store
     * @return bool
     */
    public function getForceLog($store = null)
    {
        return Mage::getStoreConfigFlag('apilogger_options/config/apilogger_force_log', $store);
    }

    public function log($sessionId, $apiPath, $args = array(), $response = null, Exception $exception = null)
    {
        if (!$this->getIsActive()) {
            return;
        }

        $log = "SOAP Method (V1): {$apiPath}";
        $log .= "\nCalled from IP: {$this->getRemoteAddr()}";
        $log .= "\nParameters: " . print_r(array_merge((array)$sessionId, $args), true);

        $apiUser = $this->getSession()->getUser();

        if ($apiUser instanceof Mage_Api_Model_User) {
            $log .= sprintf("\nAPI User: %s (ID: %s)", $apiUser->getUsername(), $apiUser->getId());
        }

        if ($this->getIsVerboseEnabled()) {
            $log .= "\nResponse: " . print_r($response, true);
        }

        if ($exception) {
            $log .= "\nException: {$exception}";

        }

        $logLevel = ($exception ? Zend_Log::WARN : Zend_Log::DEBUG);

        Mage::log($log, $logLevel, $this->getLogFilename(), $this->getForceLog());
    }

    /**
     * @return string
     */
    protected function getRemoteAddr()
    {
        return Mage::helper('core/http')->getRemoteAddr();
    }

    /**
     * Retrieve webservice session
     *
     * @return Mage_Api_Model_Session
     */
    protected function getSession()
    {
        return Mage::getSingleton('api/session');
    }
}
