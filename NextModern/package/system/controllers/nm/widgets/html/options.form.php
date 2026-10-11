<?php

class formWidgetNmHtmlOptions extends cmsForm {

    public function init($options) {

		
        return array(
            array(
                'type' => 'fieldset',
                'title' => '@',
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
			
			
			

                )
            ),
           
			array(
                'type' => 'fieldset',
                'title' => 'Объекты',
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
				
		        new fieldText('options:tpl_start', array('title' => 'Начало контейнера')),
				
		        new fieldHtml('options:tpl_item', array(
                        'title' => 'Шаблон объекта в цикле',  
						'hint' => 'Используйте поля объекта, вставляя их названия в фигурных скобках. <br/>Например:
						<br/>{image_small}, {image_normal}, {image_full} - изображение
						<br/>{title} - заголовок
						<br/>{teaser} - описание
						<br/>{link_url}, {link_title} - ссылка и её заголовок
						<br/>{link2_url}, {link2_title} - ссылка 2 и её заголовок
						<br/>{link3_url}, {link3_title} - ссылка 3 и её заголовок',
                'options'=>array('editor'=>(!empty($options['editor']) ? $options['editor'] : 'ace'))								
                    )),
					
				new fieldText('options:tpl_end', array(
                        'title' => 'Конец контейнера',  
						)),
			
			
			
				
			      )
            ),	
			
			array(
                'type' => 'fieldset',
                'title' => 'CSS',
                'childs' => array(
				
				new fieldHtml('options:css', array(
                'options'=>array('editor'=>'ace')	
                )),
				
				new fieldText('options:styles', array('title' => 'Подключить файлы стилей')),
				
	
			      )
            ),	
			
			array(
                'type' => 'fieldset',
                'title' => 'JS',
                'childs' => array(
				
				new fieldHtml('options:js', array(                    
                'options'=>array('editor'=>'ace')								
                )),
				
				
				new fieldText('options:scripts', array('title' => 'Подключить файлы js скриптов')),
				
				
			
				
				
					
			      )
            ),
			
			
			
			
			
			
			
				array(
                'type' => 'fieldset',
                'title' => 'Слайдер',
                'childs' => array(
				
				      new fieldCheckbox('options:sl_on', array(
                        'title' => 'Включить слайдер',
                        'hint' => 'Если это опция включена и в файле шаблона предусмотрен опциональный вариант отображения списка в виде слайдера, тогда он будет задействован. Для шаблонов где слайдер является единственным вариантом отображения, эта опция не используется но действуют настройки слайдера.',
                        'default' => false,
                    )),
					
					new fieldList('options:sl_image_preset', array(
                'title' => 'Свой пресет изображения для слайдера',
                'default' => 'normal',
                'generator' => function (){
                    $presets = cmsCore::getModel('images')->getPresetsList();
                    $presets['original'] = LANG_PARSER_IMAGE_SIZE_ORIGINAL;
                    return $presets;
                }
            )),
				    new fieldNumber('options:sl_items', array(
                        'title' => 'Кол-во видимых объектов',
                        'default' => 3,
                        'hint' => 'Может игнорироватся, если не используется в шаблоне вывода'
                    )),
					
                     new fieldNumber('options:sl_margin', array(
                        'title' => 'Отступы между объектами',
                        'default' => 10,
                    )),
					
                     new fieldCheckbox('options:sl_rewind', array(
                        'title' => 'Зациклить прокрутку',
                        'default' => true,
                    )),

				
				   new fieldNumber('options:sl_autoplaytimeout', array(
                        'title' => 'Задержка между слайдами',
                        'default' => 5000,
                        'units' => 'Миллисекунд'
                    )),

                    new fieldList('options:sl_autoplay', array(
                        'title' => 'Автопрокрутка баннеров',
                        'items' => array(
                            'true' => 'Включить',
                            'false' => 'Выключить',
                        )
                    )),

                    new fieldList('options:sl_autoplayHoverPause', array(
                        'title' => 'Остановить прокрутку при наведении указателя мыши',
                        'items' => array(
                            'true' => 'Включить',
                            'false' => 'Выключить',
                        )
                    )),
					
					new fieldString('options:sl_animateIn', array(
                        'title' => 'Эффект появления',
                        'hint' => 'Например с использованием <a href="https://daneden.github.io/animate.css/" target="_blank">animate.css</a>: flipInX'
                    )),
					new fieldString('options:sl_animateOut', array(
                        'title' => 'Эффект убывания',
                        'hint' => 'Например с использованием <a href="https://daneden.github.io/animate.css/" target="_blank">animate.css</a>: slideOutDown'
                    )),
					
					
	
				)
            ),
			
			
			

        );

    }

}
