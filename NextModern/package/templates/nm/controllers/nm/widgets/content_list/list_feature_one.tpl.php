<?php
/**
 * Template Name: LANG_NM_THEME_LIST_FEATURE_ONE
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
  
  $first = reset($items);
  
  // поле видео
  $fvideo = 'video';
  
?>


<div class="icms-widget__content_list feature_one">




<?php if(!empty($first)) {
	
	//////// first\feature item
	
	?>


<div class="content_list feature_col">

<div class="content_list_item feature_item <?php echo $ctype['name']; ?>_list_item card card-unstyled h-100<?php echo !empty($widget->options['teaser_line']) ? ' teaser-line-'.$widget->options['teaser_line'] : ''; ?><?php echo !empty($widget->options['teaser_line_mob']) ? ' teaser-line-mob-'.$widget->options['teaser_line_mob'] : ''; ?>">
           



<?php $fcategory = false; ?>
<?php $image_src = false; ?>
<?php foreach($first['fields'] as $field){ 
    if($field['type']=='category') {
    $fcategory =  $field['name']; 
    continue; }
    if($field['type']=='image' && !empty($first[$field['name']])) {
    $image_src =  html_image_src($first[$field['name']], $image_size, true); 
    continue; }
} ?>

       


        <div class="card-image h-100 links-on-dark text-on-dark">
		
		
    <a href="<?php echo href_to($ctype['name'], $first['slug']).'.html'; ?>" class="card-image-img style-image-overlay h-100" style="background:url(<?php echo $image_src; ?>)"></a>

<?php if (!empty($first[$fvideo])){ ?>	
        <a class="play-btn play-btn-yellow" href="#modal_video" data-video="<?php echo $first[$fvideo]; ?>"><svg class="icms-svg-icon" fill="currentColor"><use href="/templates/nm/images/icons/solid.svg#play"></use></svg></a>
<?php } ?>		

        <div class="div_on_image">
		
        <div class="icms-content-fields m-0">
		
<?php if ($fcategory || !empty($first['info_bar']['date_pub'])){ ?>
		
<div class="infobar mt-0">	
<?php if ($fcategory){ ?>
    <span class="bar_category"><?php echo $first['fields'][$fcategory]['html']; ?></span>
<?php } ?>
<?php if (!empty($first['info_bar']['date_pub'])){ ?>
    <span class="bar_date text-size-14"><svg class="icms-svg-icon w-16 mr-1" fill="currentColor"><use href="/templates/nm/images/icons/regular.svg#clock"></use></svg><?php echo $first['info_bar']['date_pub']['html']; ?></span>
<?php } ?>
</div> 

<?php } ?>

		        <?php foreach($first['fields'] as $field){ ?>
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
                        <h5 class="value">
                        <?php if ($first['parent_id']){ ?>
                            <a class="parent_title" href="<?php echo rel_to_href($item['parent_url']); ?>"><?php html($first['parent_title']); ?></a>
                            &rarr;
                        <?php } ?>

                        <?php if (!empty($first['is_private_item'])) { ?>
                            <?php html($first[$field['name']]); ?>
                            <span class="is_private text-secondary" title="<?php html($first['private_item_hint']); ?>">
                                <?php html_svg_icon('solid', 'lock'); ?>
                            </span>
                        <?php } else { ?>
                            <a href="<?php echo href_to($ctype['name'], $first['slug'].'.html'); ?>">
                                <?php html($first[$field['name']]); ?>
                            </a>
                            <?php if ($first['is_private']) { ?>
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

        
        
        <?php if (!empty($first['info_bar'])){ ?>
                    <?php 
					$info_bar = $first['info_bar'];
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
    </div>


</div>

<?php } ?>




</div>