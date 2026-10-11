<?php

class fieldGMimagesGrid extends cmsFormField {

    public $title       = "NM: Сетка изображений";
    public $sql         = 'text';
    public $allow_index = false;
    public $var_type    = 'array';

    public function getOptions() {

        return array(
            new fieldList('size_teaser', array(
                'title'     => "Пресет фото в списке",
                'default'   => 'small',
                'generator' => function () {
                    $presets = cmsCore::getModel('images')->getPresetsList(true);
                    $presets['original'] = LANG_PARSER_IMAGE_SIZE_ORIGINAL;
                    return $presets;
                }
            )),

            new fieldList('size_small', array(
                'title'     => "Пресет фото в записи",
                'default'   => 'normal',
                'generator' => function () {
                    $presets = cmsCore::getModel('images')->getPresetsList(true);
                    $presets['original'] = LANG_PARSER_IMAGE_SIZE_ORIGINAL;
                    return $presets;
                }
            )),

            new fieldList('size_full', array(
                'title'     => "Пресет фото при просмотре",
                'default'   => 'big',
                'generator' => function () {
                    $presets = cmsCore::getModel('images')->getPresetsList(true);
                    $presets['original'] = LANG_PARSER_IMAGE_SIZE_ORIGINAL;
                    return $presets;
                }
            )),

            new fieldListMultiple('sizes', array(
                'title'     => LANG_PARSER_IMAGE_SIZE_UPLOAD,
                'default'   => 0,
                'generator' => function () {
                    $presets = cmsCore::getModel('images')->getPresetsList();
                    $presets['original'] = LANG_PARSER_IMAGE_SIZE_ORIGINAL;
                    return $presets;
                }
            )),

            new fieldCheckbox('clickable_photos_teaser', array(
                'title' => "кликабельные фото в списке"
            )),

          //  new fieldCheckbox('allow_import_link', array(
           //     'title' => LANG_PARSER_IMAGE_ALLOW_IMPORT_LINK
          //  )),

            new fieldNumber('container_width', array(
                'title'   => "Максимальная ширина контейнера в записи",
                'units'   => 'px',
                'default' => 320
            )),

            new fieldNumber('container_min_width', array(
                'title'   => "Минимальная ширина контейнера в записи",
                'units'   => 'px',
                'default' => 0
            )),

            new fieldNumber('container_teaser_width', array(
                'title'   => "Максимальная ширина контейнера в списке",
                'units'   => 'px',
                'default' => 64
            )),

            new fieldNumber('container_teaser_min_width', array(
                'title'   => "Минимальная ширина контейнера в списке",
                'units'   => 'px',
                'default' => 60
            )),

            new fieldNumber('margin_images', array(
                'title'   => "Расстояние между изображениями",
                'units'   => 'px',
                'default' => 2
            )),

            new fieldNumber('max_photos', array(
                'title'   => LANG_PARSER_IMAGE_MAX_COUNT,
                'default' => 10
            ))
        );
        
    }

    public function parse($value, $isTeaser = false) {

        $value = is_array($value) ? $value : cmsModel::yamlToArray($value);
        $clickable_photos = true;

        if ($isTeaser) {
            $clickable_photos    = $this->getOption('clickable_photos_teaser');
            $small_preset        = $this->getOption('size_teaser');
            $container_width     = $this->getOption('container_teaser_width');
            $container_min_width = $this->getOption('container_teaser_min_width');
        } else {
            $container_width     = $this->getOption('container_width');
            $container_min_width = $this->getOption('container_min_width');
            $small_preset        = $this->getOption('size_small');
        }    

        $full_preset  = $this->getOption('size_full');
        $margin       = $this->getOption('margin_images');
        $upload_path  = cmsConfig::get('upload_path');
        $thumbMosaic  = new ThumbMosaic($container_width, $margin);
        $thumbs       = array();

        foreach ($value as $item) {
            if (!isset($item[$small_preset])) { continue; }
            if (!is_file($upload_path . $item[$small_preset])) { continue; }

            $size = getimagesize($upload_path . $item[$small_preset]);
            
            $thumb = array(
                'src'    => $item[$small_preset],
                'width'  => $size[0],
                'height' => $size[1]
            );

            if (isset($item[$full_preset])) {
                $size = getimagesize($upload_path . $item[$full_preset]);

                $thumb[$full_preset] = array(
                    'src'    => $item[$full_preset],
                    'width'  => $size[0],
                    'height' => $size[1]
                );
            }

            $thumbs[] = $thumb;
        }

        if (!count($thumbs)) {
            return '';
        }

        list(
            $thumbs,
            $container_height,
            $container_width
        ) = $thumbMosaic->processThumbs($thumbs);

        return cmsTemplate::getInstance()->getRenderedAsset('fields/gmimagesgrid/field_imagesgrid', array(
            'container_min_width' => $container_min_width,
            'clickable_photos' => $clickable_photos,
            'container_height' => $container_height,
            'container_width' => $container_width,
            'full_preset' => $full_preset,
            'uniqueKey' => string_random(8),
            'thumbs' => $thumbs,
            'margin' => $margin
        ));

    }

    public function parseTeaser($value) {

        return $this->parse($value, true);

    }

    public function store($value, $is_submitted, $old_value = null) {

        if (!is_array($old_value)) {
            $old_value = cmsModel::yamlToArray($old_value);
        }

        foreach ($old_value as $old_image) {
            if (!is_array($value) || !in_array($old_image, $value)) {
                foreach ($old_image as $size => $image_rel_path) {
                    files_delete_file($image_rel_path, 2);
                }
            }
        }

        $result = array();

        if (is_array($value)) {
            foreach ($value as $paths) {
                $result[] = $paths;
            }
        }

        if (empty($result)) {
            return null;
        }

        $sizes = $this->getOption('sizes');
        if (empty($sizes)) {
            $this->delete($result);
            return null;
        }

        $results = array();

        $upload_path = cmsConfig::get('upload_path');

        foreach ($result as $key => $image) {

            $images = array();

            foreach ($image as $size => $image_rel_path) {

                $image_rel_path = str_replace(array('"', "'", ' ', '#'), '', html_entity_decode($image_rel_path));

                if (!is_file($upload_path . $image_rel_path)) {
                    continue;
                }

                if (!in_array($size, $sizes)) {
                    files_delete_file($image_rel_path, 2);
                    continue;
                }

                $images[$size] = $image_rel_path;
            }

            if ($images) {
                $results[$key] = $images;
            }
        }

        if (empty($results)) {
            return null;
        }

        if (!empty($this->options['max_photos']) && count($results) > $this->options['max_photos']) {

            $chunks = array_chunk($results, $this->options['max_photos'], true);
            $results = $chunks[0];
            unset($chunks[0]);

            foreach ($chunks as $chunk) {
                $this->delete($chunk);
            }
        }

        return $results;

    }

    public function delete($value) {

        if (empty($value)) {
            return true;
        }

        if (!is_array($value)) {
            $value = cmsModel::yamlToArray($value);
        }

        foreach ($value as $images) {
            foreach ($images as $image_rel_path) {
                files_delete_file($image_rel_path, 2);
            }
        }

        return true;

    }

    public function getFilterInput($value = false) {

        return html_checkbox($this->name, (bool)$value);

    }

    public function applyFilter($model, $value) {

        return $model->filterNotNull($this->name);

    }

    public function getInput($value) {

        $this->data['images'] = false;

        if ($value) {
            $this->data['images'] = is_array($value) ? $value : cmsModel::yamlToArray($value);
        }

        $this->data['sizes'] = $this->getOption('sizes');
       // $this->data['allow_import_link'] = $this->getOption('allow_import_link');
	    $this->data['allow_import_link'] = false;
        $this->data['max_photos'] = $this->getOption('max_photos');

        $this->data['images_controller'] = cmsCore::getController('images');

        return parent::getInput($value);

    }

}

class ThumbMosaic {

    private $containerWidth;
    private $containerHeight;

    private $margin;
    private $heightRatio = 0.86;

    public function __construct($maxWidth, $margin = 5) {
        $this->containerWidth  = $maxWidth;
        $this->containerHeight = round($maxWidth * $this->heightRatio);
        $this->margin          = $margin;
    }

    public function processThumbs ($thumbs) {
        
        $items        = array();
        $ratios       = array();
        $letterRatios = '';

        foreach ($thumbs as $key => $thumb) {
            $ratio = $this->getRatio($thumb);
            $letterRatio = $ratio > 1.2 ? "w" : ($ratio < 0.8 ? "n" : "q");
            $letterRatios .= $letterRatio;
            $ratios[] = $ratio;
            $thumbs[$key]['ratio'] = $ratio;
        }

        $averageRatio = count($ratios) ? $this->amountRatios($ratios) / count($ratios) : 1;
        $containerRatio = $this->containerWidth / $this->containerHeight;

        if (count($thumbs) === 1) {
            $thumbRatio = $ratios[0];
            $thumbWidth = 0;
            $thumbHeight = 0;

            if ($thumbRatio >= $containerRatio) {
                $thumbWidth  = $this->containerWidth;
                $thumbHeight = round(min($thumbWidth / $thumbRatio, $this->containerHeight));
                $this->containerHeight = $thumbHeight;
            } else {
                $thumbHeight = $this->containerHeight;
                $thumbWidth  = round(min($thumbHeight * $thumbRatio, $this->containerWidth));
                $this->containerWidth = $thumbWidth;
            }

            $items[] = array_merge($thumbs[0], array(
                'width'      => $thumbWidth,
                'height'     => $thumbHeight,
                'single'     => true,
                'lastRow'    => true,
                'lastColumn' => true
            ));
        } else if (count($thumbs) === 2) {
            switch ($letterRatios) {
                case "ww": {
                    if ($averageRatio >= 1.4 * $containerRatio && $ratios[1] - $ratios[0] < 0.2) {
                        $thumbWidth  = $this->containerWidth;
                        $thumbHeight = round(min($thumbWidth / $ratios[0], $thumbWidth / $ratios[1], ($this->containerHeight - $this->margin) / 2));

                        $this->containerHeight = round(2 * $thumbHeight + $this->margin);

                        for ($i = 0; $i < count($thumbs); $i++) {
                            $items[] = array_merge($thumbs[$i], array(
                                'width'      => $thumbWidth,
                                'height'     => $thumbHeight,
                                'lastRow'    => $i === 1,
                                'lastColumn' => true
                            ));
                        }

                        break;
                    }
                }

                case "nn":
                case "qn":
                case "nq":
                case "qq": {
                    $thumbWidth  = floor(($this->containerWidth - $this->margin) / 2);
                    $thumbHeight = round(min($thumbWidth / $ratios[0], $thumbWidth / $ratios[1], $this->containerHeight));

                    $this->containerHeight = $thumbHeight;
                    $this->containerWidth  = $thumbWidth * 2 + $this->margin;

                    for ($i = 0; $i < count($thumbs); $i++) {
                        $items[] = array_merge($thumbs[$i], array(
                            'width'      => $thumbWidth,
                            'height'     => $thumbHeight,
                            'lastRow'    => true,
                            'lastColumn' => $i === 1
                        ));
                    }

                    break;
                }

                default: {
                    $thumbWidth = array();

                    $thumbWidth[0] = round(($this->containerWidth - $this->margin) / $ratios[1] / (1 / $ratios[0] + 1 / $ratios[1]));
                    $thumbWidth[1] = $this->containerWidth - $thumbWidth[0] - $this->margin;

                    $thumbHeight = round(min($this->containerHeight, $thumbWidth[0] / $ratios[0], $thumbWidth[1] / $ratios[1]));

                    $this->containerHeight = $thumbHeight;

                    for ($i = 0; $i < count($thumbs); $i++) {
                        $items[] = array_merge($thumbs[$i], array(
                            'width'      => $thumbWidth[$i],
                            'height'     => $thumbHeight,
                            'lastRow'    => true,
                            'lastColumn' => $i === 1
                        ));
                    }
                }
            }
        } else if (count($thumbs) === 3) {
            if (($ratios[0] > 1.2 * $containerRatio || $averageRatio > 1.5 * $containerRatio) && $letterRatios == "www") {
                $thumbWidth = array();
                $thumbHeight = array();

                $thumbWidth[0]  = $this->containerWidth;
                $thumbHeight[0] = round(min($thumbWidth[0] / $ratios[0], 0.66 * ($this->containerHeight - $this->margin)));

                if ($letterRatios == "www") {
                    $thumbWidth[1] = $thumbWidth[2] = floor(($this->containerWidth - $this->margin) / 2);
                    $thumbHeight[1] = $thumbHeight[2] = round(min($this->containerHeight - $thumbHeight[0] - $this->margin, $thumbWidth[1] / $ratios[1], $thumbWidth[2] / $ratios[2]));
                } else {
                    $thumbWidth[1] = round(($this->containerWidth - $this->margin) / $ratios[2] / (1 / $ratios[1] + 1 / $ratios[2]));
                    $thumbWidth[2] = $this->containerWidth - $thumbWidth[1] - $this->margin;
                    $thumbHeight[1] = $thumbHeight[2] = round(min($this->containerHeight - $thumbHeight[0] - $this->margin, $thumbWidth[2] / $ratios[2], $thumbWidth[1] / $ratios[1]));
                }

                $this->containerHeight = $thumbHeight[0] + $thumbHeight[1] + $this->margin;

                for ($i = 0; $i < count($thumbs); $i++) { 
                    $items[] = array_merge($thumbs[$i], array(
                        'width' => $thumbWidth[$i],
                        'height' => $thumbHeight[$i],
                        'lastRow' => $i !== 0,
                        'lastColumn' => $i !== 1
                    ));
                }
            } else {
                $thumbWidth = array();
                $thumbHeight = array();

                $thumbHeight[0] = $this->containerHeight;
                $thumbWidth[0]  = floor(min($thumbHeight[0] * $ratios[0], 0.75 * ($this->containerWidth - $this->margin)));

                $thumbHeight[1] = round($ratios[1] * ($this->containerHeight - $this->margin) / ($ratios[2] + $ratios[1]));
                $thumbHeight[2] = $this->containerHeight - $thumbHeight[1] - $this->margin;
                $thumbWidth[1]  = $thumbWidth[2] = floor(min($this->containerWidth - $thumbWidth[0] - $this->margin, $thumbHeight[2] * $ratios[2], $thumbHeight[1] * $ratios[1]));

                $this->containerHeight = $thumbHeight[0];
                $this->containerWidth  = $thumbWidth[0] + $thumbWidth[1] + $this->margin;

                for ($i = 0; $i < count($thumbs); $i++) {
                    $items[] = array_merge($thumbs[$i], array(
                        'width'     => $thumbWidth[$i],
                        'height'    => $thumbHeight[$i],
                        'lastRow'   => $i !== 1,
                        'lastColumn'=> $i !== 0
                    ));
                }
            }
        } else if (count($thumbs) === 4) {
            if (($ratios[0] > 1.2 * $containerRatio || $averageRatio > 1.5 * $containerRatio) && $letterRatios == "wwww") {
                $thumbWidth  = array();
                $thumbHeight = array();

                $thumbWidth[0]  = $this->containerWidth;
                $thumbHeight[0] = round(min($thumbWidth[0] / $ratios[0], 0.66 * ($this->containerHeight - $this->margin)));

                $height = round(($this->containerWidth - 2 * $this->margin) / ($ratios[1] + $ratios[2] + $ratios[3]));

                $thumbWidth[1] = floor($height * $ratios[1]);
                $thumbWidth[2] = floor($height * $ratios[2]);
                $thumbWidth[3] = floor($height * $ratios[3]);

                $height = min($this->containerHeight - $thumbHeight[0] - $this->margin, $height);

                $thumbHeight[1] = $thumbHeight[2] = $thumbHeight[3] = $height;

                $this->containerHeight = $thumbHeight[0] + $height + $this->margin;

                for ($i = 0; $i < count($thumbs); $i++) {
                    $items[] = array_merge($thumbs[$i], array(
                        'width'      => $thumbWidth[$i],
                        'height'     => $thumbHeight[$i],
                        'lastRow'    => $i !== 0,
                        'lastColumn' => $i === 0 || $i === 3
                    ));
                }
            } else {
                $thumbWidth = array();
                $thumbHeight = array();

                $thumbHeight[0] = $this->containerHeight;
                $thumbWidth[0]  = round(min($thumbHeight[0] * $ratios[0], 0.66 * ($this->containerWidth - $this->margin)));

                $width = round(($this->containerHeight - 2 * $this->margin) / (1 / $ratios[1] + 1 / $ratios[2] + 1 / $ratios[3]));

                $thumbHeight[1] = round($width / $ratios[1]);
                $thumbHeight[2] = round($width / $ratios[2]);
                $thumbHeight[3] = round($width / $ratios[3]);

                $width = min($this->containerWidth - $thumbWidth[0] - $this->margin, $width);

                $thumbWidth[1] = $thumbWidth[2] = $thumbWidth[3] = $width;

                $this->containerWidth  = $thumbWidth[0] + $width + $this->margin;
                $this->containerHeight = $thumbHeight[0] = $thumbHeight[1] + $thumbHeight[2] + $thumbHeight[3] + 2 * $this->margin;

                for ($i = 0; $i < count($thumbs); $i++) {
                    $items[] = array_merge($thumbs[$i], array(
                        'width'      => $thumbWidth[$i],
                        'height'     => $thumbHeight[$i],
                        'lastRow'    => $i === 0 || $i === 3,
                        'lastColumn' => $i !== 0
                    ));
                }
            }
        } else {
            $ratios_cropped = array();

            foreach ($ratios as $ratio) {
                if ($averageRatio > 1.1) {
                    array_push($ratios_cropped, max(1, $ratio));
                } else {
                    array_push($ratios_cropped, min(1, $ratio));
                }
            }

            $tries = array();
            $first_line = 0;
            $second_line = 0;

            $tries[count($thumbs)] = array(
                $this->calculateMultiThumbsHeight($ratios_cropped, $this->containerWidth, $this->margin)
            );

            for ($first_line = 1; $first_line <= count($thumbs) - 1; $first_line++) {
                $key = $first_line.','.($second_line = (count($thumbs) - $first_line));
                $tries[$key] = array(
                    $this->calculateMultiThumbsHeight(array_slice($ratios_cropped, 0, $first_line), $this->containerWidth, $this->margin),
                    $this->calculateMultiThumbsHeight(array_slice($ratios_cropped, $first_line), $this->containerWidth, $this->margin)
                );
            }

            for ($first_line = 1; $first_line <= count($thumbs) - 2; $first_line++) {
                for ($second_line = 1; $second_line <= count($thumbs) - $first_line - 1; $second_line++) {
                    $key = $first_line.','.$second_line.','.(count($thumbs) - $first_line - $second_line);
                    $tries[$key] = array(
                        $this->calculateMultiThumbsHeight(array_slice($ratios_cropped, 0, $first_line), $this->containerWidth, $this->margin),
                        $this->calculateMultiThumbsHeight(array_slice($ratios_cropped, $first_line, $first_line + $second_line), $this->containerWidth, $this->margin),
                        $this->calculateMultiThumbsHeight(array_slice($ratios_cropped, $first_line + $second_line), $this->containerWidth, $this->margin)
                    );
                }
            }

            $opt_conf = null;
            $opt_diff = 0;
            $opt_h = 0;

            $keys = array_keys($tries);

            foreach ($keys as $key) {
                $heights = $tries[$key];
                $conf_h = $this->amountRatios($heights) + $this->margin * (count($heights) - 1);
                $conf_diff = abs($conf_h - $this->containerHeight);

                if (strpos($key, ',') !== false) {
                    $conf_nums = array_map(function ($num) {
                        return intval($num);
                    }, explode(',', $key));

                    if ($conf_nums[0] > $conf_nums[1] || count($conf_nums) > 2 && $conf_nums[1] > $conf_nums[2]) {
                        $conf_diff += 50;
                        $conf_diff *= 1.5;
                    }

                    // TODO
                    if (min($conf_nums) < 1) {
                        $conf_diff += 100;
                        $conf_diff *= 3;
                    }
                }

                if ($opt_conf === null || $conf_diff < $opt_diff) {
                    $opt_conf = $key;
                    $opt_diff = $conf_diff;
                    $opt_h = $conf_h;
                }
            }

            $this->containerHeight = round($opt_h);

            $chunks = explode(',', $opt_conf);
            $opt_heights = $tries[$opt_conf];
            $last_row = count($chunks) - 1;
            $k = 0;

            for ($i = 0; $i < count($chunks); $i++) {
                $line_chunks_num = intval($chunks[$i]);
                $line_thumbs = array();

                for ($j = 0; $j < $line_chunks_num; $j++) {
                    $line_thumbs[] = array_shift($thumbs);
                }

                $line_height = round($opt_heights[$k]);
                $k++;
                $last_column = count($line_thumbs) - 1;

                $amount_width = 0;

                for ($j = 0; $j < count($line_thumbs); $j++) {
                    $thumb = $line_thumbs[$j];
                    $thumb_ratio = array_shift($ratios_cropped);

                    $thumb_width = round($thumb_ratio * $line_height);

                    if ($j === $last_column) {
                        $thumb_width = $this->containerWidth - $amount_width;
                    } else {
                        $amount_width += $thumb_width + $this->margin;
                    }

                    $items[] = array_merge($thumb, array(
                        'width'      => $thumb_width,
                        'height'     => $line_height,
                        'lastRow'    => $i === $last_row,
                        'lastColumn' => $j === $last_column
                    ));
                }
            }
        }

        return array(
            $items,
            $this->containerHeight,
            $this->containerWidth
        );

    }

    public function amountRatios($ratios) {
        $amount = 0;
        foreach ($ratios as $ratio) {
            $amount += $ratio;
        }
        return $amount;
    }

    public function getRatio($thumb) {
        return $thumb['width'] / $thumb['height'];
    }

    private function calculateMultiThumbsHeight($ratios, $width, $margin) {
        return round(($width - (count($ratios) - 1) * $margin) / $this->amountRatios($ratios));
    }

}
