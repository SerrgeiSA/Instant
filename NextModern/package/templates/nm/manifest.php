<?php
/**
 * Массив опций и свойств шаблона
 */
return [
    // Наследование от шаблона
    'inherit' => ['modern'],
    'title' => 'Next Modern',
    // Авторство
    'author' => [
        'name' => 'GoodMade Team',
        'url'  => 'https://goodmade.ru',
        'help' => 'https://docs.instantcms.ru/manual/settings/templates'
    ],
    // Свойства шаблона
    'properties' => [
        'vendor'                     => 'bootstrap4',
        'style_middleware'           => 'scss',
        'has_options'                => true,
        'has_profile_themes_support' => false,
        'has_profile_themes_options' => false,
        'is_dynamic_layout'          => true,
        'is_backend'                 => false,
        'is_frontend'                => true
    ]
];
