<?php

class EmPeWe_ApiLogger_Model_Server_V2_Handler extends Mage_Api_Model_Server_V2_Handler
{
    public function __call($function, $args = array())
    {
        try {
            $response = parent::__call($function, $args);

            $this->getHelper()->log($function, $args, $response);

            return $response;
        } catch (Exception $e) {
            $this->getHelper()->log($function, $args, isset($response) ? $response : null, $e);

            throw $e;
        }
    }

    /**
     * @return EmPeWe_ApiLogger_Helper_V2
     */
    protected function getHelper()
    {
        return Mage::helper('empewe_apilogger/v2');
    }
}
