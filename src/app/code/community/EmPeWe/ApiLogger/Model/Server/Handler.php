<?php

class EmPeWe_ApiLogger_Model_Server_Handler extends Mage_Api_Model_Server_Handler
{
    private $boolLogActive = false;
    private $strLogfile = '';
    
    public function __construct()
    {
        $this->boolLogActive  = Mage::getStoreConfig('apilogger_options/config/apilogger_v1_log_active');
        $this->strLogfile     = Mage::getStoreConfig('apilogger_options/config/apilogger_v1_log_file')
                              ? Mage::getStoreConfig('apilogger_options/config/apilogger_v1_log_file')
                              : 'EmPeWe_ApiLogger.log';
    }

    public function call($sessionId, $apiPath, $args = array())
    {
        if($this->boolLogActive) { Mage::log("SOAP Method (V1): $apiPath \nParameters: " . print_r(array_merge((array)$sessionId, $args), true), null, $this->strLogfile, true); }
        
        return parent::call($sessionId, $apiPath, $args);
    }
} // Class EmPeWe_ApiLogger_Model_Server_Handler End
