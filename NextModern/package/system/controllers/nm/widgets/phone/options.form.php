<?php

class formWidgetNmPhoneOptions extends cmsForm {

    public function init() {

        return [
            [
                'type'   => 'fieldset',
                'title'  => 'Телефон',
                'childs' => [
				
                   new fieldGmicon('options:icon', array(
                        'title' => 'Иконка',
                        'default' => 'solid:mobile-alt',
                    )),
                    new fieldString('options:phone', [
                        'title'   => 'Телефон в любом формате',
                    ]),
                    new fieldString('options:link', [
                        'title'   => 'Формат телефона для звонка',
                        'hint'   => 'Например: +1234567890',
                    ]),
				
				new fieldColor('options:text-color', [
                        'title' => 'Цвет',                       
				        'options'=>array(				
				        'format'=>'rgb',
				        'opacity'=>true
				)
                    ]),	
					
				new fieldColor('options:text-color-hover', [
                        'title' => 'Цвета при наведении',                       
				        'options'=>array(				
				        'format'=>'rgb',
				        'opacity'=>true
				)
                    ]),	
            
			
                ]
            ],
       
        ];
    }

}
