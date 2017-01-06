<?php
/**
 * Pages which require login
 * User: marty
 * Date: 13/12/16
 * Time: 08:25
 */

return [
    'admin' => [
        'index'
    ],
    'joueurs' => [
        'index',
        'add',
        'edit',
        'delete',
        'add_sucess',
        'get'
    ],
    'matchs' => [
        'index',
        'get',
        'add',
        'selection',
        'edit',
        'delete',
        'remove'
    ]
];