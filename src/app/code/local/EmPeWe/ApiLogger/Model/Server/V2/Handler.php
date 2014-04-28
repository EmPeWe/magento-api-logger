<?php

class EmPeWe_ApiLogger_Model_Server_V2_Handler extends Mage_Api_Model_Server_V2_Handler
{
    private $boolLogActive = false;
    private $strLogfile = '';
    
    public function __construct()
    {
        $this->boolLogActive  = Mage::getStoreConfig('apilogger_options/config/apilogger_log_active');
        $this->strLogfile     = Mage::getStoreConfig('apilogger_options/config/apilogger_log_file')
                              ? Mage::getStoreConfig('apilogger_options/config/apilogger_log_file')
                              : 'EmPeWe_ApiLogger.log';
    }

    public function __call($function, $args = array())
    {
        if($this->boolLogActive) { Mage::log("SOAP Method (V2): $function \nParameters: " . print_r($args, true), null, $this->strLogfile); }
        
        return parent::__call($function, $args);
    }
} // Class EmPeWe_ApiLogger_Model_Server_V2_Handler End
