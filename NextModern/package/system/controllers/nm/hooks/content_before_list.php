<?php

class onNmContentBeforeList extends cmsAction {

    public function run($data){
		
        list($ctype, $items) = $data;

		
        if (!$items){ return $data; }

$device_type = cmsRequest::getDeviceType();
$device = $device_type == 'desktop' ? 'desktop' : 'mobile';
$theme_op = @$ctype['options']['nm_'.$device]['list'];

if(!empty($theme_op['infobar_skips'])){

	foreach ($items as $idx=>$item){

		foreach ($theme_op['infobar_skips'] as $val=>$name){
			if($name){
			unset($items[$idx]['info_bar'][$name]);
			}
		}
		
	}



}



        return array($ctype, $items);

    }

}
