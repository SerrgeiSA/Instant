<?php
/**
 * Опции шаблона New Modern
 * Базовая часть (логотипы, favicon, копирайт и т.д.) наследуется у modern,
 * цветовые блоки modern заменены скинами New Modern.
 */
require_once dirname(__DIR__) . '/modern/options.form.php';

class formNewModernTemplateOptions extends formModernTemplateOptions {

    public $is_tabbed = true;

    /**
     * Список скинов. Ключ — имя скина в SCSS (scss/theme/_nm_skins.scss)
     */
    public static function getSkins() {
        return [
            'ocean'    => LANG_NM_SKIN_OCEAN,
            'emerald'  => LANG_NM_SKIN_EMERALD,
            'sunset'   => LANG_NM_SKIN_SUNSET,
            'berry'    => LANG_NM_SKIN_BERRY,
            'indigo'   => LANG_NM_SKIN_INDIGO,
            'graphite' => LANG_NM_SKIN_GRAPHITE,
            'forest'   => LANG_NM_SKIN_FOREST,
            'wine'     => LANG_NM_SKIN_WINE,
            'sand'     => LANG_NM_SKIN_SAND,
            'night'    => LANG_NM_SKIN_NIGHT
        ];
    }

    /**
     * Шрифты: id => название. Префикс g- — Google Fonts, l- — файлы в шаблоне
     */
    public static function getFonts($with_body = false) {

        $google = [
            'inter' => 'Inter', 'manrope' => 'Manrope', 'golos' => 'Golos Text', 'onest' => 'Onest',
            'montserrat' => 'Montserrat', 'roboto' => 'Roboto', 'roboto-condensed' => 'Roboto Condensed',
            'open-sans' => 'Open Sans', 'pt-sans' => 'PT Sans', 'pt-sans-narrow' => 'PT Sans Narrow',
            'rubik' => 'Rubik', 'nunito' => 'Nunito', 'nunito-sans' => 'Nunito Sans', 'noto-sans' => 'Noto Sans',
            'fira-sans' => 'Fira Sans', 'ibm-plex-sans' => 'IBM Plex Sans', 'raleway' => 'Raleway', 'jost' => 'Jost',
            'exo2' => 'Exo 2', 'comfortaa' => 'Comfortaa', 'ubuntu' => 'Ubuntu', 'mulish' => 'Mulish',
            'source-sans' => 'Source Sans 3', 'commissioner' => 'Commissioner', 'geologica' => 'Geologica',
            'unbounded' => 'Unbounded', 'oswald' => 'Oswald', 'alegreya-sans' => 'Alegreya Sans',
            'arsenal' => 'Arsenal', 'philosopher' => 'Philosopher', 'wix-madefor' => 'Wix Madefor Text',
            'ysabeau' => 'Ysabeau'
        ];
        $google_serif = [
            'lora' => 'Lora', 'merriweather' => 'Merriweather', 'playfair' => 'Playfair Display',
            'pt-serif' => 'PT Serif', 'noto-serif' => 'Noto Serif', 'cormorant-garamond' => 'Cormorant Garamond',
            'roboto-slab' => 'Roboto Slab', 'literata' => 'Literata', 'alice' => 'Alice', 'tinos' => 'Tinos',
            'eb-garamond' => 'EB Garamond', 'vollkorn' => 'Vollkorn'
        ];
        $local = [
            'inter' => 'Inter', 'manrope' => 'Manrope', 'golos' => 'Golos Text', 'onest' => 'Onest',
            'montserrat' => 'Montserrat', 'rubik' => 'Rubik', 'ptsans' => 'PT Sans'
        ];

        $items = [];
        if ($with_body) {
            $items['body'] = LANG_NM_FONT_AS_BODY;
        }
        $items['system'] = LANG_NM_FONT_SYSTEM;
        $items['custom'] = LANG_NM_FONT_CUSTOM;

        $items['optlocal'] = [LANG_NM_FONT_GROUP_LOCAL];
        foreach ($local as $id => $title) { $items['l-' . $id] = $title; }

        $items['optgoogle'] = [LANG_NM_FONT_GROUP_GOOGLE];
        foreach ($google as $id => $title) { $items['g-' . $id] = $title; }

        $items['optgoogleserif'] = [LANG_NM_FONT_GROUP_GOOGLE_SERIF];
        foreach ($google_serif as $id => $title) { $items['g-' . $id] = $title; }

        return $items;
    }

    /**
     * Достаёт поле modern из вкладки по имени (чтобы перенести во вкладку New Modern)
     */
    private function takeField(&$fields, $fieldset, $name) {
        if (empty($fields[$fieldset]['childs'])) {
            return null;
        }
        foreach ($fields[$fieldset]['childs'] as $key => $field) {
            if (is_object($field) && $field->getName() === $name) {
                unset($fields[$fieldset]['childs'][$key]);
                return $field;
            }
        }
        return null;
    }

    private function nmLayoutTabs(&$fields) {

        // Родные поля modern переносим к нашим, лишние убираем
        $gutter    = $this->takeField($fields, 'basic', 'scss:grid-gutter-width');
        $spacer    = $this->takeField($fields, 'basic', 'scss:spacer');
        $font_size = $this->takeField($fields, 'basic', 'scss:font-size-base');
        $br        = $this->takeField($fields, 'basic', 'scss:border-radius');
        $br_lg     = $this->takeField($fields, 'basic', 'scss:border-radius-lg');
        $br_sm     = $this->takeField($fields, 'basic', 'scss:border-radius-sm');
        foreach (['scss:enable-rounded', 'font_type', 'font_string', 'gfont'] as $name) {
            $this->takeField($fields, 'basic', $name);
        }
        foreach ([$br, $br_lg, $br_sm] as $f) {
            if ($f) { $f->visible_depend = ['scss:nm-radius' => ['show' => ['custom']]]; }
        }

        $density_custom = ['scss:nm-density' => ['show' => ['custom']]];

        $layout = [
            new fieldList('scss:nm-layout', [
                'title'   => LANG_NM_LAYOUT,
                'default' => 'adaptive',
                'items'   => [
                    'adaptive' => LANG_NM_LAYOUT_ADAPTIVE,
                    'fixed'    => LANG_NM_LAYOUT_FIXED,
                    'fluid'    => LANG_NM_LAYOUT_FLUID,
                    'boxed'    => LANG_NM_LAYOUT_BOXED
                ]
            ]),
            new fieldString('scss:nm-container-width', [
                'title'   => LANG_NM_CONTAINER_WIDTH,
                'hint'    => LANG_NM_CONTAINER_WIDTH_HINT,
                'default' => '1200px',
                'visible_depend' => ['scss:nm-layout' => ['hide' => ['fluid']]]
            ]),
            new fieldString('scss:nm-container-padding', [
                'title'   => LANG_NM_CONTAINER_PADDING,
                'hint'    => LANG_NM_CSS_SIZE_HINT,
                'default' => '15px'
            ])
        ];
        if ($gutter) { $layout[] = $gutter; }

        $spacing = [
            new fieldList('scss:nm-density', [
                'title'   => LANG_NM_DENSITY,
                'default' => 'normal',
                'items'   => [
                    'compact'  => LANG_NM_DENSITY_COMPACT,
                    'normal'   => LANG_NM_DENSITY_NORMAL,
                    'spacious' => LANG_NM_DENSITY_SPACIOUS,
                    'custom'   => LANG_NM_MANUAL
                ]
            ]),
            new fieldString('scss:nm-widget-gap', [
                'title' => LANG_NM_WIDGET_GAP, 'hint' => LANG_NM_CSS_SIZE_HINT, 'default' => '1.5rem',
                'visible_depend' => $density_custom
            ]),
            new fieldString('scss:nm-widget-padding', [
                'title' => LANG_NM_WIDGET_PADDING, 'hint' => LANG_NM_CSS_SIZE_HINT, 'default' => '1.25rem',
                'visible_depend' => $density_custom
            ]),
            new fieldString('scss:nm-section-y', [
                'title' => LANG_NM_SECTION_Y, 'hint' => LANG_NM_CSS_SIZE_HINT, 'default' => '1.5rem',
                'visible_depend' => $density_custom
            ])
        ];
        if ($spacer) { $spacing[] = $spacer; }

        $radius = [
            new fieldList('scss:nm-radius', [
                'title'   => LANG_NM_RADIUS,
                'default' => 'md',
                'items'   => [
                    'none'   => LANG_NM_RADIUS_NONE,
                    'sm'     => LANG_NM_RADIUS_SM,
                    'md'     => LANG_NM_RADIUS_MD,
                    'lg'     => LANG_NM_RADIUS_LG,
                    'xl'     => LANG_NM_RADIUS_XL,
                    'custom' => LANG_NM_MANUAL
                ]
            ])
        ];
        foreach ([$br, $br_lg, $br_sm] as $f) { if ($f) { $radius[] = $f; } }
        $radius[] = new fieldList('scss:nm-controls', [
            'title'   => LANG_NM_CONTROLS,
            'default' => 'base',
            'items'   => ['base' => LANG_NM_CONTROLS_BASE, 'pill' => LANG_NM_CONTROLS_PILL]
        ]);
        $radius[] = new fieldList('scss:nm-img-radius', [
            'title'   => LANG_NM_IMG_RADIUS,
            'default' => 'same',
            'items'   => ['same' => LANG_NM_IMG_RADIUS_SAME, 'none' => LANG_NM_IMG_RADIUS_NONE]
        ]);

        $fonts = [
            new fieldList('scss:nm-font', [
                'title'   => LANG_NM_FONT,
                'hint'    => LANG_NM_FONT_HINT,
                'default' => 'l-inter',
                'items'   => self::getFonts()
            ]),
            new fieldString('scss:nm-font-custom', [
                'title' => LANG_NM_FONT_CUSTOM_FAMILY,
                'hint'  => LANG_NM_FONT_CUSTOM_HINT,
                'visible_depend' => ['scss:nm-font' => ['show' => ['custom']]]
            ]),
            new fieldList('scss:nm-hfont', [
                'title'   => LANG_NM_HFONT,
                'default' => 'body',
                'items'   => self::getFonts(true)
            ]),
            new fieldString('scss:nm-hfont-custom', [
                'title' => LANG_NM_FONT_CUSTOM_FAMILY,
                'hint'  => LANG_NM_FONT_CUSTOM_HINT,
                'visible_depend' => ['scss:nm-hfont' => ['show' => ['custom']]]
            ]),
            new fieldList('scss:nm-headings-weight', [
                'title'   => LANG_NM_HEADINGS_WEIGHT,
                'default' => '700',
                'items'   => ['500' => '500', '600' => '600', '700' => '700', '800' => '800']
            ])
        ];
        if ($font_size) { $fonts[] = $font_size; }

        $widgets = [
            new fieldList('scss:nm-wt', [
                'title'   => LANG_NM_WT,
                'hint'    => LANG_NM_WT_HINT,
                'default' => 'accent',
                'items'   => self::getWidgetTitleStyles()
            ]),
            new fieldList('scss:nm-wt-size', [
                'title'   => LANG_NM_WT_SIZE,
                'default' => 'md',
                'items'   => ['sm' => LANG_NM_SIZE_SM, 'md' => LANG_NM_SIZE_MD, 'lg' => LANG_NM_SIZE_LG]
            ]),
            new fieldList('scss:nm-card', [
                'title'   => LANG_NM_CARD,
                'default' => 'bordered',
                'items'   => self::getCardStyles()
            ])
        ];

        $lists = [
            new fieldList('nm_list_more', [
                'title'   => LANG_NM_LIST_MORE,
                'hint'    => LANG_NM_LIST_MORE_HINT,
                'default' => 'button',
                'items'   => [
                    'button'      => LANG_NM_LIST_MORE_BUTTON,
                    'auto'        => LANG_NM_LIST_MORE_AUTO,
                    'auto_button' => LANG_NM_LIST_MORE_AUTO_BUTTON,
                    'pages'       => LANG_NM_LIST_MORE_PAGES
                ]
            ]),
            new fieldNumber('nm_list_auto_pages', [
                'title'   => LANG_NM_LIST_AUTO_PAGES,
                'default' => 3,
                'rules'   => [['min', 1], ['max', 50]],
                'visible_depend' => ['nm_list_more' => ['show' => ['auto_button']]]
            ]),
            new fieldCheckbox('nm_list_keep_pages', [
                'title'   => LANG_NM_LIST_KEEP_PAGES,
                'hint'    => LANG_NM_LIST_KEEP_PAGES_HINT,
                'default' => 1,
                'visible_depend' => ['nm_list_more' => ['hide' => ['pages']]]
            ])
        ];

        return [
            'nm_layout' => ['type' => 'fieldset', 'title' => LANG_NM_TAB_LAYOUT, 'childs' => $layout],
            'nm_spacing' => ['type' => 'fieldset', 'title' => LANG_NM_TAB_SPACING, 'childs' => $spacing],
            'nm_radius' => ['type' => 'fieldset', 'title' => LANG_NM_TAB_RADIUS, 'childs' => $radius],
            'nm_fonts' => ['type' => 'fieldset', 'title' => LANG_NM_TAB_FONTS, 'childs' => $fonts],
            'nm_widgets' => ['type' => 'fieldset', 'title' => LANG_NM_TAB_WIDGETS, 'childs' => $widgets],
            'nm_lists' => ['type' => 'fieldset', 'title' => LANG_NM_TAB_LISTS, 'childs' => $lists]
        ];
    }

    public static function getWidgetTitleStyles() {
        return [
            'card'   => LANG_NM_WT_CARD,
            'plain'  => LANG_NM_WT_PLAIN,
            'line'   => LANG_NM_WT_LINE,
            'accent' => LANG_NM_WT_ACCENT,
            'bar'    => LANG_NM_WT_BAR,
            'filled' => LANG_NM_WT_FILLED,
            'lines'  => LANG_NM_WT_LINES,
            'caps'   => LANG_NM_WT_CAPS,
            'tab'    => LANG_NM_WT_TAB
        ];
    }

    public static function getCardStyles() {
        return [
            'bordered' => LANG_NM_CARD_BORDERED,
            'shadow'   => LANG_NM_CARD_SHADOW,
            'flat'     => LANG_NM_CARD_FLAT,
            'clean'    => LANG_NM_CARD_CLEAN
        ];
    }

    public function init() {

        $fields = parent::init();

        // Цвета и гамма modern заменяются скинами
        unset($fields['colors'], $fields['gamma']);

        $custom = [
            'primary' => LANG_NM_C_PRIMARY,
            'accent'  => LANG_NM_C_ACCENT,
            'link'    => LANG_NM_C_LINK,
            'bg'      => LANG_NM_C_BG,
            'surface' => LANG_NM_C_SURFACE,
            'text'    => LANG_NM_C_TEXT,
            'heading' => LANG_NM_C_HEADING,
            'topbar'  => LANG_NM_C_TOPBAR,
            'header'  => LANG_NM_C_HEADER,
            'nav'     => LANG_NM_C_NAV,
            'footer'  => LANG_NM_C_FOOTER
        ];

        $skin_fields = [
            new fieldList('scss:nm-skin', [
                'title'   => LANG_NM_SKIN,
                'hint'    => LANG_NM_SKIN_HINT,
                'default' => 'ocean',
                'items'   => self::getSkins()
            ])
        ];

        $custom_fields = [];
        foreach ($custom as $name => $title) {
            $custom_fields[] = new fieldColor('scss:nm-c-' . $name, [
                'title' => $title
            ]);
        }

        $skin = [
            'nm_skin' => [
                'type'   => 'fieldset',
                'title'  => LANG_NM_TAB_SKIN,
                'childs' => $skin_fields
            ],
            'nm_custom_colors' => [
                'type'   => 'fieldset',
                'title'  => LANG_NM_CUSTOM_COLORS,
                'hint'   => LANG_NM_CUSTOM_COLORS_HINT,
                'childs' => $custom_fields
            ]
        ];

        $layout = $this->nmLayoutTabs($fields);

        // Вкладки New Modern идут первыми
        return $skin + $layout + $fields;
    }

}
