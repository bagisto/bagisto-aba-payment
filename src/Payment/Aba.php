<?php

namespace Webkul\Aba\Payment;

use Webkul\Payment\Payment\Payment;

abstract class Aba extends Payment
{

    /**
     * Aba web URL generic getter
     *
     * @param  array  $params
     * @return string
     */
    public function getAbaUrl($params = [])
    {     
        $merchant_id =  $this->getConfigData('merchant_id');

        $keys =  $this->getConfigData('keys');

        $api_url = '';

        if($keys) {

            if($this->getConfigData('sandbox')) {
                $api_url = 'https://sandbox.payway.com.kh/sandbox/api/'.$keys.'/';
            } else {
                $api_url = 'https://payway.com.kh/api/'.$keys.'/';
            }

            if(! $this->checkValidKeys()) {
                
                session()->flash('error', 'Aba Payway Gateway credentials  is not Valid');

                return redirect()->route('shop.checkout.cart.index');
            }

        } else {
            session()->flash('error', 'Aba Payway Gateway Is not Activated');

            return redirect()->route('shop.checkout.cart.index');

        }
        
        return $api_url;   
    }


    /**
     * Checks if line items enabled or not
     *
     * @return bool
     */
    public function getIsLineItemsEnabled()
    {
        return true;
    }

    /**
     * get the configuration
     *
     * @return array
     */
    public function getConfig(){

        return [
           'merchant_id' => $this->getConfigData('merchant_id'),
           'keys'  => $this->getConfigData('keys'),
           'api_url' => $this->getAbaUrl()
       ];
    }

     /**
     * check the Keys
     *
     * @return boolean
     */
    public function checkValidKeys() {

        $keys =  $this->getConfigData('keys');

        $api_url = '';

        if($keys) {

            if($this->getConfigData('sandbox')) {
                $api_url = 'https://sandbox.payway.com.kh/sandbox/api/'.$keys.'/';
            } else {
                $api_url = 'https://payway.com.kh/api/'.$keys.'/';
            }

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,  $api_url);
            curl_setopt($ch, CURLOPT_HEADER, TRUE);
            curl_setopt($ch, CURLOPT_NOBODY, TRUE); // remove body
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            $head = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if($httpCode != 200 || $httpCode != 201 ) {
                return false;
            }else{
                return true;
            }
        }

        return false;
    }

}