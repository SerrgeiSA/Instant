<?php
/**
 * Опции шаблона
 * https://docs.instantcms.ru/dev/templates/options
 */
class formNmTemplateOptions extends cmsForm {

    public $is_tabbed = true;

    public function init() {
		
        cmsCore::loadTemplateLanguage('modern');
        $template = cmsTemplate::getInstance();

		
		$ctype_themes_list = $template->getAvailableTemplatesFiles('content', 'default_list_nm*.tpl.php');
        if (!$ctype_themes_list) { return []; }

        $nm_themes_list = [];

        foreach($ctype_themes_list as $file => $file_title){

            preg_match('/^default_list_([a-z0-9_\-]*)$/i', $file, $matches);

            if (!$matches){
                $nm_themes_list[''] = $file_title;
            } else {
                $nm_themes_list[$matches[1]] = $file_title;
            }
        }
        
			
			
        $gamma = [
            '$white'    => LANG_MODERN_C_WHITE,
            '$gray-100' => LANG_MODERN_C_GRAY100,
            '$gray-200' => LANG_MODERN_C_GRAY200,
            '$gray-300' => LANG_MODERN_C_GRAY300,
            '$gray-400' => LANG_MODERN_C_GRAY400,
            '$gray-500' => LANG_MODERN_C_GRAY500,
            '$gray-600' => LANG_MODERN_C_GRAY600,
            '$gray-700' => LANG_MODERN_C_GRAY700,
            '$gray-800' => LANG_MODERN_C_GRAY800,
            '$gray-900' => LANG_MODERN_C_GRAY900,
            '$black'    => LANG_MODERN_C_BLACK,
            '$blue'     => LANG_MODERN_C_BLUE,
            '$indigo'   => LANG_MODERN_C_INDIGO,
            '$purple'   => LANG_MODERN_C_PURPLE,
            '$pink'     => LANG_MODERN_C_PINK,
            '$red'      => LANG_MODERN_C_RED,
            '$orange'   => LANG_MODERN_C_ORANGE,
            '$yellow'   => LANG_MODERN_C_YELLOW,
            '$green'    => LANG_MODERN_C_GREEN,
            '$teal'     => LANG_MODERN_C_TEAL,
            '$cyan'     => LANG_MODERN_C_CYAN
        ];

        $gamma_default = [
            '$white'    => '#ffffff',
            '$gray-100' => '#f8f9fa',
            '$gray-200' => '#eeeeee',
            '$gray-300' => '#dee2e6',
            '$gray-400' => '#cccccc',
            '$gray-500' => '#adb5bd',
            '$gray-600' => '#888888',
            '$gray-700' => '#495057',
            '$gray-800' => '#333333',
            '$gray-900' => '#222222',
            '$black'    => '#000000',
            '$blue'     => '#008cba',
            '$indigo'   => '#6610f2',
            '$purple'   => '#6f42c1',
            '$pink'     => '#e83e8c',
            '$red'      => '#f04124',
            '$orange'   => '#fd7e14',
            '$yellow'   => '#e99002',
            '$green'    => '#43ac6a',
            '$teal'     => '#20c997',
            '$cyan'     => '#5bc0de'
        ];

        $theme_colors = [
            '$body-bg'      => LANG_MODERN_THEME_BGCOLOR,
            '$body-color'   => LANG_MODERN_THEME_BCOLOR,
            '$link-color'   => LANG_MODERN_THEME_LINK_COLOR,
            '$header-bg'    => LANG_MODERN_THEME_HBCOLOR,
            '$header-color' => LANG_MODERN_THEME_HCOLOR,
            '$footer-bg'    => LANG_MODERN_THEME_FBCOLOR,
            '$footer-color' => LANG_MODERN_THEME_FCOLOR,
            '$primary'      => LANG_MODERN_C_PRIMARY,
            '$secondary'    => LANG_MODERN_C_SECONDARY,
            '$success'      => LANG_MODERN_C_SUCCESS,
            '$info'         => LANG_MODERN_C_INFO,
            '$warning'      => LANG_MODERN_C_WARNING,
            '$danger'       => LANG_MODERN_C_DANGER,
            '$light'        => LANG_MODERN_C_LIGHT,
            '$dark'         => LANG_MODERN_C_DARK
        ];

        $theme_colors_default = [
            'header-bg'    => '$purple',
            'header-color' => '$white',
            'footer-bg'    => '$gray-900',
            'footer-color' => '$gray-600',
            'body-bg'      => '$white',
            'body-color'   => '$gray-800',
            'link-color'   => '$blue',
            'primary'      => '$blue',
            'secondary'    => '$gray-600',
            'success'      => '$green',
            'info'         => '$cyan',
            'warning'      => '$yellow',
            'danger'       => '$red',
            'light'        => '$gray-100',
            'dark'         => '$gray-900'
        ];
		
		

            
		
        $nm_colors = [
			'$nm-main-text-color'   => 'Цвет текста на сайте по умолчанию',
            '$nm-main-links-color'   => 'Цвет ссылок на сайте по умолчанию',
            '$nm-main-links-color-hover'   => 'Цвет ссылок при наведении',			
            '$nm-main-links-color-on-dark'   => 'Цвет ссылок на тёмном фоне',
            '$nm-main-links-color-hover-on-dark'   => 'Цвет ссылок на тёмном фоне при наведении',
			
            '$nm-main-links-color-on-primary'   => 'Цвет ссылок на primary фоне',
            '$nm-main-links-color-hover-on-primary'   => 'Цвет ссылок на primary фоне при наведении',
		
        
            
			'$button-primary-color-on-primary-bg'   => 'Цвет кнопки на главном фоне',
            '$button-primary-text-color-on-primary-bg'   => 'Цвет текста кнопки на главном фоне',
			
            '$nm-border-color-on-dark'   => 'Разделитель для блока с тёмным фоном',
            '$nm-border-color-on-white'   => 'Разделитель для блока с белом фоном',
			
            '$nm-list-card-on-dark-links-color'   => 'Карточки: цвет ссылок на тёмном фоне',
            '$nm-list-card-on-dark-links-color-hover'   => 'Карточки: цвет ссылок на тёмном фоне при наведении',	
			
        ];

        $nm_colors_default = [
		
			'$nm-main-text-color'   => 'rgba(33, 37, 41, 1)',
            '$nm-main-links-color'   => 'rgba(32, 22, 84, 1)',
            '$nm-main-links-color-hover'   => 'rgba(9, 123, 237, 1)',		
			
			'$nm-main-links-color-on-dark'   => 'rgba(240, 240, 240, 1)',
            '$nm-main-links-color-hover-on-dark'   => 'rgba(0, 123, 255, 1)',
			
			'$nm-main-links-color-on-primary'   => 'rgba(255, 255, 255, 1)',
            '$nm-main-links-color-hover-on-primary'   => 'rgba(255, 255, 255, 0.8)',
		
            '$nm-main-top-text-color'   => 'rgba(255, 255, 255, 0.4)',
            '$nm-main-top-links-color'   => 'rgba(255, 255, 255, 0.4)',
            '$nm-main-top-links-hover-color'   => 'rgba(255, 255, 255, 1)',
            '$button-primary-color-on-primary-bg'   => 'rgba(255, 192, 0, 1)',
            '$button-primary-text-color-on-primary-bg'   => 'rgba(0,0,0,1)',
			
            '$nm-border-color-on-dark'   => 'rgba(255, 255, 255, 0.2)',
            '$nm-border-color-on-white'   => 'rgba(0, 0, 0, 0.1)',
			      
			'$nm-list-card-on-dark-links-color'   => 'rgba(255, 255, 255, 1)',
            '$nm-list-card-on-dark-links-color-hover'   => 'rgba(9, 123, 237, 1)',
	
        ];
		
		
				
        $nm_colors_hint = [
		
        			
			'$nm-main-text-color'   => '.nm-text-color - задаёт цвет',
            '$nm-main-links-color'   => 
			'.nm-link-color - задаёт цвет<br/>
			.nm-links-color - задаёт цвет дочерних ссылок',
            '$nm-main-links-color-hover'   => '',			
            '$nm-main-links-color-on-dark'   => 
			'.link-on-dark  - задаёт цвет<br/>
			.links-on-dark  - задаёт цвет дочерних ссылок',
            '$nm-main-links-color-hover-on-dark'   => '',
			
			 '$nm-main-links-color-on-primary'   => '.link-on-primary  - задаёт цвет<br/>
			.links-on-primary  - задаёт цвет дочерних ссылок',
            '$nm-main-links-color-hover-on-primary'   => '',
			
	
			'$button-primary-color-on-primary-bg'   => '',
            '$button-primary-text-color-on-primary-bg'   => '',
			
            '$nm-border-color-on-dark'   => 
			'.nm-border-on-dark - задаёт контур с выбранным цветом<br/>
			.nm-border-top-on-dark - задаёт контур сверху<br/>
			.nm-border-bottom-on-dark - задаёт контур снизу',
            '$nm-border-color-on-white'   => 
			'.nm-border-on-white - задаёт контур с выбранным цветом<br/>
			.nm-border-top-on-white - задаёт контур сверху<br/>
			.nm-border-bottom-on-white - задаёт контур снизу',
			
            '$nm-list-card-on-dark-links-color'   => '',
            '$nm-list-card-on-dark-links-color-hover'   => '',	
			
        ];

		
		


        $exists_vars = array_keys($theme_colors + $gamma);
        foreach (['$enable-rounded', '$border-radius', '$border-radius-lg', '$border-radius-sm', '$enable-shadows', '$enable-gradients', '$enable-responsive-font-sizes', '$grid-gutter-width', '$spacer', '$font-size-base'] as $fields_var) {
            $exists_vars[] = $fields_var;
        }

        $fields = array(

            'basic' => array(
                'type' => 'fieldset',
                'title' => LANG_CP_BASIC,
                'childs' => array(

                    new fieldString('owner_name', array(
                        'title' => LANG_MODERN_THEME_COPYRIGHT
                    )),

                    new fieldString('owner_url', array(
                        'title' => LANG_MODERN_THEME_COPYRIGHT_URL,
                        'hint' => LANG_MODERN_THEME_COPYRIGHT_URL_HINT
                    )),

                    new fieldString('owner_year', array(
                        'title' => LANG_MODERN_THEME_COPYRIGHT_YEAR,
                        'hint' => LANG_MODERN_THEME_COPYRIGHT_YEAR_HINT
                    )),

                    new fieldCheckbox('show_top_btn', array(
                        'title' => LANG_MODERN_THEME_ENABLE_TOPBTN,
                        'default' => 1
                    )),

                    new fieldCheckbox('show_cookiealert', array(
                        'title' => LANG_MODERN_THEME_SHOW_COOKIEALERT
                    )),

                    new fieldString('cookiealert_text', array(
                        'title' => LANG_MODERN_THEME_COOKIEALERT_TEXT,
                        'is_clean_disable' => true,
                        'visible_depend' => array('show_cookiealert' => array('show' => array('1')))
                    )),

                    new fieldCheckbox('scss:enable-rounded', array(
                        'title' => LANG_MODERN_THEME_ENABLE_ROUNDED,
                        'default' => 1
                    )),

                    new fieldString('scss:border-radius', array(
                        'title' => LANG_MODERN_THEME_ROUNDED_BASE,
                        'default' => '.25rem',
                        'visible_depend' => array('scss:enable-rounded' => array('show' => array('1')))
                    )),

                    new fieldString('scss:border-radius-lg', array(
                        'title' => LANG_MODERN_THEME_ROUNDED_BASE_LG,
                        'default' => '.3rem',
                        'visible_depend' => array('scss:enable-rounded' => array('show' => array('1')))
                    )),

                    new fieldString('scss:border-radius-sm', array(
                        'title' => LANG_MODERN_THEME_ROUNDED_BASE_SM,
                        'default' => '.2rem',
                        'visible_depend' => array('scss:enable-rounded' => array('show' => array('1')))
                    )),

                    new fieldCheckbox('scss:enable-shadows', array(
                        'title' => LANG_MODERN_THEME_ENABLE_SHADOWS
                    )),

                    new fieldCheckbox('scss:enable-gradients', array(
                        'title' => LANG_MODERN_THEME_ENABLE_GRADIENTS
                    )),

                    new fieldCheckbox('scss:enable-responsive-font-sizes', array(
                        'title' => LANG_MODERN_THEME_ENABLE_RFS,
                        'default' => 1
                    )),

                    new fieldCheckbox('scss:enable-modal-blur', array(
                        'title' => LANG_MODERN_THEME_ENABLE_MODAL_BLUR,
                        'default' => 1
                    )),

                    new fieldString('scss:grid-gutter-width', array(
                        'title' => LANG_MODERN_THEME_GRID_GUTTER_W,
                        'default' => '30px'
                    )),

					new fieldList('font_type', array(
                        'title'   => LANG_MODERN_FONT_TYPE,
                        'default' => '',
                        'items'   => array(
                            '' => LANG_MODERN_FONT_TYPE_STR,
							'gfont' => 'Google'
                        )
                    )),

                    new fieldString('font_string', array(
                        'title' => LANG_MODERN_FONT_STRING,
                        'default' => '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"',
                        'visible_depend' => array('font_type' => array('show' => array('')))
                    )),

					new fieldList('gfont', array(
                        'title'   => LANG_MODERN_FONT_GOOGLE,
                        'default' => 'Roboto',
                        'visible_depend' => array('font_type' => array('show' => array('gfont'))),
                        'items'   => array(
							'Alegreya'                  => 'Alegreya',
                            'Alegreya+Sans'             => 'Alegreya Sans',
                            'Alegreya+Sans+SC'          => 'Alegreya Sans SC',
                            'Arimo'                     => 'Arimo',
                            'Arsenal'                   => 'Arsenal',
                            'Cormorant'                 => 'Cormorant',
                            'Cormorant+Garamond'        => 'Cormorant Garamond',
                            'Cormorant+Infant'          => 'Cormorant Infant',
                            'Cuprum'                    => 'Cuprum',
                            'EB+Garamond'               => 'EB Garamond',
                            'Fira+Sans+Extra+Condensed' => 'Fira Sans Extra Condensed',
                            'Lora'                      => 'Lora',
                            'Montserrat'                => 'Montserrat',
                            'Montserrat+Alternates'     => 'Montserrat Alternates',
                            'Noto+Serif'                => 'Noto Serif',
                            'PT+Serif'                  => 'PT Serif',
                            'Philosopher'               => 'Philosopher',
                            'Roboto'                    => 'Roboto',
                            'Roboto+Condensed'          => 'Roboto+Condensed',
                            'Scada'                     => 'Scada',
                            'Tinos'                     => 'Tinos',
                            'Vollkorn'                  => 'Vollkorn',
                            'Open+Sans'                 => 'Open Sans'
                        )
                    )),

                    new fieldString('scss:font-size-base', array(
                        'title' => LANG_MODERN_THEME_BASE_FS,
                        'default' => '1rem'
                    )),

                    new fieldString('scss:spacer', array(
                        'title' => LANG_MODERN_THEME_BASE_SPACER,
                        'default' => '1rem'
                    )),

                    new fieldString('scss:avatar-inlist-size', array(
                        'title' => LANG_MODERN_THEME_AVATAR_INLIST_SIZE,
                        'hint' => LANG_MODERN_THEME_AVATAR_INLIST_SIZE_HINT,
                        'default' => '64px'
                    )),

                    new fieldList('pagination_template', array(
                        'title' => LANG_MODERN_THEME_PAGINATION_TPL,
                        'default' => 'pagination',
                        'generator' => function($item) {
                            return cmsTemplate::getInstance()->getAvailableTemplatesFiles('assets/ui', 'pagination*.tpl.php', 'modern');
                        }
                    )),

					new fieldCheckbox('js_print_head', array(
                        'title'   => LANG_MODERN_JS_PRINT_HEAD,
                        'default' => false
                    ))

                )
            ),

            'logo' => array(
                'type' => 'fieldset',
                'title' => LANG_PAGE_LOGO,
                'childs' => array(

                    new fieldImage('logo', array(
                        'title' => LANG_MODERN_LOGO,
                        'hint' => LANG_MODERN_RASTR_HINT,
                        'context_params' => [
                            'target_controller' => 'admin',
                            'target_subject'    => 'theme/nm',
                            'target_id'         => null
                        ],
                        'options' => array(
                            'sizes' => array('small', 'original')
                        )
                    )),

                    new fieldFile('logo_svg', array(
                        'title' => LANG_MODERN_LOGO_SVG,
                        'options' => [
                            'extensions' => 'svg'
                        ]
                    )),

                    new fieldImage('logo_small', array(
                        'title' => LANG_MODERN_LOGO_SMALL,
                        'hint' => LANG_MODERN_LOGO_SMALL_HINT.LANG_MODERN_RASTR_HINT,
                        'context_params' => [
                            'target_controller' => 'admin',
                            'target_subject'    => 'theme/nm',
                            'target_id'         => null
                        ],
                        'options' => array(
                            'sizes' => array('small', 'original')
                        )
                    )),

                    new fieldFile('logo_small_svg', array(
                        'title' => LANG_MODERN_LOGO_SMALL_SVG,
                        'options' => [
                            'extensions' => 'svg'
                        ]
                    )),
					
					
					new fieldString('scss:nm-header-logo-height', [
                        'title'   => 'Высота(макс) лого',
                        'default' => '25px'
                    ]),
					new fieldString('scss:nm-header-logo-height-mob', [
                        'title'   => 'Высота(макс) лого для мобильных',
                        'default' => '25px'
                    ]),	
					
					new fieldString('scss:nm-header-logo-width', [
                        'title'   => 'Ширина(макс) лого',
                        'default' => '200px'
                    ]),
					new fieldString('scss:nm-header-logo-width-mob', [
                        'title'   => 'Ширина(макс) лого для мобильных',
                        'default' => '200px'
                    ]),
					

                )
            ),

            'favicon' => array(
                'type' => 'fieldset',
                'title' => LANG_MODERN_FAVICON,
                'childs' => array(

                    new fieldFile('favicon', array(
                        'title' => LANG_MODERN_FAVICON_FILE,
                        'options' => [
                            'extensions' => 'ico,svg'
                        ]
                    )),

                    new fieldHtml('favicon_head_html', [
                        'title'   => LANG_MODERN_FAVICON_HEAD,
                        'options' => ['editor' => 'ace']
                    ])
                )
            ),

            'colors' => array(
                'type' => 'fieldset',
                'title' => LANG_MODERN_THEME_COLORS,
                'childs' => []
            ),

            'gamma' => array(
                'type' => 'fieldset',
                'title' => LANG_MODERN_THEME_GAMMA,
                'childs' => []
            ),

            'bs_vars' => array(
                'type' => 'fieldset',
                'title' => 'Bootstrap',
                'childs' => array(
                    new fieldList('vars', array(
                        'title' => LANG_MODERN_VARS,
                        'hint'  => LANG_EVENTS_MANAGEMENT_HINT,
                        'is_multiple'  => true,
                        'single_select' => true,
                        'dynamic_list' => true,
                        'select_title' => LANG_MODERN_VARS_SELECT,
                        'multiple_keys' => array(
                            'name' => 'field', 'value' => 'field_value'
                        ),
                        'generator' => function($item) use ($exists_vars){
                            $var_file = cmsTemplate::getInstance()->getTplFilePath('scss/bootstrap/_variables.scss');

                            $data = file_get_contents($var_file);

                            preg_match_all('#^(\$[a-z\-0-9]+)\s?\:\s+(.+);#mi', $data, $var_list);

                            $vars = [];
                            if(!empty($var_list[1])){
                                foreach ($var_list[1] as $key => $name) {
                                    if(in_array($name, $exists_vars)){
                                        continue;
                                    }
                                    $value = trim(str_replace('!default', '', $var_list[2][$key]));
                                    $vars[str_replace('$', '', $name)] = [
                                        'title' => $name,
                                        'data' => ['placeholder' => $value]
                                    ];
                                }
                                asort($vars);
                            }

                            return $vars;
                        }
                    ))
                )
            ),
			
			
			
			
			'nm_styles' => array(
                'type' => 'fieldset',
                'title' => 'NM',
                'childs' => [
				
						
		
				 
				new fieldFontfile('nm_font_file', [
                        'title'   => 'Основной шрифт сайта',
                    ]),				
				 
				new fieldString('nm_font_alts', [
                        'title'   => 'Альтернативные шрифты',						
                        'default'   => 'Roboto Condensed, Roboto, Arial, sans-serif',
						'hint' => 'Укажите альтернативный список из одного или нескольких названий семейства шрифтов c гладкими окончаниями',
                    ]), 
					
						
				 
				new fieldFontfile('nm_font_tags_file', [
                        'title'   => '<br/>Дополнительный шрифт',
                    ]),				
				 
				new fieldString('nm_font_tags_list', [
                        'title'   => 'Перечень тегов и классов для применения дополнительного шрифта',
						'default'   => 'h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6'
                    ]), 
					
					

	
			    new fieldString('nm-h1-size', [
                        'title'   => '<br/>Размер шрифта для h1',
                        'default' => '2.5rem'
                    ]),					
			    new fieldString('nm-h1-weight', [
                        'title'   => 'Жирность шрифта',
                        'default' => '500',						
               'visible_depend' => array('nm-h1-size' => array('hide' => array('')))			   
                    ]),				

					
			    new fieldString('nm-h2-size', [
                        'title'   => 'Размер шрифта для h2',
                        'default' => '2rem'
                    ]),											
			    new fieldString('nm-h2-weight', [
                        'title'   => 'Жирность шрифта',
                        'default' => '400',						
               'visible_depend' => array('nm-h1-size' => array('hide' => array(''))),
			    ]),	
			   
			   
			    new fieldString('nm-h3-size', [
                        'title'   => 'Размер шрифта для h3',
                        'default' => '1.70rem'
                    ]),						
			    new fieldString('nm-h3-weight', [
                        'title'   => 'Жирность шрифта',
                        'default' => '400',						
               'visible_depend' => array('nm-h1-size' => array('hide' => array(''))),
			    ]),	


			   
			    new fieldString('nm-h4-size', [
                        'title'   => 'Размер шрифта для h4',
                        'default' => '1.5rem'
                    ]),						
			    new fieldString('nm-h4-weight', [
                        'title'   => 'Жирность шрифта',
                        'default' => '400',						
               'visible_depend' => array('nm-h1-size' => array('hide' => array(''))),
			    ]),	

			   
			    new fieldString('nm-h5-size', [
                        'title'   => 'Размер шрифта для h5',
                        'default' => '19px'
                    ]),						
			    new fieldString('nm-h5-weight', [
                        'title'   => 'Жирность шрифта',
                        'default' => '400',						
               'visible_depend' => array('nm-h1-size' => array('hide' => array(''))),
			    ]),	

			   
			    new fieldString('nm-h6-size', [
                        'title'   => 'Размер шрифта для h6',
                        'default' => '1rem'
                    ]),									
			    new fieldString('nm-h6-weight', [
                        'title'   => 'Жирность шрифта',
                        'default' => '400',						
               'visible_depend' => array('nm-h1-size' => array('hide' => array(''))),
				 ]),		
					
					
					
				new fieldString('scss:nm-width-xl', [
                        'title'   => '<br/>Ширина контейнера для больших разрешений',
                        'default' => '1140px',
                        'hint' => 'По умолчанию: 1140px<br/>CSS: .nm-width-xl'
                    ]),
				new fieldString('scss:nm-width-lg', [
                        'title'   => 'Ширина контейнера для ПК',
                        'default' => '960px',
                        'hint' => 'По умолчанию: 960px<br/>CSS: .nm-width-lg'
                    ]),
				new fieldString('scss:nm-width-md', [
                        'title'   => 'Ширина контейнера для планшетов',
                        'default' => '720px',
                        'hint' => 'По умолчанию: 720px<br/>CSS: .nm-width-md'
                    ]),
				new fieldString('scss:nm-width-sm', [
                        'title'   => 'Ширина контейнера для мобильных',
                        'default' => '540px',
                        'hint' => 'По умолчанию: 540px<br/>CSS: .nm-width-sm'
                    ]),
				 
				 
				new fieldString('scss:nm-main-top-height', [
                        'title'   => '<br/>Высота блока перед шапкой',
                        'default' => '48px'
                    ]),
					
				new fieldString('scss:nm-header-height', [
                        'title'   => 'Высота шапки(где лого и меню пользователя)',
                        'default' => '98px'
                    ]),
					
							
								
				new fieldString('scss:nm-main-nav-height', [
                        'title'   => 'Высота главного меню',
                        'default' => '58px'
                    ]),
									
				new fieldString('scss:nm-main-search-height', [
                        'title'   => 'Высота поиска в главном меню',
                        'default' => '48px'
                    ]),
									
				new fieldString('scss:nm-main-search-width', [
                        'title'   => 'Ширина поиска в главном меню',
                        'default' => '260px'
                    ]),
					
								
				new fieldString('scss:nm-border-radius', [
                        'title'   => '<br/>Закругления элементов',
                        'default' => '0.25rem'
                    ]),			

				// высота изображения в карточках	
				new fieldString('scss:nm-card-image-height-xl', [
                        'title'   => '<br/>Высота изображения в карточках для больших разрешений',
                        'default' => '180px'
                    ]),					
				new fieldString('scss:nm-card-image-height-lg', [
                        'title'   => 'Высота изображения в карточках для ПК',
                        'default' => '150px'
                    ]),					
				new fieldString('scss:nm-card-image-height-md', [
                        'title'   => 'Высота изображения в карточках для планшетов',
                        'default' => '150px'
                    ]),					
				new fieldString('scss:nm-card-image-height-sm', [
                        'title'   => 'Высота изображения в карточках для мобильных',
                        'default' => '150px'
                    ]),
					
					



				 new fieldCheckbox('nm-slider-btn-raunded', [
                        'title'   => 'Закруглять углы у кнопок навигации в слайдере',
                    ]),	
					
					
		    new fieldGmStringList('nm_themes_icons', array(              
                'title' => 'Иконки шаблонов',	                 
                'hint' => 'Класс fontawesome 5 иконки или название svg, png файла из папки /templates/nm/images/themes_icons',	          
                'items' => $nm_themes_list,				
				'is_vertical'=>true
            )),
       
						
	


				]
				
            ),
					
			'nm_styles_mob' => array(
                'type' => 'fieldset',
                'title' => 'NM: Моб.',
                'childs' => [
				
			    new fieldString('scss:nm-mob-main-nav-height', [
                        'title'   => 'Высота главного меню',
                        'default' => '58px'
                    ]),	
					
			    new fieldString('scss:nm-mob-main-nav-toggler-top', [
                        'title'   => 'Отступ сверху для кнопки моб меню',
                        'default' => '29px'
                    ]),
					
					
				new fieldString('nm-h1-size-mob', [
                        'title'   => '<br/>Размер h1',
                        'default' => 'calc(1.375rem + 1.5vw)'
                    ]),				
					
				new fieldString('nm-h2-size-mob', [
                        'title'   => 'Размер h2',
                        'default' => 'calc(1.325rem + 0.9vw)'
                    ]),				
					
				new fieldString('nm-h3-size-mob', [
                        'title'   => 'Размер h3',
                        'default' => 'calc(1.3rem + 0.6vw)'
                    ]),				
					
				new fieldString('nm-h4-size-mob', [
                        'title'   => 'Размер h4',
                        'default' => 'calc(1.275rem + 0.3vw)'
                    ]),				
					
				new fieldString('nm-h5-size-mob', [
                        'title'   => 'Размер h5',
                        'default' => '1.10rem'
                    ]),				
					
				new fieldString('nm-h6-size-mob', [
                        'title'   => 'Размер h6',
                        'default' => '1rem'
                    ]),				
					

				]
				
            ),
			
			'nm_colors' => array(
                'type' => 'fieldset',
                'title' => 'NM: Цвета',
                'childs' => [
				
		
				
				]
				
            ),
			
			
			'nm_css' => array(
                'type' => 'fieldset',
                'title' => 'NM: CSS',
                'childs' => [
				
				 
		            new fieldText('nm_css_files', [
                        'title' => 'Пути к CSS файлам',    
						'hint' => 'Каждый с новой строки. Файлы будут подключены на всех страницах сайта. Например: templates/nm/themes/avifon/css/main.css',
                        'is_strip_tags' => true
                    ]),
					
					new fieldHtml('nm_css_inline_styles', [
                        'title' => 'CSS код',
                        'hint' => 'Без &lt;style&gt; тегов. Код будет добавлен вниз страницы.',
                        'options' => ['editor' => 'ace', 'editor_options' => ['mode' => 'ace/mode/javascript']],
                    ])

					
			 
				
				]
				
            ),		
			'nm_js' => array(
                'type' => 'fieldset',
                'title' => 'NM: JS',
                'childs' => [
				
				 
		           new fieldText('nm_js_files', [
                        'title' => 'Пути к JavaScript файлам',
                        'hint' => 'Каждый с новой строки. Файлы будут подключены на всех страницах сайта. Например: templates/nm/themes/avifon/js/main.js',
                        'is_strip_tags' => true
                    ]),
                    new fieldHtml('nm_js_inline_scripts', [
                        'title' => 'JavaScript код',
                        'hint' => 'Без &lt;script&gt; тегов. Код будет добавлен вниз страницы.',
                        'options' => ['editor' => 'ace', 'editor_options' => ['mode' => 'ace/mode/javascript']],
                    ])

					
			 
				
				]
				
            ),	
			
			'nm_snipps' => array(
                'type' => 'fieldset',
                'title' => 'Фишки',
                'childs' => [
				
			
				new fieldCheckbox('nm_preloader_on', [
                        'title'   => 'Включить прелоадер сайта',
                    ]),	
					 
				new fieldCheckbox('nm_preloader_on_mob', [
                        'title'   => 'Включить прелоадер сайта для мобильных',
                    ]),	
					 
		        new fieldColor('scss:preloader-color', [
                        'title' => 'Цвет прелоадера сайта',                       
				        'options'=>array(				
				        'format'=>'rgb',
				        'opacity'=>true
				)
                    ]),	 
					
		        new fieldColor('scss:preloader-bg', [
                        'title' => 'Фон прелоадера сайта',                       
				        'options'=>array(				
				        'format'=>'rgb',
				        'opacity'=>true
				)
                    ]),
            
			
			 
				
				]
				
            ),
			
			
			
			
			
        );

     
        foreach ($nm_colors as $name => $title) {
            $fields['nm_colors']['childs'][] = new fieldColor('scss:'.str_replace('$', '', $name), array(
                'title' => $title,
                'default' => $nm_colors_default[$name],
                'hint' => (!empty($nm_colors_hint[$name]) ? $nm_colors_hint[$name] : ''),
				'options'=>array(				
				'format'=>'rgb',
				'opacity'=>true
				)
				
            ));
        }
		

        foreach ($gamma as $name => $title) {
            $fields['gamma']['childs'][] = new fieldColor('scss:'.str_replace('$', '', $name), array(
                'title' => $title,
                'default' => $gamma_default[$name],
            ));
        }

        foreach ($theme_colors as $name => $title) {
            $name = str_replace('$', '', $name);
            $fields['colors']['childs'][] = new fieldList('scss:'.$name, array(
                'title' => $title,
                'hint' => LANG_MODERN_THEME_GCOLOR,
                'items' => ['' => LANG_MODERN_THEME_SET_MY_COLOR]+$gamma,
                'default' => $theme_colors_default[$name]
            ));
            $fields['colors']['childs'][] = new fieldColor('custom_scss:'.$name, array(
                'visible_depend' => array('scss:'.$name => array('show' => array('')))
            ));
        }

        return $fields;
    }

}
