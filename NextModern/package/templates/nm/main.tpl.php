
<?php
/**
 * Основной макет шаблона
 * https://docs.instantcms.ru/dev/templates/layouts
 */
/** @var cmsTemplate $this */


$is_preloader = (!empty($this->options['nm_preloader_on']) && $device_type == 'desktop') || (!empty($this->options['nm_preloader_on_mob']) && $device_type !== 'desktop');

 $styles = '';
 if(!empty($this->options['nm_font_file'])) {
	$styles.='@font-face {font-family: "NmFont";src: url("/upload/'.$this->options['nm_font_file']['path'].'") format("truetype"); font-style: normal; font-weight: normal;} html,body { font-family: "NmFont", '.$this->options['nm_font_alts'].' !important;}'; 
 }
if(!empty($this->options['nm_font_tags_file'])) {
			  $styles.='@font-face {font-family: "NmFontTags";src: url("/upload/'.$this->options['nm_font_tags_file']['path'].'") format("truetype"); font-style: normal; font-weight: normal;} '.$this->options['nm_font_tags_list'].' { font-family: "NmFontTags", '.$this->options['nm_font_alts'].' !important;}';
}	
if(
!empty($this->options['nm-h1-size']) || 
!empty($this->options['nm-h2-size']) || 
!empty($this->options['nm-h3-size']) || 
!empty($this->options['nm-h4-size']) || 
!empty($this->options['nm-h5-size']) || 
!empty($this->options['nm-h6-size']) || 
!empty($this->options['nm-main-links-color'])
	) {
	$styles.=' :root {';
	if(!empty($this->options['nm-main-links-color'])){
	$styles.='--nm-links-color: '.$this->options['nm-main-links-color'].';';
	}
	if(!empty($this->options['nm-h1-size'])){
	$styles.='--h1-size: '.$this->options['nm-h1-size'].';';
	$styles.='--h1-weight: '.$this->options['nm-h1-weight'].';';
	}
	if(!empty($this->options['nm-h2-size'])){
	$styles.='--h2-size: '.$this->options['nm-h2-size'].';';	
	$styles.='--h2-weight: '.$this->options['nm-h2-weight'].';';
	}
	if(!empty($this->options['nm-h3-size'])){
	$styles.='--h3-size: '.$this->options['nm-h3-size'].';';	
	$styles.='--h3-weight: '.$this->options['nm-h3-weight'].';';
	}
	if(!empty($this->options['nm-h4-size'])){
	$styles.='--h4-size: '.$this->options['nm-h4-size'].';';	
	$styles.='--h4-weight: '.$this->options['nm-h4-weight'].';';
	}
	if(!empty($this->options['nm-h5-size'])){
	$styles.='--h5-size: '.$this->options['nm-h5-size'].';';
	$styles.='--h5-weight: '.$this->options['nm-h5-weight'].';';
	}
	if(!empty($this->options['nm-h6-size'])){
	$styles.='--h6-size: '.$this->options['nm-h6-size'].';';
	$styles.='--h6-weight: '.$this->options['nm-h6-weight'].';';
	}	
	if(!empty($this->options['nm-h1-size-mob'])){
	$styles.='--h1-size-mob: '.$this->options['nm-h1-size-mob'].';';
	}
	if(!empty($this->options['nm-h2-size-mob'])){
	$styles.='--h2-size-mob: '.$this->options['nm-h2-size-mob'].';';	
	}
	if(!empty($this->options['nm-h3-size-mob'])){
	$styles.='--h3-size-mob: '.$this->options['nm-h3-size-mob'].';';	
	}
	if(!empty($this->options['nm-h4-size-mob'])){
	$styles.='--h4-size-mob: '.$this->options['nm-h4-size-mob'].';';	
	}
	if(!empty($this->options['nm-h5-size-mob'])){
	$styles.='--h5-size-mob: '.$this->options['nm-h5-size-mob'].';';
	}
	if(!empty($this->options['nm-h6-size-mob'])){
	$styles.='--h6-size-mob: '.$this->options['nm-h6-size-mob'].';';
	}
	$styles.='}';
}



if(!empty($this->options['nm-slider-btn-raunded'])){
$styles.='.nm-owl .owl-prev .btn, .nm-owl .owl-next .btn {border-radius: 50%;width: 48px;height: 48px;display: flex;align-items: center; justify-content: center;}';   
}

?>

<?php $rows = cmsCore::getModel('widgets')->getLayoutRows($this->name); 

if($rows){ 

foreach ($rows as $row) {

 if(!$this->hasWidgetsOn($row['positions'])){
  continue;
 } 




if (!empty($row['options']['parrent_title'])) { 

    $styles.='[data-rowid="'.$row['id'].'"] > * {
position:relative;
}
[data-rowid="'.$row['id'].'"] .parrent_title_wrap .parrent_title {
margin:0;
padding:0;
}
[data-rowid="'.$row['id'].'"] .parrent_title_wrap{
position:absolute;
top:0;
bottom:0;
display:flex;
width:280px;
left:-265px;
flex-direction:row;
align-items:'.$row['options']['parrent_title_valign'].';
}
[data-rowid="'.$row['id'].'"] .parrent_title_wrap > div{
width:280px;
text-align:'.$row['options']['parrent_title_align'].';
}

@media screen and (max-width: 1700px) {
[data-rowid="'.$row['id'].'"] .parrent_title_wrap, [data-rowid="'.$row['id'].'"] .parrent_title_wrap > div{
    width:220px;
    left:-205px;
}	
}
@media screen and (max-width: 1560px) {
[data-rowid="'.$row['id'].'"] .parrent_title_wrap{
    display:none;
}
}';

 } 


if (!empty($row['options']['parrent_tag_bgcolor'])) { 

$styles.='[data-rowid="'.$row['id'].'"]{
background-color:'.$row['options']['parrent_tag_bgcolor'].' !important;
}';

} 
if (!empty($row['options']['parrent_tag_bg'])) { 

$styles.='[data-rowid="'.$row['id'].'"]{
position:relative;
background-image:url('.html_image_src( $row['options']['parrent_tag_bg'], 'original', true).') !important;
background-repeat:no-repeat !important;
background-position:center center !important;
background-size:cover !important;

'.(!empty($row['options']['parrent_tag_bg_fixed']) ? 'background-attachment: fixed;' : '').' 


}';


 if (!empty($row['options']['parrent_tag_bgoverlay'])) { 
     
$styles.='[data-rowid="'.$row['id'].'"]:before{
background:'.$row['options']['parrent_tag_bgoverlay'].';
content:"";
display:block;
top:0;
left:0;
right:0;
bottom:0;
position:absolute;
z-index:1;	
}';

} 

$styles.='[data-rowid="'.$row['id'].'"] > *{	
position:relative;
z-index:3;
}';

 } 

if (!empty($row['options']['parrent_tag_border_top']) || !empty($row['options']['parrent_tag_border_bottom'])) { 

$styles.='[data-rowid="'.$row['id'].'"]{
'.($row['options']['parrent_tag_border_top'] ? 'border-top:solid '.$row['options']['parrent_tag_border_top'].'px;' : '').';
'.($row['options']['parrent_tag_border_bottom'] ? 'border-bottom:solid '.$row['options']['parrent_tag_border_bottom'].'px;' : '').';
border-color:'.$row['options']['parrent_tag_borders_color'].';
}';

} 

 if (!empty($row['options']['parrent_tag_textscolor'])) {

$styles.='[data-rowid="'.$row['id'].'"] *:not(a):not(.btn){
color:'.$row['options']['parrent_tag_textscolor'].' !important;
}';
$styles.='[data-rowid="'.$row['id'].'"] svg{	
fill:'.$row['options']['parrent_tag_textscolor'].' !important;
}';

} 

 if (!empty($row['options']['parrent_tag_linkscolor'])) { 

$styles.='[data-rowid="'.$row['id'].'"] a, 
[data-rowid="'.$row['id'].'"] .btn *{
color:'.$row['options']['parrent_tag_linkscolor'].' !important;
}
[data-rowid="'.$row['id'].'"] a:hover{
opacity:0.8;
}';

 } 


 } 


 } ?>

<!DOCTYPE html>
<html lang="<?php echo cmsCore::getLanguageName(); ?>" class="min-vh-100">
    <head>
        <title><?php $this->title(); ?></title>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="csrf-token" content="<?php echo cmsForm::getCSRFToken(); ?>" />
        <meta name="generator" content="InstantCMS" />
<?php
        $this->addMainTplCSSName(['theme', 'owl.carousel.min']);
		$this->addMainCSS('templates/nm/controllers/nm/styles.css', false);		
        $this->addMainTplCSSName(['animate', 'lazyYT', 'my']);
        if(!empty($this->options['font_type']) && $this->options['font_type'] === 'gfont') {
            $this->addHead('<link rel="dns-prefetch" href="https://fonts.googleapis.com" />');
            $this->addHead('<link rel="preconnect" href="https://fonts.googleapis.com" crossorigin />');
            $this->addHead('<link rel="dns-prefetch" href="https://fonts.gstatic.com" />');
            $this->addHead('<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />');
            $this->addCSS('https://fonts.googleapis.com/css?family='.$this->options['gfont'].':400,400i,700,700i&display=swap&subset=cyrillic-ext', false);
        }					
		$this->addHead('<style>'.$styles.'</style>');	 
        $this->addMainTplJSName('jquery', true);
        $this->addMainTplJSName(['vendors/popper.js/js/popper.min', 'vendors/bootstrap/bootstrap.min']);
        $this->onDemandTplJSName(['vendors/photoswipe/photoswipe.min']);
        $this->onDemandTplCSSName(['photoswipe']);
        $this->addMainTplJSName(['core', 'modal', 'owl.carousel.min', 'widgets', 'lazyYT', 'wow.min', 'main']);
		
		
	    if(!empty($this->options['nm_css_files'])){

            $files = explode("\n", $this->options['nm_css_files']);

            $this->addMainCSS($files);
        }	
        if(!empty($this->options['nm_js_files'])){

            $files = explode("\n", $this->options['nm_js_files']);

            $this->addMainJS($files);
        }
	
?>
        <?php $this->head(true, !empty($this->options['js_print_head']), true); ?>
    <?php if(!empty($this->options['favicon_head_html'])) { ?>
        <?php echo $this->options['favicon_head_html']."\n"; ?>
    <?php } else { ?>
        <?php if(!empty($this->options['favicon']['path'])) { ?>
            <link rel="icon" href="<?php echo $config->upload_root . $this->options['favicon']['path']; ?>" type="<?php echo pathinfo($this->options['favicon']['path'], PATHINFO_EXTENSION) === 'svg' ? 'image/svg+xml' : 'image/x-icon'; ?>">
        <?php } else { ?>
            <link rel="icon" href="<?php echo $this->getTemplateFilePath('images/favicons/favicon.ico'); ?>" type="image/x-icon">
        <?php } ?>
    <?php } ?>
    </head>
     <body id="<?php echo $device_type; ?>_device_type" data-device="<?php echo $device_type; ?>" class="d-flex flex-column min-vh-100<?php if (cmsUser::isLogged()){ ?> user_logged<?php } ?><?php if(!empty($body_classes)) { ?> <?php echo implode(' ', $body_classes); ?><?php } ?>">
	 
<?php if($is_preloader){  ?> 	 
<div class="preloader">
  <div class="preloader__row">
    <div class="preloader__item"></div>
    <div class="preloader__item"></div>
  </div>
</div>
<?php } ?>
	 
        <?php $this->renderLayoutChild('scheme', ['rows' => $rows]); ?>
        <?php if (!empty($this->options['show_top_btn'])){ ?>
            <a class="btn btn-primary pl-3 pr-3" href="#<?php echo $device_type; ?>_device_type" id="scroll-top">
                <?php html_svg_icon('solid', 'arrow-up'); ?>
            </a>
        <?php } ?>	
	<div id="modal_video" class="modal fade">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-body bg-dark p-0">
					<div class="embed-responsive embed-responsive-16by9">
                    <iframe id="modal_video_iframe" class="embed-responsive-item" width="560" height="315" src="" frameborder="0" allow="autoplay" allowfullscreen></iframe>
                    </div>				  
                        </div>
					<div class="d-flex mt-3 justify-content-center">
					  <button type="button" class="close text-white btn-modal-close" title="Закрыть" data-dismiss="modal"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
width="24" height="24"
viewBox="0 0 50 50"
style=" fill:#fff;"><path d="M 9.15625 6.3125 L 6.3125 9.15625 L 22.15625 25 L 6.21875 40.96875 L 9.03125 43.78125 L 25 27.84375 L 40.9375 43.78125 L 43.78125 40.9375 L 27.84375 25 L 43.6875 9.15625 L 40.84375 6.3125 L 25 22.15625 Z"></path></svg></button>
					</div>
					  
                    </div>
                </div>
    </div>
        <?php if (!empty($this->options['show_cookiealert'])){ ?>
            <div class="alert text-center py-3 border-0 rounded-0 m-0 position-fixed fixed-bottom icms-cookiealert" id="icms-cookiealert">
                <div class="container">
                    <?php echo $this->options['cookiealert_text']; ?>
                    <button type="button" class="ml-2 btn btn-primary btn-sm acceptcookies">
                        <?php echo LANG_NM_THEME_COOKIEALERT_AGREE; ?>
                    </button>
                </div>
            </div>
        <?php } ?>
        <?php if ($config->debug && cmsUser::isAdmin()){ ?>
            <?php $this->renderAsset('ui/debug', ['core' => $core]); ?>
        <?php } ?>
        <script><?php echo $this->getLangJS('LANG_LOADING', 'LANG_ALL'); ?></script>
        <?php if(empty($this->options['js_print_head'])) { ?>
            <?php $this->printJavascriptTags(); ?>
        <?php } ?>
		
		<?php if(!empty($this->options['nm_css_inline_styles'])){ ?>
            <style>
                <?php echo $this->options['nm_css_inline_styles']; ?>
            </style>
		<?php } ?>
        <?php if(!empty($this->options['nm_js_inline_scripts'])){  ?>
            <script>
			    <?php echo $this->options['nm_js_inline_scripts']; ?>
            </script>
         <?php } ?>
		 
		 <style>		 
		 #redactor_modal_overlay,#redactor_modal,.redactor_dropdown {z-index: 2002 !important;}
		 </style>
		 
		 <script>
          new WOW().init();
		 </script>

		 
        <?php $this->bottom(); ?>
        <?php $this->onDemandPrint(); ?>
    </body>
</html>