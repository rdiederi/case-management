<?php 

//This file was generated for you with lots of love from teamgeek

$moduleVardefs['lt_case'] = [

    'label' => 'Case',
    'detail_view_class' => 'CaseDetailView',
    'edit_view_class' => 'CaseEditView',
    'related_modules' => [],
    /* Add all the fields for your module/table below */
    'fields' => [
        /*Any definitions added to the `id` field will be ignored, leave it as an empty array*/
        'id' => [],
         //Add more fields here
    ],
    'detail_view_fields' => [
        ['name', 'description'],
    ],
    'edit_view_fields' => [
        ['name', 'description'],
    ],
    'list_view_fields' => ['name', 'description'],
];