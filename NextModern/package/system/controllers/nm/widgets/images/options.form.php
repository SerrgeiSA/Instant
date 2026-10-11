<?php

class formWidgetNmImagesOptions extends cmsForm {

    public function init($options) {

		
        return array(
            array(
                'type' => 'fieldset',
                'title' => 'Пресеты',
                'childs' => array(

           
            new fieldList('options:img_small', array(
                'title' => 'Создавать пресет для миниатюры',
                'default' => 'small',
                'generator' => function (){
                    $presets = cmsCore::getModel('images')->getPresetsList();
                    $presets['original'] = LANG_PARSER_IMAGE_SIZE_ORIGINAL;
                    return $presets;
                }
            )),
			new fieldList('options:img_normal', array(
                'title' => 'Создавать пресет для изображения в списке',
                'default' => 'normal',
                'generator' => function (){
                    $presets = cmsCore::getModel('images')->getPresetsList();
                    $presets['original'] = LANG_PARSER_IMAGE_SIZE_ORIGINAL;
                    return $presets;
                }
            )),
            new fieldList('options:img_full', array(
                'title' => 'Создавать пресет для увеличенного изображения',
                'default' => 'original',
                'generator' => function (){
                    $presets = cmsCore::getModel('images')->getPresetsList();
                    $presets['original'] = LANG_PARSER_IMAGE_SIZE_ORIGINAL;
                    return $presets;
                }
            )),	
			
            new fieldList('options:img_preset', array(
                'title' => 'Пресет для отображения в списке',
                'hint' => 'Один из выбранных выше',
                'default' => 'original',
                'generator' => function (){
                    $presets = cmsCore::getModel('images')->getPresetsList();
                    $presets['original'] = LANG_PARSER_IMAGE_SIZE_ORIGINAL;
                    return $presets;
                }
            )),	
			
			
			

                )
            ),
			
			array(
                'type' => 'fieldset',
                'title' => 'Список',
                'childs' => array(
		
                   
                    new fieldWim('options:images', array(
                        'title' => '',
						'is_widget' => true
                    )), 

                )
            ),
			
			
			array(
                'type' => 'fieldset',
                'title' => 'Шаблон',
                'childs' => array(
				
		         
                    new fieldNumber('options:padding', array(
                        'title' => 'Отступы между колонками',
                        'prefix' => 'px',
                    )), 
				
				
			      )
            ),	
			
			
		
			
			
			
			

        );

    }

}
