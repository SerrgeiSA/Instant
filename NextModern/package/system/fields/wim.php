<?php

class fieldWim extends cmsFormField {

    public $title       = 'Виджет изображения';
    public $sql         = 'text';
    public $allow_index = false;
	public $is_public = false;
    public $var_type    = 'array';


    public function getOptions(){

        return array(
            new fieldList('size_teaser', array(
                'title' => LANG_PARSER_IMAGE_SIZE_TEASER,
                'default' => 'small',
                'generator' => function (){
                    $presets = cmsCore::getModel('images')->getPresetsList();
                    $presets['original'] = LANG_PARSER_IMAGE_SIZE_ORIGINAL;
                    return $presets;
                }
            )),
            new fieldList('size_full', array(
                'title' => LANG_PARSER_IMAGE_SIZE_FULL,
                'default' => 'big',
                'generator' => function (){
                    $presets = cmsCore::getModel('images')->getPresetsList();
                    $presets['original'] = LANG_PARSER_IMAGE_SIZE_ORIGINAL;
                    return $presets;
                }
            )),
            new fieldList('size_small', array(
                'title'   => LANG_PARSER_SMALL_IMAGE_PRESET,
                'default' => 'small',
                'generator' => function (){
                    $presets = cmsCore::getModel('images')->getPresetsList();
                    $presets['original'] = LANG_PARSER_IMAGE_SIZE_ORIGINAL;
                    return $presets;
                }
            )),
            new fieldListMultiple('sizes', array(
                'title' => LANG_PARSER_IMAGE_SIZE_UPLOAD,
                'default' => 0,
                'generator' => function (){
                    $presets = cmsCore::getModel('images')->getPresetsList();
                    $presets['original'] = LANG_PARSER_IMAGE_SIZE_ORIGINAL;
                    return $presets;
                }
            )),
            new fieldCheckbox('allow_import_link', array(
                'title' => LANG_PARSER_IMAGE_ALLOW_IMPORT_LINK
            )),
            new fieldCheckbox('first_image_emphasize', array(
                'title' => LANG_PARSER_FIRST_IMAGE_EMPHASIZE
            )),
            new fieldNumber('max_photos', array(
                'title' => LANG_PARSER_IMAGE_MAX_COUNT
            ))
        );

    }



    public function store($value, $is_submitted, $old_value=null){

		if (!is_array($old_value)){
			$old_value = cmsModel::yamlToArray($old_value);
		}

        foreach($old_value as $old_image){
            if (!is_array($value) || !in_array($old_image, $value)){
                foreach($old_image as $size => $image_rel_path){				
                    $this->delete_file($image_rel_path, 2);
                }
            }
        }

        $result = null;

        if (is_array($value)){
            $result = array();
            foreach ($value as $paths){ $result[] = $paths; }
        }

        if (empty($result)) { return $result; }

        $sizes = $this->getOption('sizes');
        if (empty($sizes)) {
            $this->delete($result); return $result;
        }

        foreach($result as $key => $image){
            foreach($image as $size => $image_rel_path){				
                // удаляем ненужные пресеты, если умельцы правили параметры вручную
                if (!in_array($size, $sizes)){
                    $this->delete_file($image_rel_path, 2); unset($image[$size]);
                }
            }
            $result[$key] = $image;
        }

        // удаляем, если вдруг каким-то образом загрузили больше
        // js тоже регулирует этот параметр
        if(!empty($this->options['max_photos']) && count($result) > $this->options['max_photos']){

            $chunks = array_chunk($result, $this->options['max_photos'], true);
            $result = $chunks[0]; unset($chunks[0]);

            foreach ($chunks as $chunk) {
                $this->delete($chunk);
            }

        }

        return $result;

    }

    public function delete($value){

        if (empty($value)) { return true; }

        if (!is_array($value)){ $value = cmsModel::yamlToArray($value); }

        foreach($value as $size=>$images){						      
				
            foreach($images as $image_rel_path){
                $this->delete_file($image_rel_path, 2);
            }
        }

        return true;

    }

    public function getFilterInput($value=false) {

        return html_checkbox($this->name, (bool)$value);

    }

    public function applyFilter($model, $value) {
        return $model->filterNotNull($this->name);
    }

    public function getInput($value){

        $this->data['images'] = false;

        if($value){
            $this->data['images'] = is_array($value) ? $value : cmsModel::yamlToArray($value);
        }

        $this->data['sizes'] = $this->getOption('sizes');
        $this->data['allow_import_link'] = $this->getOption('allow_import_link');
        $this->data['max_photos'] = $this->getOption('max_photos');

        return parent::getInput($value);

    }
	   
	   public function getMultiUploadWidget($name, $images = false, $sizes = false, $allow_import_link = false, $max_photos = 0){

        $dom_id = str_replace(array('[',']'), array('_l_', '_r_'), $name);

		if($sizes=="widget"){
			// убераем url для виджета, чтобы потом составить её из настроек пресетов
			$upload_url = '';
			
		}else{
			
        $upload_url = href_to('images', 'upload', $dom_id);
        if (is_array($sizes)) {
            $upload_url .= '?sizes=' . implode(',', $sizes);
        }
		
		}
		
        $template = cmsTemplate::getInstance();
        return $template->renderAsset('/fields/wim/form', array(
            'name'              => $name,
            'images'            => $images,
            'sizes'             => $sizes,
            'upload_url'        => $upload_url,
            'dom_id'            => $dom_id,
            'max_photos'        => (int)$max_photos,
            'allow_import_link' => $allow_import_link
        ));

    }
	
	/**
 * Удаляет файл и его родительские директории
 * @param string $file_path Отностительный или полный путь к файлу
 * @param integer $delete_parent_dir Количество родительских директорий, которые нужно также удалить, если они пустые
 * @return boolean
 */
public function delete_file($file_path, $delete_parent_dir = 0) {

    if(!is_array($file_path) && !is_file($file_path)){
        $file_path = cmsConfig::get('upload_path') . $file_path;
    }

    $success = @unlink($file_path);

    if($delete_parent_dir && $success){

        $parent_dir = pathinfo($file_path, PATHINFO_DIRNAME);

        for ($i = 1; $i <= $delete_parent_dir; $i++) {

            if(!@rmdir($parent_dir)){ break; }

            $parent_dir = pathinfo($parent_dir, PATHINFO_DIRNAME);

        }

    }

    return $success;

}

}
