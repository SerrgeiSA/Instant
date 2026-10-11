<?php

class fieldGMStringList extends cmsFormField {

    public $title       = 'Список input';
    public $is_public   = false;
    public $sql         = 'text NULL DEFAULT NULL';
    public $allow_index = false;
    public $var_type    = 'array';
    public $is_vertical = false;

    public function getOptions() {

        return [
            new fieldCheckbox('show_all', [
                'title'   => LANG_PARSER_LIST_MULTIPLE_SHOW_ALL,
                'default' => 1
            ])
        ];
    }

    public function getInput($value) {

        $this->data['items'] = ($this->getProperty('show_all') ? [0 => LANG_ALL] : []) + $this->getListItems();


        return parent::getInput($value ? $value : [0]);
    }

}
