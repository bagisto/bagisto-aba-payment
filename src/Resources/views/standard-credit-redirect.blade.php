<?php $standard = app('Webkul\Aba\Payment\Standard'); ?>
<?php $abaStandard = app('Webkul\Aba\Payment\PayWayApiCheckout'); ?>


@php

// Getting The Configuration
$configs = $standard->getConfig();

// Setting The Configuration
$abaStandard->setConfig($configs['merchant_id'], $configs['keys'], $configs['api_url']);

// Geting the Fields
$fields = $standard->getFormFields();
$firstName = $fields['firstname'];
$lastName = $fields['lastname'];
$email = $fields['email'];
$phone = $fields['phone'];
$amount = $fields['amount'];
$continue_url = route('aba.standard.success');
$return_url = base64_encode(route('aba.standard.redirect'));

@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Aba PayWay Checkout</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <meta name="author" content="PayWay">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://payway-staging.ababank.com/checkout-popup.html?file=css" />

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="https://payway-staging.ababank.com/checkout-popup.html?file=js"></script>

        {{-- <link rel="stylesheet" href="https://payway.ababank.com/checkout-popup.html?file=css"/> --}}
        {{-- <script src="https://payway.ababank.com/checkout-popup.html?file=js"></script> --}}

        <style>
        body { padding: 0; margin: 0; background-color: #04ced5;  color: #055b83;  }

        .body-color-white { background-color: #fff; width: 60%; margin-top: 5%; padding: 2px;  }

        h2 { font-size: 2rem; font-weight: 500;  }

        h3 { font-size: 1.2rem; margin: 10px auto;  text-align: center; }

        .col-md-12 { border: 1px solid #055b83;  }

        #checkout_button {  margin: 10px auto; display: block;  }

        </style>
</head>

<body>
    {{--  Popup Checkout Form  --}}
        <div id="aba_main_modal" class="aba-modal">
            {{--  Modal content  --}}
                <div class="aba-modal-content">
                    <form method="POST" target="aba_webservice"
                        action="<?php echo $abaStandard->getApiUrl(); ?>"
                        id="aba_merchant_request">
                        <input type="hidden" name="hash" value="<?php echo $abaStandard->getHash($transactionId, $amount); ?>" id="hash" />
                        <input type="hidden" name="tran_id" value="<?php echo $transactionId; ?>" id="tran_id" />
                        <input type="hidden" name="amount" value="<?php echo $amount; ?>" id="amount" />
                        <input type="hidden" name="firstname" value="<?php echo $firstName; ?>" />
                        <input type="hidden" name="lastname"  value="<?php echo $lastName; ?>" />
                        <input type="hidden" name="phone" value="<?php echo $phone; ?>" />
                        <input type="hidden" name="email" value="<?php echo $email; ?>" />
                        <input type="hidden" name="continue_url" value="<?php echo $continue_url; ?>" />
                        <input type="hidden" name="return_url" value="<?php echo $return_url; ?>" />
                        <input type="hidden" name="return_params" value="json" />
                        <input type="hidden" name="payment_option" value="cards"/>
                    </form>
                </div>
                {{-- end Modal content --}}
        </div>
        {{-- End Popup Checkout Form --}}

        {{-- Page Content --}}
        <div class="container" style="margin-top: 75px;margin: 0 auto;">
            <div class="container body-color-white">
                <div class="main-heading mt-2 mb-2">
                    <h2 class="text-center"> <i>Welcome to ABA Payment Gateway</i></h2>
                </div>
                <div class="row" style="width: 93%;margin-left: 3%;margin-bottom:10px;">
                    <div class="col-md-12">
                        <h3>TOTAL Amount: ${{ $amount }}</h3>
                        <input type="button" id="checkout_button" class="btn btn-success btn-sm mb-2"  value="Checkout Now">
                    </div>
                </div>
              </div>
        </div>
        {{--  End Page Content  --}}

        <script>
        $(document).ready(function() {

             var returnStatus = AbaPayway.checkout();
            console.log(returnStatus);
            
        });
        </script>
     {{-- End --}}
</body>

</html>
