<?php
/**
 * Template Name: LANG_NM_THEME_LIST_TILES_BOARD_X4
 * Template Type: widget
 */
/// Размер изображения - пресет
  $image_size = 'normal';
  if(!empty($widget->options['show_fields_options'][$ctype['id']]['photo']['size_teaser'])){
	  $image_size = $widget->options['show_fields_options'][$ctype['id']]['photo']['size_teaser'];
  }
  if(!empty($widget->options['show_fields_options'][$ctype['id']]['picture']['size_teaser'])){
	  $image_size = $widget->options['show_fields_options'][$ctype['id']]['picture']['size_teaser'];
  }
  
  
 // поле изображения
  $f_images = 'photos';

  // поле видео
 $fvideo = 'video';  
 
?>


<div class="icms-widget__content_list content_list nm_journal_tiles row row-cols-1 row-cols-md-2 row-cols-lg-4">



    <?php foreach($items as $item) { ?>

<div class="col mb-4">

<div class="content_list_item <?php echo $ctype['name']; ?>_list_item card card-unstyled h-100<?php echo !empty($widget->options['teaser_line']) ? ' teaser-line-'.$widget->options['teaser_line'] : ''; ?><?php echo !empty($widget->options['teaser_line_mob']) ? ' teaser-line-mob-'.$widget->options['teaser_line_mob'] : ''; ?>">
           



<?php $fcategory = false; ?>
<?php $image_src = false; ?>
<?php foreach($item['fields'] as $field){ 
    if($field['type']=='category') {
    $fcategory =  $field['name']; 
    continue; }
    if($field['type']=='image' && !empty($item[$field['name']])) {
    $image_src =  html_image_src($item[$field['name']], $image_size, true); 
    continue; }
} ?>


<?php if($image_src){ ?>
<div class="card-image">


<?php $images_count = 0; 
    if(!empty($item[$f_images])) {
	$images = is_array($item[$f_images]) ? $item[$f_images] : cmsModel::yamlToArray($item[$f_images]);	
    $images_count =  count($images); 
	}
?>
<?php if($images_count){ ?>
    <span class="images_count">+<?php echo $images_count; ?></span>
<?php } ?>
    

<?php if ($fcategory){ ?>
<div class="infobar">	
    <span class="bar_category"><?php echo $item['fields'][$fcategory]['html']; ?></span>
</div> 
<?php } ?>
<?php if (!empty($item['info_bar']['date_pub'])){ ?>
     <span class="bar_date badge badge-pill badge-light"><svg class="icms-svg-icon w-16 mr-1" fill="currentColor"><use href="/templates/nm/images/icons/regular.svg#clock"></use></svg><?php echo $item['info_bar']['date_pub']['html']; ?></span>
<?php } ?>

   <?php if (!empty($item[$fvideo])){ ?>	
        <a class="play-btn play-btn-gray w-40" href="#modal_video" data-video="<?php echo $item[$fvideo]; ?>"><svg class="icms-svg-icon" fill="currentColor"><use href="/templates/nm/images/icons/solid.svg#play"></use></svg></a>
<?php } ?>	


    <a href="<?php echo href_to($ctype['name'], $item['slug']).'.html'; ?>" class="card-image-img" style="background:url(<?php echo $image_src; ?>)"></a>


 </div>    
<?php } ?>


       


        <div class="icms-content-fields mt-3">
		        <?php foreach($item['fields'] as $field){ ?>
				 <?php if($field['type']=='image' || $field['type']=='category') {                 
                    continue; 
                } ?>
                <div class="field ft_<?php echo $field['type']; ?> f_<?php echo $field['name']; ?> <?php echo $field['options']['wrap_type']; ?>_field"<?php if($field['options']['wrap_width']){ ?> style="width: <?php echo $field['options']['wrap_width']; ?>;"<?php } ?>>
                    <?php if ($field['label_pos'] != 'none'){ ?>
                        <div class="title_<?php echo $field['label_pos']; ?>">
                            <?php echo $field['title'] . ($field['label_pos']=='left' ? ': ' : ''); ?>
                        </div>
                    <?php } ?>
                    <?php if ($field['name'] == 'title' && $ctype['options']['item_on']){ ?>
                         <h5 class="value h6 mt-n1">
                        <?php if ($item['parent_id']){ ?>
                            <a class="parent_title" href="<?php echo rel_to_href($item['parent_url']); ?>"><?php html($item['parent_title']); ?></a>
                            &rarr;
                        <?php } ?>

                        <?php if (!empty($item['is_private_item'])) { ?>
                            <?php html($item[$field['name']]); ?>
                            <span class="is_private text-secondary" title="<?php html($item['private_item_hint']); ?>">
                                <?php html_svg_icon('solid', 'lock'); ?>
                            </span>
                        <?php } else { ?>
                            <a href="<?php echo href_to($ctype['name'], $item['slug'].'.html'); ?>">
                                <?php html($item[$field['name']]); ?>
                            </a>
                            <?php if ($item['is_private']) { ?>
                                <span class="is_private text-secondary" title="<?php echo LANG_PRIVACY_HINT; ?>">
                                    <?php html_svg_icon('solid', 'lock'); ?>
                                </span>
                            <?php } ?>
                        <?php } ?>
                        </h5>
                    <?php } else { ?>
                        <div class="value">
                            <?php echo $field['html']; ?>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>          
        </div>

        
        
        <?php if (!empty($item['info_bar'])){ ?>
                    <?php 
					$info_bar = $item['info_bar'];
					unset($info_bar['category']);
					unset($info_bar['date_pub']);
					?>
				
        <?php if ($info_bar){ ?>	
                <div class="info_bar d-flex p-0 bg-transparent border-0">
					<?php
                    foreach($info_bar as $idx=>$bar){  ?>
                        <div class="mr-2 bar_item text-truncate <?php echo !empty($bar['css']) ? $bar['css'] : ''; ?>" title="<?php html(!empty($bar['title']) ? $bar['title'] : ''); ?>">
                            <?php if (!empty($bar['icon'])){ ?>
                                <?php html_svg_icon('solid', $bar['icon']); ?>
                            <?php } ?>
                            <?php if (!empty($bar['href'])){ ?>
                                <a class="stretched-link" href="<?php echo $bar['href']; ?>">
                                    <?php echo $bar['html']; ?>
                                </a>
                            <?php } else { ?>
                                <?php echo $bar['html']; ?>
                            <?php } ?>
                        </div>
                    <?php } ?> 
                </div>
		 <?php } ?>
		 
        <?php } ?>
		
		




       
    </div>
    </div>


    <?php } ?>



</div>