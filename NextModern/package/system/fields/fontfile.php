<?php

class fieldFontFile extends cmsFormField {

    public $title = 'Файл шрифта';
    public $sql   = 'text';
	
	public $is_public = false;

    private $validate_error = true;

    public function getOptions() {
        $max_size = files_convert_bytes(ini_get('post_max_size')) / 1048576;
        return [
            new fieldList('show_name', [
                'title'   => LANG_PARSER_FILE_LABEL,
                'default' => 1,
                'items'   => [
                    0 => LANG_PARSER_FILE_LABEL_GET,
                    1 => LANG_PARSER_FILE_LABEL_NAME
                ],
                'extended_option' => true
            ]),
            new fieldString('extensions', [
                'title' => LANG_PARSER_FILE_EXTS,
                'hint'  => LANG_PARSER_FILE_EXTS_HINT
            ]),
            new fieldNumber('max_size_mb', [
                'title' => LANG_PARSER_FILE_MAX_SIZE,
                'hint'  => sprintf(LANG_PARSER_FILE_MAX_SIZE_PHP, $max_size)
            ]),
            new fieldCheckbox('show_size', [
                'title'           => LANG_PARSER_FILE_SHOW_SIZE,
                'extended_option' => true
            ]),
            new fieldCheckbox('show_counter', [
                'title'           => LANG_PARSER_FILE_SHOW_COUNTER,
                'extended_option' => true
            ])
        ];
    }

    public function getRules() {

        $this->rules[] = ['file'];

        return $this->rules;
    }

    public function parse($value) {
		

		return ;
		
		
    }

    public function getStringValue($value) {
        return '';
    }

    public function getDownloadURL($file) {
        return href_to('files', 'download', [$file['id'], files_user_file_hash($file['path'])]);
    }

    public function store($value, $is_submitted, $old_value = null) {

        $files_model = cmsCore::getModel('files');

        if ($value && $old_value) {

            $this->delete($old_value);

            $old_value = null;
        }

        $uploader = new cmsUploader();
        $core = cmsCore::getInstance();

        if (!$uploader->isUploaded($this->name)) {
            return $old_value;
        }

        $allowed_extensions = $this->getOption('extensions');
        $max_size_mb        = $this->getOption('max_size_mb');

        if (!trim($allowed_extensions)) {
            $allowed_extensions = false;
        }
        if (!$max_size_mb) {
            $max_size_mb = 0;
        }

        $result = $uploader->upload($this->name, $allowed_extensions, $max_size_mb * 1048576);

        if (!$result['success']) {
            if (!empty($result['path'])) {
                $uploader->remove($result['path']);
            }
            $this->validate_error = $result['error'];
            return null;
        }

        $context = $core->getUriData();
        $upload_params = [];

        if ($context['controller']) {
            $upload_params['target_controller'] = $context['controller'];
        }
        if ($context['action']) {
            $upload_params['target_subject'] = $context['action'];
        }
        if (strpos($core->uri, '/add/') === false && !empty($context['params'][0]) && is_numeric($context['params'][0])) {
            $upload_params['target_id'] = $context['params'][0];
        }

        $file_id = $files_model->registerFile(array_merge($upload_params, [
            'path'    => $result['url'],
            'name'    => $result['name'],
            'user_id' => cmsUser::get('id')
        ]));

        return [
            'id'   => $file_id,
            'name' => $result['name'],
            'size' => $result['size'],
            'path' => $result['url']
        ];
    }

    public function getFiles($value) {

        if (empty($value)) {
            return false;
        }

        if (!is_array($value)) {
            $value = cmsModel::yamlToArray($value);
        }

        return [$value['path']];
    }

    public function delete($value) {

        if (empty($value)) { return true; }

        if (!is_array($value)) {
            $value = cmsModel::yamlToArray($value);
        }

        cmsCore::getModel('files')->deleteFile($value['id']);

        return true;
    }

    public function getFilterInput($value = false) {
        return ($this->show_filter_input_title ? '<label for="' . $this->id . '">' . $this->title . '</label>' : '') .
                html_checkbox($this->name, (bool) $value);
    }

    public function applyFilter($model, $value) {
        return $model->filterNotNull($this->name);
    }

    public function getInput($value) {

        $this->data['attributes'] = $this->getProperty('attributes') ?: [];

        $this->data['attributes']['class']    = 'custom-file-input';
        $this->data['attributes']['id']       = $this->id;
        $this->data['attributes']['required'] = !$value && (array_search(['required'], $this->getRules()) !== false);

        $this->data['allowed_extensions'] = $this->getOption('extensions');
        $this->data['max_size_mb']        = $this->getOption('max_size_mb');

        if ($this->data['max_size_mb']) {
            $this->data['max_size_mb'] *= 1048576;
        } else {
            $this->data['max_size_mb'] = files_convert_bytes(ini_get('post_max_size'));
        }
		$file = is_array($value) ? $value : cmsModel::yamlToArray($value); 
		$this->data['font_info']   = !empty($file) ? (new TTFInfo())->setFontFile('upload/'.$file['path'])->getFontInfo() : '';

        return parent::getInput($value);
    }

    public function validate_file($value) {
        return $this->validate_error;
    }

    public function validate_required($value) {
        if (is_string($this->validate_error)) {
            return $this->validate_error;
        }
        if (empty($value)) { return ERR_VALIDATE_REQUIRED; }
        return true;
    }
	
	
}
	
// Optional: Set namespace according to your project structure
// namespace App\MyClasses;
/**
 * ttfInfo class
 * Retrieve data stored in a TTF files 'name' table
 *
 * @original author Unknown
 * found at http://www.phpclasses.org/browse/package/2144.html
 * @edited by Husam Aamer
 *
 * @ported for used on http://www.nufont.com
 * @author Jason Arencibia
 * @version 0.2
 * @copyright (c) 2006 GrayTap Media
 * @website http://www.graytap.com
 * @license GPL 2.0
 * @access public
 *
 * @todo: Make it Retrieve additional information from other tables
 *
 */
class TTFInfo {
    const NAME_COPYRIGHT          = 0;
    const NAME_NAME               = 1;
    const NAME_SUBFAMILY          = 2;
    const NAME_SUBFAMILY_ID       = 3;
    const NAME_FULL_NAME          = 4;
    const NAME_VERSION            = 5;
    const NAME_POSTSCRIPT_NAME    = 6;
    const NAME_TRADEMARK          = 7;
    const NAME_MANUFACTURER       = 8;
    const NAME_DESIGNER           = 9;
    const NAME_DESCRIPTION        = 10;
    const NAME_VENDOR_URL         = 11;
    const NAME_DESIGNER_URL       = 12;
    const NAME_LICENSE            = 13;
    const NAME_LICENSE_URL        = 14;
    const NAME_PREFERRE_FAMILY    = 16;
    const NAME_PREFERRE_SUBFAMILY = 17;
    const NAME_COMPAT_FULL_NAME   = 18;
    const NAME_SAMPLE_TEXT        = 19;

    /**
     * variable $_dirRestriction
     * Restrict the resource pointer to this directory and above.
     * Change to 1 for to allow the class to look outside of it current directory
     * @protected
     * @var int
     */
    protected $_dirRestriction = 1;
    /**
     * variable $_dirRestriction
     * Restrict the resource pointer to this directory and above.
     * Change to 1 for nested directories
     * @protected
     * @var int
     */
    protected $_recursive = 0;

    /**
     * variable $fontsdir
     * This is to declare this variable as protected
     * don't edit this!!!
     * @protected
     */
    protected $fontsdir;
    /**
     * variable $filename
     * This is to declare this varable as protected
     * don't edit this!!!
     * @protected
     */
    protected $filename;

    /**
     * function setFontFile()
     * set the filename
     * @public
     * @param string $data the new value
     * @return object reference to this
     */
    public function setFontFile($data)
    {
        if ($this->_dirRestriction && preg_match('[\.\/|\.\.\/]', $data))
        {
            $this->exitClass('Error: Directory restriction is enforced!');
        }

        $this->filename = $data;
        return $this;
    } // public function setFontFile

    /**
     * function setFontsDir()
     * set the Font Directory
     * @public
     * @param string $data the new value
     * @return object referrence to this
     */
    public function setFontsDir($data)
    {
        if ($this->_dirRestriction && preg_match('[\.\/|\.\.\/]', $data))
        {
            $this->exitClass('Error: Directory restriction is enforced!');
        }

        $this->fontsdir = $data;
        return $this;
    } // public function setFontsDir

    /**
     * function readFontsDir()
     * @public
     * @return information contained in the TTF 'name' table of all fonts in a directory.
     */
    public function readFontsDir()
    {
        if (empty($this->fontsdir)) { $this->exitClass('Error: Fonts Directory has not been set with setFontsDir().'); }
        if (empty($this->backupDir)){ $this->backupDir = $this->fontsdir; }

        $this->array = array();
        $d = dir($this->fontsdir);

        while (false !== ($e = $d->read()))
        {
            if($e != '.' && $e != '..')
            {
                $e = $this->fontsdir . $e;
                if($this->_recursive && is_dir($e))
                {
                    $this->setFontsDir($e);
                    $this->array = array_merge($this->array, readFontsDir());
                }
                else if ($this->is_ttf($e) === true)
                {
                    $this->setFontFile($e);
                    $this->array[$e] = $this->getFontInfo();
                }
            }
        }

        if (!empty($this->backupDir)){ $this->fontsdir = $this->backupDir; }

        $d->close();
        return $this;
    } // public function readFontsDir

    /**
     * function setProtectedVar()
     * @public
     * @param string $var the new variable
     * @param string $data the new value
     * @return object reference to this

     * DISABLED, NO REAL USE YET

    public function setProtectedVar($var, $data)
    {
    if ($var == 'filename')
    {
    $this->setFontFile($data);
    } else {
    //if (isset($var) && !empty($data))
    $this->$var = $data;
    }
    return $this;
    }
     */





    /*
     *
     *
  Examples of font info
  1 => "Abhaya Libre ExtraBold"
  2 => "Regular"
  3 => "1.050;;AbhayaLibre-ExtraBold"
  4 => "Abhaya Libre ExtraBold"
  5 => "Version 1.050 ; ttfautohint (v1.6)"
  6 => "AbhayaLibre-ExtraBold"
  7 => "Abhaya is a trademark of Pushpananda Ekanayake."
  8 => "Mooniak"
  9 => "Pushpananda Ekanayake, Sol Matas, Pathum Egodawatta"
  11 => "http://mooniak.com/type"
  13 => "This Font Software is licensed under the SIL Open Font License, Version 1.1. This license is available with a FAQ at: http://scripts.sil.org/OFL"
  14 => "http://scripts.sil.org/OFL"

    Ex2
  1 => "Skia"
  2 => "Regular"
  3 => "Skia; 13.0d1e54; 2017-06-21"
  4 => "Skia"
  5 => "13.0d1e54"
  6 => "Skia-Regular"
    ..
    .

    Ex3
  1 => "Farisi"
  2 => "Regular"
  3 => "Farisi Regular; 13.0d1e3; 2017-06-13"
  4 => "Farisi Regular"
  5 => "13.0d1e3"
  6 => "Farisi"
  256 => "Features Enabled"
  257 => "Features Enabled"
  258 => "Ligatures"
  259 => "Required Ligatures"
  260 => "Farisi Ligatures"


     */
    /**
     * function getFontInfo()
     * @public
     * @return information contained in the TTF 'name' table.
     */
    public function getFontInfo()
    {
        $fd = fopen ($this->filename, "r");
        $this->text = fread ($fd, filesize($this->filename));
        fclose ($fd);

        $number_of_tables = hexdec($this->dec2ord($this->text[4]).$this->dec2ord($this->text[5]));

        for ($i=0;$i<$number_of_tables;$i++)
        {
            $tag = $this->text[12+$i*16].$this->text[12+$i*16+1].$this->text[12+$i*16+2].$this->text[12+$i*16+3];

            if ($tag == 'name')
            {
                $this->ntOffset = hexdec(
                    $this->dec2ord($this->text[12+$i*16+8]).$this->dec2ord($this->text[12+$i*16+8+1]).
                    $this->dec2ord($this->text[12+$i*16+8+2]).$this->dec2ord($this->text[12+$i*16+8+3]));

                $offset_storage_dec = hexdec($this->dec2ord($this->text[$this->ntOffset+4]).$this->dec2ord($this->text[$this->ntOffset+5]));
                $number_name_records_dec = hexdec($this->dec2ord($this->text[$this->ntOffset+2]).$this->dec2ord($this->text[$this->ntOffset+3]));
            }
        }

        $storage_dec = $offset_storage_dec + $this->ntOffset;
        $storage_hex = strtoupper(dechex($storage_dec));

        $font_tags = [];
        for ($j=0;$j<$number_name_records_dec;$j++)
        {
            $platform_id_dec    = hexdec($this->dec2ord($this->text[$this->ntOffset+6+$j*12+0]).$this->dec2ord($this->text[$this->ntOffset+6+$j*12+1]));
            $name_id_dec        = hexdec($this->dec2ord($this->text[$this->ntOffset+6+$j*12+6]).$this->dec2ord($this->text[$this->ntOffset+6+$j*12+7]));
            $string_length_dec    = hexdec($this->dec2ord($this->text[$this->ntOffset+6+$j*12+8]).$this->dec2ord($this->text[$this->ntOffset+6+$j*12+9]));
            $string_offset_dec    = hexdec($this->dec2ord($this->text[$this->ntOffset+6+$j*12+10]).$this->dec2ord($this->text[$this->ntOffset+6+$j*12+11]));

            if (!empty($name_id_dec) and empty($font_tags[$name_id_dec]))
            {
                $font_tags[$name_id_dec] = '';
                for($l=0;$l<$string_length_dec;$l++)
                {
                    if (ord($this->text[$storage_dec+$string_offset_dec+$l]) == '0') { continue; }
                    else {
                        $font_tags[$name_id_dec] .= ($this->text[$storage_dec+$string_offset_dec+$l]);
                    }
                }
            }
        }
        return $font_tags;
    } // public function getFontInfo

    /**
     * function getCopyright()
     * @public
     * @return 'Copyright notice' contained in the TTF 'name' table at index 0
     */
    public function getCopyright()
    {
        $this->info = $this->getFontInfo();
        return $this->info[TTFInfo::NAME_COPYRIGHT];
    } // public function getCopyright

    /**
     * function getFontFamily()
     * @public
     * @return 'Font Family name' contained in the TTF 'name' table at index 1
     */
    public function getFontFamily()
    {
        $this->info = $this->getFontInfo();
        return $this->info[TTFInfo::NAME_NAME];
    } // public function getFontFamily

    /**
     * function getFontSubFamily()
     * @public
     * @return 'Font Subfamily name' contained in the TTF 'name' table at index 2
     */
    public function getFontSubFamily()
    {
        $this->info = $this->getFontInfo();
        return $this->info[TTFInfo::NAME_SUBFAMILY];
    } // public function getFontSubFamily

    /**
     * function getFontId()
     * @public
     * @return 'Unique font identifier' contained in the TTF 'name' table at index 3
     */
    public function getFontId()
    {
        $this->info = $this->getFontInfo();
        return $this->info[TTFInfo::NAME_SUBFAMILY_ID];
    } // public function getFontId

    /**
     * function getFullFontName()
     * @public
     * @return 'Full font name' contained in the TTF 'name' table at index 4
     */
    public function getFullFontName()
    {
        $this->info = $this->getFontInfo();
        return $this->info[TTFInfo::NAME_FULL_NAME];
    } // public function getFullFontName

    /**
     * function dec2ord()
     * Used to lessen redundant calls to multiple functions.
     * @protected
     * @return object
     */
    protected function dec2ord($dec)
    {
        return $this->dec2hex(ord($dec));
    } // protected function dec2ord

    /**
     * function dec2hex()
     * private function to perform Hexadecimal to decimal with proper padding.
     * @protected
     * @return object
     */
    protected function dec2hex($dec)
    {
        return str_repeat('0', 2-strlen(($hex=strtoupper(dechex($dec))))) . $hex;
    } // protected function dec2hex

    /**
     * function dec2hex()
     * private function to perform Hexadecimal to decimal with proper padding.
     * @protected
     * @return object
     */
    protected function exitClass($message)
    {
        echo $message;
        exit;
    } // protected function dec2hex

    /**
     * function dec2hex()
     * private helper function to test in the file in question is a ttf.
     * @protected
     * @return object
     */
    protected function is_ttf($file)
    {
        $ext = explode('.', $file);
        $ext = $ext[count($ext)-1];
        return preg_match("/ttf$/i",$ext) ? true : false;
    } // protected function is_ttf
} // class ttfInfo

	
	
	
	
