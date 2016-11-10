<?php

class EmPeWe_ApiLogger_Model_Server_V2_Handler extends Mage_Api_Model_Server_V2_Handler
{
    private $boolLogActive = false;
    private $boolLogVerbose = false;
    private $strLogfile = '';

    public function __construct()
    {
        $this->boolLogActive = Mage::getStoreConfig('apilogger_options/config/apilogger_v2_log_active');
        $this->boolLogVerbose = Mage::getStoreConfig('apilogger_options/config/apilogger_v2_log_verbose');
        $this->strLogfile = Mage::getStoreConfig('apilogger_options/config/apilogger_v2_log_file')
            ? Mage::getStoreConfig('apilogger_options/config/apilogger_v2_log_file')
            : 'EmPeWe_ApiLogger.log';
        $this->forceLog = Mage::getStoreConfig('apilogger_options/config/apilogger_force_log');
    }

    public function __call($function, $args = array())
    {
        $response = parent::__call($function, $args);

        if ($this->boolLogActive) {
            $log = "SOAP Method (V2): $function";
            $log .= "\ncalled from {$_SERVER['REMOTE_ADDR']}";
            $log .= "\nParameters: " . print_r($args, true);
            if ($this->boolLogVerbose) {
                $log .= "\nResponse: " . print_r($response, true);
            }
            Mage::log($log,
                null,
                $this->strLogfile,
                $this->forceLog);
        }

        return $response;
    }
}
