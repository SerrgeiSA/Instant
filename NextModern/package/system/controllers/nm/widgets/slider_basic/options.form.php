<?php

class formWidgetNmSliderBasicOptions extends cmsForm {

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
                'title' => 'Слайды',
                'childs' => array(
		
                   
                    new fieldWim('options:images', array(
                        'title' => '',
						'is_widget' => true
                    )), 

                )
            ),
			
			
			
			
			
				array(
                'type' => 'fieldset',
                'title' => 'Слайдер',
                'childs' => array(
				
						
                     new fieldNumber('options:sl_items_xl', array(
                        'title' => 'Кол-во видимых слайдов для больших разрешений',
                        'default' => 1,
                    )),
                     new fieldNumber('options:sl_items_lg', array(
                        'title' => 'Кол-во видимых слайдов для ПК',
                        'default' => 1,
                    )),
                     new fieldNumber('options:sl_items_md', array(
                        'title' => 'Кол-во видимых слайдов для планшетов',
                        'default' => 1,
                    )),
					
                     new fieldNumber('options:sl_items_sm', array(
                        'title' => 'Кол-во видимых слайдов для мобильных',
                        'default' => 1,
                    )),
					
                     new fieldNumber('options:sl_margin', array(
                        'title' => '<br/>Отступы между слайдами',
                        'default' => 0,
                    )),
					
			
					new fieldCheckbox('options:sl_nav', array(
                        'title' => 'Включить стрелки навигации',
                        'default' => true,
                    )),
					
			
					new fieldCheckbox('options:sl_dots', array(
                        'title' => 'Включить пагинацию',
                        'default' => false,
                    )),
					
			
					new fieldCheckbox('options:sl_autoplay', array(
                        'title' => 'Включить автопрокрутку',
                        'default' => true,
                    )),
					
					new fieldCheckbox('options:sl_autoplayHoverPause', array(
                        'title' => 'Приостановливать автопрокрутку при наведении указателя мыши на слайдер',
                        'default' => true,
                    )),
					
					new fieldCheckbox('options:sl_rewind', array(
                        'title' => 'Зациклить прокрутку',
                        'default' => true,
                    )),
					
					new fieldCheckbox('options:sl_center', array(
                        'title' => 'Включить выравнивание по центру',
                        'default' => false,
                        'hint' => 'Опция для нескольких слайдов',
                    )),
					
					
					new fieldCheckbox('options:sl_autoHeight', array(
                        'title' => "Включить адаптивную высоту для слайдов<script>$('#options_sl_autoHeight').on('change', function(event){
	  $('#options_sl_cover').prop('checked', false);
  });</script>",
                        'default' => false,
                    )),
					
			
					new fieldCheckbox('options:sl_cover', array(
                        'title' => "Включить отображение изображения обложкой<script>$('#options_sl_cover').on('change', function(event){
	  $('#options_sl_autoHeight').prop('checked', false);
  });</script>",
                        'default' => true,
                    )),
					
						
				new fieldString('options:sl_height_xl', [
                        'title'   => '<br/>Высота слайдов для больших разрешений',
						 'default' => '400px',
                        'hint' => 'Изображение будет обрезано по высоте. Если этого не нужно, тогда включите опцию [Включить отображение изображения обложкой]',
                    ]),					
				new fieldString('options:sl_height_lg', [
                        'title'   => 'Высота слайдов для ПК',
                        'default' => '400px',
                    ]),					
				new fieldString('options:sl_height_md', [
                        'title'   => 'Высота слайдов для планшетов',
                         'default' => '400px',
                    ]),					
				new fieldString('options:sl_height_sm', [
                        'title'   => 'Высота слайдов для мобильных',
                         'default' => '300px',
                    ]),
					
		   
				
				   new fieldNumber('options:sl_smartSpeed', array(
                        'title' => '<br/>Скорость прокрутки',
                        'default' => 1000,
                        'units' => 'Миллисекунд'
                    )),
					
				
				   new fieldNumber('options:sl_autoplaytimeout', array(
                        'title' => 'Задержка перед появлением следующего слайда',
                        'default' => 5000,
                        'units' => 'Миллисекунд'
                    )),
					
				
					
					new fieldString('options:sl_animateIn', array(
                        'title' => '<br/>Эффект появления',
                        'hint' => 'Например с использованием <a href="https://daneden.github.io/animate.css/" target="_blank">animate.css</a>: flipInX'
                    )),
					new fieldString('options:sl_animateOut', array(
                        'title' => 'Эффект убывания',
                        'hint' => 'Например с использованием <a href="https://daneden.github.io/animate.css/" target="_blank">animate.css</a>: slideOutDown'
                    )),
					
					
					
					
					
			
					
					
	
				)
            ),
			
			
			
	
			
			
			
			
			array(
                'type' => 'fieldset',
                'title' => 'Настройки',
                'childs' => array(
				
				  new fieldColor('options:overlay', [
                        'title'   => '<h5>Общие</h5>Оверлей\затемнение',
						'options'=> array('format'=>'rgb','opacity'=>true)
                    ]),
			
				
		            new fieldList('options:align', array(
                        'title' => '<br/>Выравнивание по горизонтали',
                        'items' => array(
						''=>'Слева',
						'center'=>'По центру',
						),
                    )),
		            new fieldList('options:valign', array(
                        'title' => 'Выравнивание по вертикали',
                        'items' => array(
						'top'=>'Сверху',
						'center'=>'По центру',
						'end'=>'Снизу',
						),
						'default'=>'center'
                    )),
		            new fieldList('options:text_align', array(
                        'title' => 'Выравнивание текста',
                        'items' => array(
						''=>'Слева',
						'center'=>'По центру',
						),
                    )),
					
					  new fieldNumber('options:padding_x', [
                        'title'   => '<br/>Отступы горизонатальные',
                        'default'   => '0',
						 'prefix'   => 'px',
                    ]),
					  new fieldNumber('options:padding_y', [
                        'title'   => 'Отступы вертикальные',
                        'default'   => '0',
						 'prefix'   => 'px',
                    ]),
					
				
		            new fieldString('options:title_tag', array(
                        'title' => '<h5>Заголовок</h5>Тег заголовка',
                        'default' => 'h3',
                    )),
					new fieldColor('options:title_color', [
                        'title'   => 'Цвет заголовка',
						'options'=> array('format'=>'rgb','opacity'=>true)
                    ]),				
					
					new fieldNumber('options:title_size_xl', [
                        'title'   => '<br/>Размер заголовка для больших разрешений',
                        'prefix'   => 'px',
                    ]),
					new fieldNumber('options:title_size_lg', [
                        'title'   => 'Размер заголовка для ПК',
                        'prefix'   => 'px',
                    ]),
					new fieldNumber('options:title_size_md', [
                        'title'   => 'Размер заголовка для планшетов',
                        'prefix'   => 'px',
                    ]),
					new fieldNumber('options:title_size_sm', [
                        'title'   => 'Размер заголовка для мобильных',
                        'prefix'   => 'px',
                    ]),					
					
				
				
				
				  new fieldColor('options:teaser_color', [
                        'title'   => '<br/><h5>Описание</h5>Цвет описания',
						'options'=> array('format'=>'rgb','opacity'=>true)
                    ]),
			
				    new fieldNumber('options:teaser_size_xl', [
                        'title'   => '<br/>Размер описания для больших разрешений',
                        'prefix'   => 'px',
                    ]),
					new fieldNumber('options:teaser_size_lg', [
                        'title'   => 'Размер описания для ПК',
                        'prefix'   => 'px',
                    ]),
					new fieldNumber('options:teaser_size_md', [
                        'title'   => 'Размер описания для планшетов',
                        'prefix'   => 'px',
                    ]),
					new fieldNumber('options:teaser_size_sm', [
                        'title'   => 'Размер описания для мобильных',
                        'prefix'   => 'px',
                    ]),
					
					new fieldNumber('options:teaser_mt', [
                        'title'   => '<br/>Отступ сверху от заголовка',
                        'prefix'   => 'px',
                    ]),
					new fieldNumber('options:teaser_mt_mob', [
                        'title'   => 'Отступ сверху от заголовка для мобильных',
                        'prefix'   => 'px',
                    ]),
						
					new fieldNumber('options:teaser_mb', [
                        'title'   => 'Отступ снизу от заголовка',
                        'prefix'   => 'px',
                    ]),
					new fieldNumber('options:teaser_mb_mob', [
                        'title'   => 'Отступ снизу от заголовка для мобильных',
                        'prefix'   => 'px',
                    ]),
					
				
				
				
				    new fieldString('options:button_class', array(
                        'title' => '<br/><h5>Кнопка</h5>CSS класс для кнопки',
                        'default' => 'btn btn-primary',
                    )),
				    new fieldColor('options:button_bg', array(
                        'title' => 'Цвет кнопки',
                        'options'=> array('format'=>'rgb','opacity'=>true)
                    )),
				    new fieldColor('options:button_color', array(
                        'title' => 'Цвет заголовка кнопки',
                    )),
				    new fieldColor('options:button_bg_hover', array(
                        'title' => 'Цвет кнопки при наведении',
                        'options'=> array('format'=>'rgb','opacity'=>true)
                    )),
				    new fieldColor('options:button_color_hover', array(
                        'title' => 'Цвет заголовка кнопки при наведении',
                    )),
						
					new fieldNumber('options:button_title_size', [
                        'title'   => '<br/>Размер заголовка кнопки',
                        'prefix'   => 'px',
                    ]),
					new fieldNumber('options:button_title_size_mob', [
                        'title'   => 'Размер заголовка кнопки для мобильных',
                        'prefix'   => 'px',
                    ]),
					
					new fieldNumber('options:button_width', [
                        'title'   => '<br/>Ширина кнопки',
                        'prefix'   => 'px',
                    ]),
					new fieldNumber('options:button_width_mob', [
                        'title'   => 'Ширина кнопки для мобильных',
                        'prefix'   => 'px',
                    ]),
					
					new fieldNumber('options:button_height', [
                        'title'   => '<br/>Высота кнопки',
                        'prefix'   => 'px',
                    ]),
					new fieldNumber('options:button_height_mob', [
                        'title'   => 'Высота кнопки для мобильных',
                        'prefix'   => 'px',
                    ]),
					
					new fieldNumber('options:button_mt', [
                        'title'   => '<br/>Отступ сверху для кнопки',
                        'prefix'   => 'px',
                    ]),
					new fieldNumber('options:button_mt_mob', [
                        'title'   => 'Отступ сверху для мобильных для кнопки',
                        'prefix'   => 'px',
                    ]),
					
					
					
				
				
				
			      )
            ),	
			
	
			
			
			
			
			array(
                'type' => 'fieldset',
                'title' => 'Шаблон',
                'childs' => array(
				
		     
				
				
			      )
            ),	
			
			
		
			
			
			
			

        );

    }

}
