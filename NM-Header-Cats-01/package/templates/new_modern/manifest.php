<?php
/**
 * New Modern — манифест шаблона
 * Наследуется от modern: всё, чего нет в New Modern, берётся из modern
 */
return [
    // Порядок важен: сначала ищем в modern, затем в admincoreui
    'inherit' => ['admincoreui', 'modern'],
    'title'   => 'New Modern',
    'author'  => [
        'name' => 'New Modern',
        'url'  => '',
        'help' => ''
    ],
    'properties' => [
        'vendor'                     => 'bootstrap4',
        'style_middleware'           => 'scss',
        'has_options'                => true,
        'has_profile_themes_support' => false,
        'has_profile_themes_options' => false,
        'is_dynamic_layout'          => true,
        'is_backend'                 => false,
        'is_frontend'                => true,
        'html_attr'                  => [
            'class' => 'min-vh-100'
        ]
    ]
];
