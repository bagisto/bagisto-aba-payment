<?php
return [
    'aba_standard' => [
        'code'             => 'aba_standard',
        'title'            => 'ABA Pay',
        'description'      => 'ABA Pay',
        'class'            => 'Webkul\Aba\Payment\Standard',
        'sandbox'          => true,
        'active'           => true,
        'sort'             => 4,
    ],'credit_standard' => [
        'code'             => 'credit_standard',
        'title'            => 'Credit/Debit Card',
        'description'      => 'Credit/Debit Card',
        'class'            => 'Webkul\Aba\Payment\Credit',
        'sandbox'          => true,
        'active'           => true,
        'sort'             => 5,
    ],
];