<?php 

//This file was generated for you with lots of love from teamgeek

$moduleVardefs['lt_customer'] = [

    'label' => 'Customer',
    'detail_view_class' => 'CustomerDetailView',
    'edit_view_class' => 'CustomerEditView',
    'related_modules' => [
        'lt_policy' => [
            'relationship_type' => 'one-to-many',
            'relation_key_rhs' => 'customer_id',
        ]
    ],
    /* Add all the fields for your module/table below */
    'fields' => [
        /*Any definitions added to the `id` field will be ignored, leave it as an empty array*/
        'id' => [],
        'first_name' => [
            'type' => 'string',
            'null' => false,
            'length' => 255,
            'default' => ''
        ],
        'last_name' => [
            'type' => 'string',
            'null' => false,
            'length' => 255,
            'default' => ''
        ],
        'id_number' => [
            'type' => 'string',
            'null' => false,
            'length' => 15,
            'default' => ''
        ],
        'phone' => [
            'type' => 'string',
            'null' => true,
            'length' => 15,
            'default' => ''
        ],

    ],
    'detail_view_fields' => [
        ['first_name', 'last_name'],
        ['id_number', 'phone'],
    ],
    'edit_view_fields' => [
        ['first_name', 'last_name'],
        ['id_number', 'phone'],
    ],
    'list_view_fields' => ['first_name', 'last_name', 'description'],
];