<?php

namespace Webkul\Aba\Payment;

class Standard extends Aba
{
    /**
     * Payment method code
     *
     * @var string
     */
    protected $code  = 'aba_standard';

    /**
     * Line items fields mapping
     *
     * @var array
     */
    protected $itemFieldsFormat = [
        'id'       => 'item_number_%d',
        'name'     => 'item_name_%d',
        'quantity' => 'quantity_%d',
        'price'    => 'amount_%d',
    ];

    /**
     * Return paypal redirect url
     *
     * @return string
     */
    public function getRedirectUrl()
    {
        if(! $this->checkValidKeys()) {
            
            session()->flash('error', 'Aba Payway Gateway credentials  is not Valid');

            return redirect()->route('shop.checkout.cart.index');
        }else{
            
            return route('aba.standard.redirect');
        }
       
    }

    /**
     * Return form field array
     *
     * @return array
     */
    public function getFormFields()
    {
        $cart = $this->getCart();

        $amount = ($cart->sub_total + $cart->tax_total + ($cart->selected_shipping_rate ? $cart->selected_shipping_rate->price : 0)) -  ($cart->discount_amount);

        $fields = [
            'firstname'       => $cart->customer_first_name,
            'lastname'       => $cart->customer_last_name,
            'email'       => $cart->customer_email,
            'item_name'       => core()->getCurrentChannel()->name,
            'phone'           => '1211122112',
            'amount'          => number_format(floatval($amount), 2),
            'phone_country_code ' => '+91'
        ];

        return $fields;
    }
}
