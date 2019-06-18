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
        $billingAddress = $this->getBillingAddress();

        $data = array(
            array(
                'op' => 'replace',
                'path' => '/transactions/0/amount',
                'value' => array(
                    'total' => $this->getAmount(),
                    'currency' => $this->getCurrency()
                )
            ),
            array(
                'op' => 'add',
                'path' => '/payer/payer_info',
                'value' => array(
                    'first_name' => $billingAddress['firstName'],
                    'last_name' => $billingAddress['lastName'],
                    'email' => $billingAddress['email'],
                    'billing_address' => array(
                        'line1' => $billingAddress['street'],
                        'city' => $billingAddress['city'],
                        'country_code' => $billingAddress['country'],
                        'postal_code' => $billingAddress['zipCode']
                    )
                )
            )
        );

        return $data;
    }

    public function getBillingAddress()
    {
        return $this->getParameter('billingAddress');
    }

    public function setBillingAddress($value)
    {
        $this->setParameter('billingAddress', $value);
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
