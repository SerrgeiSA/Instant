<?php

class fieldGmcontacts extends cmsFormField {

    public $title       = 'Список контактов';
    public $sql         = 'mediumtext';
    public $filter_type = 'str';
    public $allow_index = true;
    public $var_type    = 'array';
    public $size        = 5;
    public $is_public = true;
	
	public function getOptions() {

        return [
            new fieldGmcontactsList('contacts', [
                'title'   => 'Список контактов для заполнения',
            ]),
        ];
    }
	
    public function parse($value) {

    if (is_empty_value($value)) {
            return '';
        }

        return $value;
    }

    public function getFilterInput($value) {
        return '';
    }

    public function getInput($value) {

        return parent::getInput($value);
    }

}
