<?php
/**
 * Настройки виджета «Шапка New Modern»
 */
class formWidgetNmheaderOptions extends cmsForm {

    public function init() {

        return [
            [
                'type'  => 'fieldset',
                'title' => LANG_WD_NMHEADER_TAB_LAYOUT,
                'childs' => [
                    new fieldList('options:variant', [
                        'title'   => LANG_WD_NMHEADER_VARIANT,
                        'default' => 'classic',
                        'items'   => ['classic' => LANG_WD_NMHEADER_VARIANT_CLASSIC, 'center' => LANG_WD_NMHEADER_VARIANT_CENTER, 'line' => LANG_WD_NMHEADER_VARIANT_LINE]
                    ]),
                    new fieldList('options:container', [
                        'title'   => LANG_WD_NMHEADER_CONTAINER,
                        'hint'    => LANG_WD_NMHEADER_CONTAINER_HINT,
                        'default' => 'container',
                        'items'   => ['container' => LANG_WD_NMHEADER_CONTAINER_FIXED, 'fluid' => LANG_WD_NMHEADER_CONTAINER_FLUID, 'custom' => LANG_WD_NMHEADER_CONTAINER_CUSTOM]
                    ]),
                    new fieldNumber('options:container_width', [
                        'title'   => LANG_WD_NMHEADER_CONTAINER_WIDTH,
                        'hint'    => LANG_WD_NMHEADER_CONTAINER_WIDTH_HINT,
                        'default' => 1400,
                        'units'   => 'px'
                    ]),
                    new fieldNumber('options:container_pad', [
                        'title'   => LANG_WD_NMHEADER_CONTAINER_PAD,
                        'hint'    => LANG_WD_NMHEADER_CONTAINER_PAD_HINT,
                        'default' => 15,
                        'units'   => 'px'
                    ]),
                    new fieldList('options:burger', [
                        'title'   => LANG_WD_NMHEADER_BURGER,
                        'hint'    => LANG_WD_NMHEADER_BURGER_HINT,
                        'default' => 'mobile',
                        'items'   => ['mobile' => LANG_WD_NMHEADER_BURGER_MOBILE, 'always' => LANG_WD_NMHEADER_BURGER_ALWAYS]
                    ]),
                    new fieldList('options:menu_name', [
                        'title'   => LANG_WD_NMHEADER_MENU,
                        'default' => 'main',
                        'generator' => function () {
                            $items = ['main' => 'main'];
                            try {
                                $model = new cmsModel();
                                $model->localizedOff();
                                $rows = (array)$model->get('menu');
                                if ($rows) { $items = []; }
                                foreach ($rows as $menu) {
                                    $items[$menu['name']] = $menu['title'] . ' (' . $menu['name'] . ')';
                                }
                            } catch (Throwable $e) {
                            }
                            return $items;
                        }
                    ]),
                    new fieldNumber('options:menu_max', [
                        'title'   => LANG_WD_NMHEADER_MENU_MAX,
                        'hint'    => LANG_WD_NMHEADER_MENU_MAX_HINT,
                        'default' => 0
                    ]),
                    new fieldCheckbox('options:show_search', [
                        'title'   => LANG_WD_NMHEADER_SHOW_SEARCH,
                        'default' => true
                    ]),
                    new fieldString('options:search_placeholder', [
                        'title'   => LANG_WD_NMHEADER_SEARCH_PLACEHOLDER,
                        'default' => ''
                    ]),
                    new fieldCheckbox('options:show_user', [
                        'title'   => LANG_WD_NMHEADER_SHOW_USER,
                        'default' => true
                    ]),
                    new fieldCheckbox('options:show_messages', [
                        'title'   => LANG_WD_NMHEADER_SHOW_MESSAGES,
                        'default' => true
                    ]),
                    new fieldList('options:user_menu_name', [
                        'title'   => LANG_WD_NMHEADER_USER_MENU,
                        'hint'    => LANG_WD_NMHEADER_USER_MENU_HINT,
                        'default' => 'personal',
                        'generator' => function () {
                            $items = ['' => LANG_WD_NMHEADER_USER_MENU_BUILTIN];
                            try {
                                $model = new cmsModel();
                                $model->localizedOff();
                                $rows = (array)$model->get('menu');
                                foreach ($rows as $menu) {
                                    $items[$menu['name']] = $menu['title'] . ' (' . $menu['name'] . ')';
                                }
                            } catch (Throwable $e) {
                            }
                            return $items;
                        }
                    ])
                ]
            ],
            [
                'type'  => 'fieldset',
                'title' => LANG_WD_NMHEADER_TAB_MOBILE,
                'childs' => [
                    new fieldList('options:mobile_layout', [
                        'title'   => LANG_WD_NMHEADER_MOBILE_LAYOUT,
                        'hint'    => LANG_WD_NMHEADER_MOBILE_LAYOUT_HINT,
                        'default' => 'two_rows',
                        'items'   => ['two_rows' => LANG_WD_NMHEADER_MOBILE_LAYOUT_TWO, 'one_row' => LANG_WD_NMHEADER_MOBILE_LAYOUT_ONE]
                    ]),
                    new fieldList('options:mobile_menu', [
                        'title'   => LANG_WD_NMHEADER_MOBILE_MENU,
                        'hint'    => LANG_WD_NMHEADER_MOBILE_MENU_HINT,
                        'default' => 'accordion',
                        'items'   => ['accordion' => LANG_WD_NMHEADER_MOBILE_MENU_ACCORDION, 'expanded' => LANG_WD_NMHEADER_MOBILE_MENU_EXPANDED, 'top' => LANG_WD_NMHEADER_MOBILE_MENU_TOP]
                    ])
                ]
            ],
            [
                'type'  => 'fieldset',
                'title' => LANG_WD_NMHEADER_TAB_COLORS,
                'childs' => [
                    new fieldList('options:tb_mode', [
                        'title'   => LANG_WD_NMHEADER_Z_TB_MODE,
                        'hint'    => LANG_WD_NMHEADER_Z_TB_HINT,
                        'default' => 'skin',
                        'items'   => ['skin' => LANG_WD_NMHEADER_CM_SKIN, 'primary' => LANG_WD_NMHEADER_CM_PRIMARY, 'accent' => LANG_WD_NMHEADER_CM_ACCENT, 'bg' => LANG_WD_NMHEADER_CM_BG, 'surface' => LANG_WD_NMHEADER_CM_SURFACE, 'color' => LANG_WD_NMHEADER_CM_COLOR, 'gradient' => LANG_WD_NMHEADER_CM_GRADIENT, 'skin_gradient' => LANG_WD_NMHEADER_CM_SKIN_GRADIENT]
                    ]),
                    new fieldColor('options:tb_color', [
                        'title'   => LANG_WD_NMHEADER_Z_COLOR,
                        'default' => '#0f1b2d',
                        'visible_depend' => ['options:tb_mode' => ['show' => ['color', 'gradient']]]
                    ]),
                    new fieldColor('options:tb_color2', [
                        'title'   => LANG_WD_NMHEADER_Z_COLOR2,
                        'default' => '#1f2a44',
                        'visible_depend' => ['options:tb_mode' => ['show' => ['gradient']]]
                    ]),
                    new fieldNumber('options:tb_angle', [
                        'title'   => LANG_WD_NMHEADER_Z_ANGLE,
                        'default' => 135,
                        'units'   => '°',
                        'visible_depend' => ['options:tb_mode' => ['show' => ['gradient', 'skin_gradient']]]
                    ]),
                    new fieldNumber('options:tb_opacity', [
                        'title'   => LANG_WD_NMHEADER_Z_OPACITY,
                        'hint'    => LANG_WD_NMHEADER_Z_OPACITY_HINT,
                        'default' => 100,
                        'units'   => '%'
                    ]),
                    new fieldList('options:tb_text', [
                        'title'   => LANG_WD_NMHEADER_Z_TEXT,
                        'default' => 'auto',
                        'items'   => ['auto' => LANG_WD_NMHEADER_Z_TEXT_AUTO, 'light' => LANG_WD_NMHEADER_Z_TEXT_LIGHT, 'dark' => LANG_WD_NMHEADER_Z_TEXT_DARK]
                    ]),
                    new fieldList('options:hd_mode', [
                        'title'   => LANG_WD_NMHEADER_Z_HD_MODE,
                        'hint'    => LANG_WD_NMHEADER_Z_HD_HINT,
                        'default' => 'skin',
                        'items'   => ['skin' => LANG_WD_NMHEADER_CM_SKIN, 'primary' => LANG_WD_NMHEADER_CM_PRIMARY, 'accent' => LANG_WD_NMHEADER_CM_ACCENT, 'bg' => LANG_WD_NMHEADER_CM_BG, 'surface' => LANG_WD_NMHEADER_CM_SURFACE, 'color' => LANG_WD_NMHEADER_CM_COLOR, 'gradient' => LANG_WD_NMHEADER_CM_GRADIENT, 'skin_gradient' => LANG_WD_NMHEADER_CM_SKIN_GRADIENT]
                    ]),
                    new fieldColor('options:hd_color', [
                        'title'   => LANG_WD_NMHEADER_Z_COLOR,
                        'default' => '#f7f9fb',
                        'visible_depend' => ['options:hd_mode' => ['show' => ['color', 'gradient']]]
                    ]),
                    new fieldColor('options:hd_color2', [
                        'title'   => LANG_WD_NMHEADER_Z_COLOR2,
                        'default' => '#e6edf5',
                        'visible_depend' => ['options:hd_mode' => ['show' => ['gradient']]]
                    ]),
                    new fieldNumber('options:hd_angle', [
                        'title'   => LANG_WD_NMHEADER_Z_ANGLE,
                        'default' => 135,
                        'units'   => '°',
                        'visible_depend' => ['options:hd_mode' => ['show' => ['gradient', 'skin_gradient']]]
                    ]),
                    new fieldNumber('options:hd_opacity', [
                        'title'   => LANG_WD_NMHEADER_Z_OPACITY,
                        'hint'    => LANG_WD_NMHEADER_Z_OPACITY_HINT,
                        'default' => 100,
                        'units'   => '%'
                    ]),
                    new fieldList('options:hd_text', [
                        'title'   => LANG_WD_NMHEADER_Z_TEXT,
                        'default' => 'auto',
                        'items'   => ['auto' => LANG_WD_NMHEADER_Z_TEXT_AUTO, 'light' => LANG_WD_NMHEADER_Z_TEXT_LIGHT, 'dark' => LANG_WD_NMHEADER_Z_TEXT_DARK]
                    ]),
                    new fieldList('options:nv_mode', [
                        'title'   => LANG_WD_NMHEADER_Z_NV_MODE,
                        'hint'    => LANG_WD_NMHEADER_Z_NV_HINT,
                        'default' => 'skin',
                        'items'   => ['skin' => LANG_WD_NMHEADER_CM_SKIN, 'primary' => LANG_WD_NMHEADER_CM_PRIMARY, 'accent' => LANG_WD_NMHEADER_CM_ACCENT, 'bg' => LANG_WD_NMHEADER_CM_BG, 'surface' => LANG_WD_NMHEADER_CM_SURFACE, 'color' => LANG_WD_NMHEADER_CM_COLOR, 'gradient' => LANG_WD_NMHEADER_CM_GRADIENT, 'skin_gradient' => LANG_WD_NMHEADER_CM_SKIN_GRADIENT]
                    ]),
                    new fieldColor('options:nv_color', [
                        'title'   => LANG_WD_NMHEADER_Z_COLOR,
                        'default' => '#1d6fe0',
                        'visible_depend' => ['options:nv_mode' => ['show' => ['color', 'gradient']]]
                    ]),
                    new fieldColor('options:nv_color2', [
                        'title'   => LANG_WD_NMHEADER_Z_COLOR2,
                        'default' => '#4f46e5',
                        'visible_depend' => ['options:nv_mode' => ['show' => ['gradient']]]
                    ]),
                    new fieldNumber('options:nv_angle', [
                        'title'   => LANG_WD_NMHEADER_Z_ANGLE,
                        'default' => 135,
                        'units'   => '°',
                        'visible_depend' => ['options:nv_mode' => ['show' => ['gradient', 'skin_gradient']]]
                    ]),
                    new fieldNumber('options:nv_opacity', [
                        'title'   => LANG_WD_NMHEADER_Z_OPACITY,
                        'hint'    => LANG_WD_NMHEADER_Z_OPACITY_HINT,
                        'default' => 100,
                        'units'   => '%'
                    ]),
                    new fieldList('options:nv_text', [
                        'title'   => LANG_WD_NMHEADER_Z_TEXT,
                        'default' => 'auto',
                        'items'   => ['auto' => LANG_WD_NMHEADER_Z_TEXT_AUTO, 'light' => LANG_WD_NMHEADER_Z_TEXT_LIGHT, 'dark' => LANG_WD_NMHEADER_Z_TEXT_DARK]
                    ]),
                    new fieldCheckbox('options:blur', [
                        'title'   => LANG_WD_NMHEADER_BLUR,
                        'hint'    => LANG_WD_NMHEADER_BLUR_HINT,
                        'default' => false
                    ])
                ]
            ],
            [
                'type'  => 'fieldset',
                'title' => LANG_WD_NMHEADER_TAB_LOGO,
                'childs' => [
                    new fieldFile('options:logo_svg', [
                        'title'   => LANG_WD_NMHEADER_LOGO_SVG,
                        'hint'  => LANG_WD_NMHEADER_LOGO_SVG_HINT,
                        'options' => ['extensions' => 'svg']
                    ]),
                    new fieldFile('options:logo_mobile_svg', [
                        'title'   => LANG_WD_NMHEADER_LOGO_MOBILE_SVG,
                        'hint'  => LANG_WD_NMHEADER_LOGO_MOBILE_SVG_HINT,
                        'options' => ['extensions' => 'svg']
                    ]),
                    new fieldImage('options:logo', [
                        'title'   => LANG_WD_NMHEADER_LOGO,
                        'hint'  => LANG_WD_NMHEADER_LOGO_HINT,
                        'options' => ['sizes' => ['original']]
                    ]),
                    new fieldImage('options:logo_mobile', [
                        'title'   => LANG_WD_NMHEADER_LOGO_MOBILE,
                        'hint'  => LANG_WD_NMHEADER_LOGO_MOBILE_HINT,
                        'options' => ['sizes' => ['original']]
                    ]),
                    new fieldString('options:logo_path', [
                        'title'   => LANG_WD_NMHEADER_LOGO_PATH,
                        'hint'  => LANG_WD_NMHEADER_LOGO_PATH_HINT,
                        'default' => ''
                    ]),
                    new fieldString('options:logo_mobile_path', [
                        'title'   => LANG_WD_NMHEADER_LOGO_MOBILE_PATH,
                        'hint'  => LANG_WD_NMHEADER_LOGO_MOBILE_PATH_HINT,
                        'default' => ''
                    ]),
                    new fieldString('options:logo_text', [
                        'title'   => LANG_WD_NMHEADER_LOGO_TEXT,
                        'hint'  => LANG_WD_NMHEADER_LOGO_TEXT_HINT
                    ]),
                    new fieldNumber('options:logo_height', [
                        'title'   => LANG_WD_NMHEADER_LOGO_H,
                        'default' => 48,
                        'units'   => 'px'
                    ]),
                    new fieldNumber('options:logo_max_width', [
                        'title'   => LANG_WD_NMHEADER_LOGO_MAXW,
                        'default' => 240,
                        'units'   => 'px'
                    ]),
                    new fieldNumber('options:logo_height_mobile', [
                        'title'   => LANG_WD_NMHEADER_LOGO_H_MOBILE,
                        'default' => 36,
                        'units'   => 'px'
                    ]),
                    new fieldNumber('options:logo_height_sticky', [
                        'title'   => LANG_WD_NMHEADER_LOGO_H_STICKY,
                        'default' => 36,
                        'units'   => 'px'
                    ])
                ]
            ],
            [
                'type'  => 'fieldset',
                'title' => LANG_WD_NMHEADER_TAB_TOPBAR,
                'childs' => [
                    new fieldCheckbox('options:show_topbar', [
                        'title'   => LANG_WD_NMHEADER_SHOW_TOPBAR,
                        'default' => false
                    ]),
                    new fieldString('options:topbar_text', [
                        'title'   => LANG_WD_NMHEADER_TOPBAR_TEXT
                    ]),
                    new fieldText('options:topbar_links', [
                        'title'   => LANG_WD_NMHEADER_TOPBAR_LINKS,
                        'hint'  => LANG_WD_NMHEADER_TOPBAR_LINKS_HINT
                    ])
                ]
            ],
            [
                'type'  => 'fieldset',
                'title' => LANG_WD_NMHEADER_TAB_STICKY,
                'childs' => [
                    new fieldCheckbox('options:sticky', [
                        'title'   => LANG_WD_NMHEADER_STICKY,
                        'hint'    => LANG_WD_NMHEADER_STICKY_HINT,
                        'default' => false
                    ]),
                    new fieldCheckbox('options:sticky_mobile', [
                        'title'   => LANG_WD_NMHEADER_STICKY_MOBILE,
                        'default' => false
                    ]),
                    new fieldCheckbox('options:sticky_compact', [
                        'title'   => LANG_WD_NMHEADER_STICKY_COMPACT,
                        'default' => true
                    ]),
                    new fieldNumber('options:sticky_offset', [
                        'title'   => LANG_WD_NMHEADER_STICKY_OFFSET,
                        'hint'    => LANG_WD_NMHEADER_STICKY_OFFSET_HINT,
                        'default' => 0,
                        'units'   => 'px'
                    ])
                ]
            ]
        ];
    }
}
