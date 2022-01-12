<?php

return [
    [
        'key'    => 'sales.paymentmethods.aba_standard',
        'name'   => 'aba::app.admin.system.aba-standard',
        'sort'   => 4,
        'fields' => [
            [
                'name'          => 'title',
                'title'         => 'aba::app.admin.system.title',
                'type'          => 'text',
                'validation'    => 'required',
                'channel_based' => false,
                'locale_based'  => true,
            ], [
                'name'          => 'description',
                'title'         => 'aba::app.admin.system.description',
                'type'          => 'textarea',
                'channel_based' => false,
                'locale_based'  => true,
            ],  [
                'name'       => 'merchant_id',
                'title'      => 'aba::app.admin.system.merchant-id',
                'type'       => 'select',
                'type'       => 'text',
                'validation' => 'required',
            ], [
                'name'       => 'keys',
                'title'      => 'aba::app.admin.system.keys',
                'type'       => 'select',
                'type'       => 'text',
                'validation' => 'required',
            ],  [
                'name'          => 'active',
                'title'         => 'aba::app.admin.system.status',
                'type'          => 'boolean',
                'validation'    => 'required',
                'channel_based' => false,
                'locale_based'  => true
            ], [
                'name'          => 'sandbox',
                'title'         => 'aba::app.admin.system.sandbox',
                'type'          => 'boolean',
                'validation'    => 'required',
                'channel_based' => false,
                'locale_based'  => true,
            ], [
                'name'    => 'sort',
                'title'   => 'aba::app.admin.system.sort_order',
                'type'    => 'select',
                'options' => [
                    [
                        'title' => '1',
                        'value' => 1,
                    ], [
                        'title' => '2',
                        'value' => 2,
                    ], [
                        'title' => '3',
                        'value' => 3,
                    ], [
                        'title' => '4',
                        'value' => 4,
                    ],
                ],
            ]
        ]
    ]
];
