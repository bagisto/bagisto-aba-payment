<?php

namespace Webkul\Aba\Http\Controllers;

use Webkul\Checkout\Facades\Cart;
use Webkul\Sales\Repositories\OrderRepository;
use Webkul\Aba\Helpers\Ipn;

class StandardController extends Controller
{

    protected $transID;

    /**
     * OrderRepository object
     *
     * @var \Webkul\Sales\Repositories\OrderRepository
     */
    protected $orderRepository;

    /**
     * Ipn object
     *
     * @var \Webkul\Aba\Helpers\Ipn
     */
    protected $ipnHelper;

    /**
     * Create a new controller instance.
     *
     * @param  \Webkul\Attribute\Repositories\OrderRepository  $orderRepository
     * @param  \Webkul\Aba\Helpers\Ipn  $ipnHelper
     * @return void
     */
    public function __construct(
        OrderRepository $orderRepository,
        Ipn $ipnHelper
    )
    {
        $this->orderRepository = $orderRepository;

        $this->ipnHelper = $ipnHelper;

        $this->transID = time();
    }

    /**
     * Redirects to the Aba.
     *
     * @return \Illuminate\View\View
     */
    public function redirect()
    {
        $transactionId = $this->transID;
    
        session()->put('transID',$transactionId);

        $order = $this->orderRepository->create(Cart::prepareDataForOrder());

        $order = $this->orderRepository->find($order->id);

        $order->transaction_id = $transactionId;

        $order->save();       

        session()->put('order',$order);

        return view('aba::standard-redirect',compact('transactionId'));
    }

     /**
     * Redirects to the Aba.
     *
     * @return \Illuminate\View\View
     */
    public function creditRedirect()
    {
        $transactionId = $this->transID;
    
        session()->put('transID',$transactionId);

        $order = $this->orderRepository->create(Cart::prepareDataForOrder());

        $order = $this->orderRepository->find($order->id);

        $order->transaction_id = $transactionId;

        $order->save();
       
        session()->put('order',$order);

        return view('aba::standard-credit-redirect',compact('transactionId'));
    }

    /**
     * Cancel payment from paypal.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancel()
    {
        session()->flash('error', 'Aba payment has been canceled.');

        return redirect()->route('shop.checkout.cart.index');
    }

    /**
     * Success payment
     *
     * @return \Illuminate\Http\Response
     */
    public function success()
    {
        Cart::deActivateCart();

        return redirect()->route('shop.checkout.success');
    }

    /**
     * Paypal Ipn listener
     *
     * @return \Illuminate\Http\Response
     */
    public function ipn()
    {
       return  $this->ipnHelper->processIpn(request()->all());
    }
}