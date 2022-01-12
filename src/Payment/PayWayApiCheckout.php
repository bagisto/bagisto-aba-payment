<?php

namespace Webkul\Aba\Payment;

class PayWayApiCheckout {

    /*
    |--------------------------------------------------------------------------
    | ABA PayWay Merchant ID
    |--------------------------------------------------------------------------
    | Merchant ID that is generated and provided by PayWay must be required in your post form
    |
    */
    public  $aba_payway_merchant_id = '';

    /*
    |--------------------------------------------------------------------------
    | ABA PayWay API KEY
    |--------------------------------------------------------------------------
    | API KEY that is generated and provided by PayWay must be required in your post form
    |
    */
    public $aba_payway_api_key = '';

    /*
    |--------------------------------------------------------------------------
    | ABA PayWay API URL
    |--------------------------------------------------------------------------
    | API KEY that is generated and provided by PayWay must be required in your post form
    |
    */
    public $aba_payway_api_url = '';
    
    public function __construct()
    {
       
    }

    
    /**
	 * Returns the getHash
	 * For PayWay security, you must follow the way of encryption for hash.
	 *
	 * @param string $transactionId
	 * @param string $amount
	 *
	 * @return string getHash
	 */
	public  function getHash($transactionId, $amount) {

		$hash = base64_encode(hash_hmac('sha512', $this->aba_payway_merchant_id . $transactionId . $amount, $this->aba_payway_api_key, true));
		return $hash;
	}

	/**
	 * Returns the getApiUrl
	 *
	 * @return string getApiUrl
	 */
	public function getApiUrl() {
		return $this->aba_payway_api_url;
    }
    
    /**
	 * 
	*  Set The configuration of aba payment
	 * @return string getApiUrl
	 */
	public function setConfig($aba_payway_merchant_id,$aba_payway_api_key,$aba_payway_api_url) {
        $this->aba_payway_merchant_id = $aba_payway_merchant_id;
        $this->aba_payway_api_key = $aba_payway_api_key;
        $this->aba_payway_api_url = $aba_payway_api_url;
    }

    
}