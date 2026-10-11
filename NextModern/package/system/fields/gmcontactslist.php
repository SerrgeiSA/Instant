<?php

class fieldGmcontactsList extends cmsFormField {

    public $title       = 'Список контактов';
    public $sql         = 'mediumtext';
    public $filter_type = 'str';
    public $allow_index = false;
    public $var_type    = 'array';
    public $size        = 5;
    public $is_public = false;
	
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
