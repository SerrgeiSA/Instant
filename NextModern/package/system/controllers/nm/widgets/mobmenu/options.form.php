<?php

class formWidgetNmMobmenuOptions extends cmsForm {

    public function init($options, $template_name) {

        return array(
            'menu_options' => array(
                'type'   => 'fieldset',
                'title'  => LANG_OPTIONS,
                'childs' => array(
                    new fieldList('options:menu', array(
                        'title'     => LANG_MENU,
                        'generator' => function() {

                            $tree = cmsCore::getModel('menu')->getMenus();

                            $items = [];

                            if ($tree) {
                                foreach ($tree as $item) {
                                    $items[$item['name']] = $item['title'];
                                }
                            }

                            return $items;
                        }
                    )),
                    new fieldList('options:template', array(
                        'title'     => LANG_WD_NM_MOBMENU_TEMPLATE,
                        'hint'      => LANG_WD_NM_MOBMENU_TEMPLATE_HINT,
                        'default'   => 'menu',
                        'generator' => function($item) use ($template_name) {
                            return cmsTemplate::getInstance()->getAvailableTemplatesFiles('assets/ui', 'menu*.tpl.php', $template_name);
                        }
                    )),
                    new fieldString('options:class', array(
                        'title' => LANG_WD_NM_MOBMENU_CSS_CLASS
                    )),
                    new fieldCheckbox('options:is_detect', array(
                        'title'   => LANG_WD_NM_MOBMENU_DETECT_ACTIVE,
                        'default' => 1
                    )),
                    new fieldCheckbox('options:is_detect_strict', array(
                        'title'   => LANG_WD_NM_MOBMENU_ACTIVE_STRICT,
                        'hint'   => LANG_WD_NM_MOBMENU_ACTIVE_STRICT_HINT,
                        'default' => 0,
                        'visible_depend' => array('options:is_detect' => array('show' => array('1')))
                    )),
                    new fieldNumber('options:max_items', array(
                        'title'   => LANG_WD_NM_MOBMENU_MAX_ITEMS,
                        'hint'    => LANG_WD_NM_MOBMENU_MAX_ITEMS_HINT,
                        'default' => 0
                    ))
                )
            ),
			
			
			'menu_options2' => array(
                'type'   => 'fieldset',
                'title'  => 'Настройки',
                'childs' => array(
			
			
			new fieldColor('options:m_bg_color', array(
                'title' => '<h6>Меню</h6>Цвет фона контейнера меню',	
				'options'=>array(				
				'format'=>'rgb',
				'opacity'=>true
				),
              
            )),			
			new fieldColor('options:m_active_bgcolor', array(
                'title' => ' Цвет фона активного пункта',	
				'options'=>array(				
				'format'=>'rgb',
				'opacity'=>true
				),
            )),
			
			
			new fieldColor('options:m_links_color', array(
                'title' => 'Цвет текста',	
				'options'=>array(				
				'format'=>'rgb',
				'opacity'=>true
				),              
			  
            )),		
			
			
			new fieldColor('options:m_active_color', array(
                'title' => 'Цвет текста активного пункта',	
				'options'=>array(				
				'format'=>'rgb',
				'opacity'=>true
				),
              
            )),
	
			
			
			new fieldColor('options:m2_bg_color', array(
                'title' => '<br/><h6>Подменю</h6>Цвет фона',	
				'options'=>array(				
				'format'=>'rgb',
				'opacity'=>true
				),
              
            )),
			
			new fieldColor('options:m2_active_bgcolor', array(
                'title' => 'Цвет фона активного пункта',	
				'options'=>array(				
				'format'=>'rgb',
				'opacity'=>true
				),
			      
            )),
			
			new fieldColor('options:m2_links_color', array(
                'title' => 'Цвет текста',	
				'options'=>array(				
				'format'=>'rgb',
				'opacity'=>true
				),              
            )),	
	
        
			new fieldColor('options:m2_active_color', array(
                'title' => 'Цвет текста активного пункта',	
				'options'=>array(				
				'format'=>'rgb',
				'opacity'=>true
				),              
            )),		
			
	
			
			
			
			
			     )
            ),
			
			
			
			
			
        );

    }

}
