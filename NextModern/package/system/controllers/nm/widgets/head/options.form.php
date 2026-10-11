<?php

class formWidgetNmHeadOptions extends cmsForm {

    public function init() {

        return [
            [
                'type'   => 'fieldset',
                'title'  => 'Заголовок',
                'childs' => [
				
                    new fieldString('options:title', [
                        'title'   => 'Заголовок',
                    ]),
					
                    new fieldString('options:link', [
                        'title'   => 'Ссылка заголовка',                        
                    ]),
					
					new fieldCheckbox('options:link_blank', [
                        'title'   => 'Открывать ссылку в новой вкладке',
                    ]),
							
                
				    new fieldString('options:tag', array(
                        'title' => 'Тег заголовка',
                        'default' => 'div',
                    )),
					
					  new fieldString('options:style_css', [
                        'title'   => 'Класс CSS для заголовка',
                        'hint'   => 'Настройки заданные ниже могут перебивать CSS классы',
                    ]),		


				    new fieldNumber('options:style_size', [
                        'title'   => 'Размер заголовка',
                        'prefix'   => 'px',
                    ]),
					
				    new fieldNumber('options:style_size_mob', [
                        'title'   => 'Размер заголовка для мобильных',
                        'prefix'   => 'px',
                    ]),   
					
					    new fieldColor('options:style_color', [
                        'title'   => 'Цвет заголовка',
                    ]),
					
					
					
                ]
            ],      
			[
                'type'   => 'fieldset',
                'title'  => 'Описание',
                'childs' => [
				
             		
                    new fieldText('options:teaser', [
                        'title'   => 'Краткое описание или html код под заголовком',
                    ]),
					
					   new fieldString('options:teaser_css', [
                        'title'   => 'Класс CSS',
                        'hint'   => 'Настройки заданные ниже могут перебивать CSS классы',
                    ]),			
						
					  new fieldColor('options:style_color_teaser', [
                        'title'   => 'Цвет описания',
                    ]),
			
					new fieldNumber('options:style_teaser_size', [
                        'title'   => 'Размер описания',
                        'prefix'   => 'px',
                    ]),
					
				    new fieldNumber('options:style_teaser_size_mob', [
                        'title'   => 'Размер описания для мобильных',
                        'prefix'   => 'px',
                    ]),
					
						new fieldNumber('options:teaser_mt', [
                        'title'   => 'Отступ сверху',
                        'prefix'   => 'px',
                    ]),
						new fieldNumber('options:teaser_mt_mob', [
                        'title'   => 'Отступ сверху для мобильных',
                        'prefix'   => 'px',
                    ]),
					
					
                ]
            ],
			            [
                'type'   => 'fieldset',
                'title'  => 'Кнопка',
                'childs' => [
				
                    new fieldString('options:button', [
                        'title'   => 'Заголовок',
                    ]),
					
                    new fieldString('options:button_link', [
                        'title'   => 'Ссылка',                        
                    ]),		
                   
				    new fieldCheckbox('options:button_link_blank', [
                        'title'   => 'Открывать ссылку в новой вкладке',
                    ]),
												
                
				    new fieldString('options:button_class', array(
                        'title' => 'Класс css',
                        'default' => 'btn btn-primary border-0',
                    )),
					
					new fieldNumber('options:button_mt', [
                        'title'   => 'Отступ сверху',
                        'prefix'   => 'px',
                    ]),
					
					new fieldColor('options:button_bgcolor', [
                        'title'   => 'Цвет',
						'options'=> array('format'=>'rgb','opacity'=>true)
                    ]),
						new fieldColor('options:button_bgcolor_hover', [
                        'title'   => 'Цвет при наведении',
						'options'=> array('format'=>'rgb','opacity'=>true)
                    ]),
					new fieldColor('options:button_textcolor', [
                        'title'   => 'Цвет текста',
                    ]),
					
					new fieldNumber('options:button_textsize', [
                        'title'   => 'Размер текста',
						   'prefix'   => 'px',
                    ]),
					
					new fieldNumber('options:button_textsize_mob', [
                        'title'   => 'Размер текста для мобильных',
						   'prefix'   => 'px',
                    ]),
					
					new fieldString('options:button_padding', [
                        'title'   => 'Внутренние отступы',
                        'hint'   => 'Например: 0.5rem 3rem',
                    ]),
					
					new fieldString('options:button_padding_mob', [
                        'title'   => 'Внутренние отступы для мобильных',
                        'hint'   => 'Например: 0.5rem 3rem',
                    ]),
					
					
							new fieldNumber('options:button_borders', [
                        'title'   => 'Закругление углов',
						   'prefix'   => 'px',
                    ]),
					
                ]
            ],   
			[
                'type'   => 'fieldset',
                'title'  => 'Фон',
                'childs' => [
				
				
				    new fieldColor('options:style_bgcolor', [
                        'title'   => 'Цвет',
                    ]),
					
				    new fieldColor('options:style_bgcolor2', [
                        'title'   => 'Цвет 2',
                        'hint'   => 'Для градиента',
                    ]),
					
				    new fieldNumber('options:style_bg_opacity', [
                        'title'   => 'Прозрачность',
						'prefix'=>'%',
                        'hint'   => 'Пригодиться чтобы использовать заливку как затемнение для обложки или видео',
                    ]),
					
				
				    new fieldImage('options:style_cover', [
                        'title'   => 'Обложка',
                    ]),
					
					new fieldString('options:style_video', [
                        'title'   => 'Видео фон',
                        'hint'   => 'Введите ссылку на ролик с youtube или на mp4, avi файл',
                    ]),
				
					
                ]
            ],
            [
                'type'   => 'fieldset',
                'title'  => 'Блок',
                'childs' => [
				
				  
					
				    new fieldString('options:parent_tag', array(
                        'title' => 'Тег',
                        'default' => 'div',
                    )),
					
				    new fieldString('options:style_css_parent', [
                        'title'   => 'Класс CSS',
                        'hint'   => 'Настройки заданные ниже могут перебивать CSS классы',
                    ]),			
					
					    new fieldCheckbox('options:style_center', [
                        'title'   => 'Выравнивать текст заголовка и описания по центру',
                    ]),
											
				
					new fieldList('options:style_align', array(
                        'title' => 'Горизонтальное выравнивание',
						'items'=>array(
						''=>'Слева',
						'align-items-center'=>'По середине',
						'align-items-end'=>'Справа',
						)
                    )),
					
					new fieldList('options:style_valign', array(
                        'title' => 'Вертикальное выравнивание',
						'items'=>array(
						''=>'Сверху',
						'justify-content-center'=>'По середине',
						'justify-content-end'=>'Снизу',
						)
                    )),
					
				    new fieldNumber('options:style_height', [
                        'title'   => 'Высота',
                        'prefix'   => 'px',
                    ]),
				    new fieldNumber('options:style_height_mob', [
                        'title'   => 'Высота для мобильных',
                        'prefix'   => 'px',
                    ]),
					
					new fieldString('options:style_padding_x', [
                        'title'   => 'Внутренние горизонтальные отступы',
                        'prefix'   => 'px',
                    ]),
					
					new fieldString('options:style_padding_y', [
                        'title'   => 'Внутренние вертикальные отступы',
                        'prefix'   => 'px',
                    ]),
					
					new fieldString('options:style_padding_x_mob', [
                        'title'   => 'Внутренние горизонтальные отступы для мобильных',
                        'prefix'   => 'px',
                    ]),
					
					new fieldString('options:style_padding_y_mob', [
                        'title'   => 'Внутренние вертикальные отступы для мобильных',
                        'prefix'   => 'px',
                    ]),
					
					
					new fieldNumber('options:style_maxwidth', [
                        'title'   => 'Максимальная ширина содержимого',
                        'prefix'   => 'px',
                        'hint'   => 'Для заголовка и описания',
                    ]),
					
					
					 new fieldNumber('options:style_radius', [
                        'title'   => 'Закругление углов',
                        'prefix'   => 'px',
                    ]),
					
		
				
            
					
                ]
            ],
			

			
       
        ];
    }

}
