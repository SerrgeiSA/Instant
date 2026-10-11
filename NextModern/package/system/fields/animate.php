<?php

class fieldAnimate extends cmsFormField {

    public $title       = 'Animate';
    public $is_public   = false;
    public $sql         = 'varchar({max_length}) NULL DEFAULT NULL';
    public $filter_type = 'str';
    public $var_type    = 'string';
    public $type        = 'text';

    public function getOptions() {

        return [
        ];
    }

    public function getInput($value) {

        return parent::getInput($value ? $value : 0);
    }

}
