<?php

/**
 * PayPal REST Update Payment Request
 */

namespace Omnipay\PayPalPlus\Message;

/**
 * PayPal REST Update Payment Request
 */
class RestUpdatePaymentRequest extends RestAuthorizeRequest
{
    public function getData()
    {
        $data = array(
            array(
                'op' => 'replace',
                'path' => '/transactions/0/amount',
                'value' => array(
                    'total' => $this->getAmount(),
                    'currency' => $this->getCurrency(),
                    /*'details' => array(
                        'subtotal' => 
                        'shipping' => 
                    )*/
                )
            )
        );

        return $data;
    }
    
    protected function getHttpMethod()
    {
        return 'PATCH';
    }

    protected function getEndpoint()
    {
        return parent::getEndpoint() . '/' . $this->getTransactionReference();
    }
}
