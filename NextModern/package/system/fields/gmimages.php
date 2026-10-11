<?php

class fieldGmImages extends cmsFormField {

    public $title       = 'NM: '.LANG_PARSER_IMAGES;
    public $sql         = 'text';
    public $allow_index = false;
    public $var_type    = 'array';

    public function getOptions(){

        return array(

		
		
            new fieldList('size_teaser', array(
                'title' => LANG_PARSER_IMAGE_SIZE_TEASER,
                'default' => 'small',
                'generator' => function (){
                    $presets = cmsCore::getModel('images')->getPresetsList(true);
                    $presets['original'] = LANG_PARSER_IMAGE_SIZE_ORIGINAL;
                    return $presets;
                },
				'extended_option' => true
            )),
            new fieldList('size_full', array(
                'title' => LANG_PARSER_IMAGE_SIZE_FULL,
                'default' => 'big',
                'generator' => function (){
                    $presets = cmsCore::getModel('images')->getPresetsList(true);
                    $presets['original'] = LANG_PARSER_IMAGE_SIZE_ORIGINAL;
                    return $presets;
                }
            )),
            new fieldList('size_small', array(
                'title'   => LANG_PARSER_SMALL_IMAGE_PRESET,
                'default' => 'small',
                'generator' => function (){
                    $presets = cmsCore::getModel('images')->getPresetsList(true);
                    $presets['original'] = LANG_PARSER_IMAGE_SIZE_ORIGINAL;
                    return $presets;
                },
				'extended_option' => true
            )),
            new fieldListMultiple('sizes', array(
                'title' => LANG_PARSER_IMAGE_SIZE_UPLOAD,
                'default' => 0,
                'generator' => function (){
                    $presets = cmsCore::getModel('images')->getPresetsList();
                    $presets['original'] = LANG_PARSER_IMAGE_SIZE_ORIGINAL;
                    return $presets;
                },
                'rules' => [['required']]
            )),
            new fieldCheckbox('allow_import_link', array(
                'title' => LANG_PARSER_IMAGE_ALLOW_IMPORT_LINK
            )),
            new fieldCheckbox('first_image_emphasize', array(
                'title' => LANG_PARSER_FIRST_IMAGE_EMPHASIZE
            )),
            new fieldNumber('max_photos', array(
                'title' => LANG_PARSER_IMAGE_MAX_COUNT
            )),
	
			
			
			
					
		
				 new fieldList('theme_list', array(
                        'title' => 'Шаблон в списке:',                   
                  		'hint' => 'Список шаблонов из папки: /templates/nm/assets/fields/gmimages/themes/',
                'generator' => function (){
                 $template = cmsTemplate::getInstance(); 
	             $themes_list = array();	
                 $themes = cmsCore::getFilesList('/templates/nm/assets/fields/gmimages/themes', '*.tpl.php');                       
                            if ($themes) {
                                foreach ($themes as $item) {
                                    $themes_list[str_replace('.tpl.php', '', str_replace('tpl_', '', $item))] = str_replace('.tpl.php', '', $item);	
                                }
                            }
                    return $themes_list;
                }
                    )),
					
					 new fieldList('theme_item', array(
                        'title' => 'Шаблон в записи:',                   
                  		'hint' => 'Список шаблонов из папки: /templates/nm/assets/fields/gmimages/themes/',
                'generator' => function (){
                 $template = cmsTemplate::getInstance(); 
	             $themes_list = array();	
                 $themes = cmsCore::getFilesList('/templates/nm/assets/fields/gmimages/themes', '*.tpl.php');                       
                            if ($themes) {
                                foreach ($themes as $item) {
                                    $themes_list[str_replace('.tpl.php', '', str_replace('tpl_', '', $item))] = str_replace('.tpl.php', '', $item);	
                                }
                            }
                    return $themes_list;
                }
                    )),
					
		
					
			
        );

    }

    public function parse($value){

        $images = is_array($value) ? $value : cmsModel::yamlToArray($value);

        $html = '';

		$template = cmsTemplate::getInstance();
		
		$has_first_image = $this->getOption('first_image_emphasize');
		$small_preset = $this->getOption('size_small');		
        $normal_preset = $this->getOption('size_full');
		
        $min_width = $this->getOption('min_width');
        $max_width = $this->getOption('max_width');
 
        
	    $tpl_file = $template->getTemplateFileName('assets/fields/gmimages/themes/'.$this->getOption('theme_item'));
        ob_start();
        include($tpl_file);
        $html = ob_get_clean();

		   
	
        return $html;

    }

    public function getStringValue($value){ return ''; }

    public function store($value, $is_submitted, $old_value=null){

		if (!is_array($old_value)){
			$old_value = cmsModel::yamlToArray($old_value);
		}

        foreach($old_value as $old_image){
            if (!is_array($value) || !in_array($old_image, $value)){
                foreach($old_image as $size => $image_rel_path){
                    files_delete_file($image_rel_path, 2);
                }
            }
        }

        $result = [];

        if (is_array($value)){
            foreach ($value as $paths){ $result[] = $paths; }
        }

        if (empty($result)) { return null; }

        $sizes = $this->getOption('sizes');
        if (empty($sizes)) {
            $this->delete($result); return null;
        }

        $results = [];

        $upload_path = cmsConfig::get('upload_path');

        foreach($result as $key => $image){

            $images = [];

            foreach($image as $size => $image_rel_path){

                $image_rel_path = str_replace(['"', "'", ' ', '#'], '', html_entity_decode($image_rel_path));

                if(!is_file($upload_path.$image_rel_path)){
                    continue;
                }

                // удаляем ненужные пресеты, если умельцы правили параметры вручную
                if (!in_array($size, $sizes)){
                    files_delete_file($image_rel_path, 2); continue;
                }

                $images[$size] = $image_rel_path;

            }

            if($images){
                $results[$key] = $images;
            }

        }

        if (empty($results)) { return null; }

        // удаляем, если вдруг каким-то образом загрузили больше
        // js тоже регулирует этот параметр
        if(!empty($this->options['max_photos']) && count($results) > $this->options['max_photos']){

            $chunks = array_chunk($results, $this->options['max_photos'], true);
            $results = $chunks[0]; unset($chunks[0]);

            foreach ($chunks as $chunk) {
                $this->delete($chunk);
            }

        }

        return $results;
    }

    public function getFiles($value){

        if (empty($value)) { return false; }

        if (!is_array($value)){ $value = cmsModel::yamlToArray($value); }

        $files = [];

        foreach($value as $images){
            foreach($images as $image_rel_path){
                $files[] = $image_rel_path;
            }
        }

        return $files;
    }

    public function delete($value) {

        if (empty($value)) { return true; }

        if (!is_array($value)) {
            $value = cmsModel::yamlToArray($value);
        }

        $files_model = cmsCore::getModel('files');

        foreach ($value as $images) {
            foreach ($images as $image_rel_path) {
                $file = $files_model->getFileByPath($image_rel_path);
                if (!$file) {
                    files_delete_file($image_rel_path, 2);
                    continue;
                }

                $files_model->deleteFile($file['id']);
            }
        }

        return true;
    }

    public function getFilterInput($value = false) {
        return html_checkbox($this->name, (bool) $value);
    }

    public function applyFilter($model, $value) {
        return $model->filterNotNull($this->name);
    }

    public function getInput($value){

        $this->data['images'] = false;

        if($value){
            $this->data['images'] = is_array($value) ? $value : cmsModel::yamlToArray($value);
        }

        $this->data['id'] = $this->id;
        $this->data['sizes'] = $this->getOption('sizes');
        $this->data['allow_import_link'] = $this->getOption('allow_import_link');
        $this->data['max_photos'] = $this->getOption('max_photos');

        $this->data['images_controller'] = cmsCore::getController('images', new cmsRequest($this->context_params, cmsRequest::CTX_INTERNAL));

        return parent::getInput($value);
    }

}
