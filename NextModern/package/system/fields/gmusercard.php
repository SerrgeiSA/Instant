<?php

class fieldGmusercard extends cmsFormField {

    public $title       = 'Карточка автора';
    public $is_public   = true;
    public $sql         = 'int(6) NULL DEFAULT NULL';
    public $allow_index = false;
    public $var_type    = 'int';

    protected $is_set_rules = false;

    public function getOptions() {

        return [
            new fieldString('field_about', [
                'title'   => 'Поле с текстом об авторе',
                'default' => 'hobby'
            ]),
            new fieldString('avatar_preset', [
                'title'   => 'Пресет аватара',
                'default' => 'normal'
            ]),
            new fieldColor('bgcolor', [
                'title'   => 'Цвет карточки',
                'default'   => 'f2f8fe',
            ]),
            new fieldString('title_tag', [
                'title'   => 'Тег для никнейма',
                'default'   => 'h4',
            ]),
            new fieldNumber('card_mt', [
                'title'   => 'Отступ сверху',
                'default'   => '30',
                'prefix'   => 'px',
            ]),
            new fieldNumber('card_mb', [
                'title'   => 'Отступ снизу',
                'default'   => '30',
                'prefix'   => 'px',
            ]),
        ];
		
    }


    public function parse($value) {
		
		
		$profile = cmsCore::getModel('users')->getUser(!empty($value) ? $value : $this->item['user_id']);
		
		$tpl_file = cmsTemplate::getInstance()->getTemplateFileName('assets/fields/gmusercard/basic');
        ob_start();
        include($tpl_file);
        $html = ob_get_clean();

		   
	
        return $html;
    }

    public function getStringValue($value) {
        return $value ? $value : '';
    }

 
}
