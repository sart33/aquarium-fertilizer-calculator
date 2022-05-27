<?php


namespace App\Config;


class Routes
{

    /**
     * @return \string[][]
     */
    public static function routingTable()
    {
        return [
            'index' => ['aquarium@index', '', '?', 'Aquarium'],
            'page' => ['aquarium@index', 'param', '?', 'Aquarium'],
            '' => ['aquarium@index', '', '?', 'Aquarium'],
            'diary' => ['aquarium@diary', '', '?', ''],
            'view' => ['aquarium@view', 'param'],
            'edit' => ['aquarium@edit', 'param'],
            'update' => ['aquarium@update', 'param'],
            'create' => ['aquarium@create', '', '?', 'Make a entry'],
            'store' => ['aquarium@store', ''],
            'added-in-week' => ['aquarium@addedInWeek', 'param'],
            'this-week' => ['aquarium@thisWeek', 'param'],
            'by-month' => ['aquarium@byMonth', ''],
            'this-month' => ['aquarium@thisMonth', 'param'],
            'charts' => ['aquarium@charts', '', '?', 'Charts'],
            'delete' => ['aquarium@delete', 'param'],
            'user/index' => ['user@index', '', '?'],
            'user/register' => ['user@register', '', '', 'Sign Up'],
            'user/login' => ['user@login', '', '', 'Sign In'],
            'user/logout' => ['user@logout', '', '', 'Log Out'],
            'user/account' => ['user@account', 'param'],
            'verification' =>['user@verification', '', '?'],
            'webform' => ['webform@form', ''],
            'webform-callback' => ['webform@store', '']
        ];

    }
}