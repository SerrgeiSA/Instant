<?php

class formWidgetNmImageOptions extends cmsForm {

    public function init() {

        return [
            [
                'type'   => 'fieldset',
                'title'  => 'Изображение',
                'childs' => [
                    new fieldImage('options:image', [
                        'title'   => 'Изображение', 
						'context_params' => [
                            'target_controller' => 'nm',
                            'target_subject'    => 'widget/image',
                            'target_id'         => null
                        ],
                        'options' => array(
                            'sizes' => array('original')
                        )
                    ]),
                    new fieldString('options:link', [
                        'title'   => 'Ссылка',
                    ]),
					 new fieldCheckbox('options:target_blank', [
                        'title'   => 'Открывать ссылку в новом окне',
                    ]),
               		
                    new fieldString('options:title', [
                        'title'   => 'Заголовок для тега alt',
                    ]),
            
       
			
                ]
            ],
        ];
    }

}
