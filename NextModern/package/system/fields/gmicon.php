<?php

class fieldGmicon extends cmsFormField {

    public $title        = 'Иконка';
    public $sql          = 'text';
    public $filter_type  = 'str';
    public $var_type     = 'string';
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
