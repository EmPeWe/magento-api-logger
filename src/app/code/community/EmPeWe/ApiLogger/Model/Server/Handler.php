<?php

class EmPeWe_ApiLogger_Model_Server_Handler extends Mage_Api_Model_Server_Handler
{
    public function call($sessionId, $apiPath, $args = array())
    {
        $requestId = $this->generateRequestId($sessionId);

        $helper = $this->getHelper();

        try {
            $helper->log($requestId, $sessionId, $apiPath, $args);

            $response = parent::call($sessionId, $apiPath, $args);

            $helper->log($requestId, $sessionId, $apiPath, $args, $response);

            return $response;
        } catch (Exception $e) {
            $helper->log($requestId, $sessionId, $apiPath, $args, isset($response) ? $response : null, $e);

            throw $e;
        }
    }

    /**
     * @return EmPeWe_ApiLogger_Helper_V1
     */
    protected function getHelper()
    {
        return Mage::helper('empewe_apilogger/v1');
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
