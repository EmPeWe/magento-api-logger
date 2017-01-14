<?php

class EmPeWe_ApiLogger_Model_Server_V2_Handler extends Mage_Api_Model_Server_V2_Handler
{
    public function __call($function, $args = array())
    {
        list($sessionId) = $args;

        $requestId = $this->generateRequestId($sessionId);

        $helper = $this->getHelper();

        try {
            $helper->log($requestId, $function, $args);

            $response = parent::__call($function, $args);

            $helper->log($requestId, $function, $args, $response);

            return $response;
        } catch (Exception $e) {
            $helper->log($requestId, $function, $args, isset($response) ? $response : null, $e);

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

    /**
     * @param string $sessionId
     * @return string
     */
    protected function generateRequestId($sessionId)
    {
        return uniqid($sessionId . '_', true);
    }
}
