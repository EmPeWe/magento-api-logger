<?php

class EmPeWe_ApiLogger_Model_Server_Handler extends Mage_Api_Model_Server_Handler
{
    public function call($sessionId, $apiPath, $args = array())
    {
        try {
            $response = parent::call($sessionId, $apiPath, $args);

            $this->getHelper()->log($sessionId, $apiPath, $args, $response);
        } catch (Exception $e) {
            $this->getHelper()->log($sessionId, $apiPath, $args, isset($response) ? $response : null, $e);

            throw $e;
        }

        return $response;
    }

    /**
     * @return EmPeWe_ApiLogger_Helper_V1
     */
    protected function getHelper()
    {
        return Mage::helper('empewe_apilogger/v1');
    }
}
