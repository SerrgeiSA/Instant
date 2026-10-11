<?php
/**
 * Template Name: LANG_NM_THEME_LIST_STYLE_LATEST_BIG
 * Template Type: widget
 */
 
/// Размер изображения - пресет
  $image_size = 'big';
  if(!empty($widget->options['show_fields_options'][$ctype['id']]['photo']['size_teaser'])){
	  $image_size = $widget->options['show_fields_options'][$ctype['id']]['photo']['size_teaser'];
  }
    if(!empty($widget->options['show_fields_options'][$ctype['id']]['picture']['size_teaser'])){
	  $image_size = $widget->options['show_fields_options'][$ctype['id']]['picture']['size_teaser'];
  }
    // поле видео
  $fvideo = 'video';
  
  // высота изображения
  $img_h = '360';  
  // высота изображения для мобильных
  $img_h_mob = '250';
  
  
?>
<div class="icms-widget__content_list content_list list_style_latest_big" id="wd_latest_big_<?php echo $widget->bind_id; ?>">
    <?php foreach($items as $item) { ?>


<div class="content_list_item <?php echo $ctype['name']; ?>_list_item card card-unstyled  flex-md-row row<?php echo !empty($widget->options['teaser_line']) ? ' teaser-line-'.$widget->options['teaser_line'] : ''; ?><?php echo !empty($widget->options['teaser_line_mob']) ? ' teaser-line-mob-'.$widget->options['teaser_line_mob'] : ''; ?>">
           



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


<div class="col card-image-big">

<?php if (!empty($item[$fvideo])){ ?>	
        <a class="play-btn play-btn-yellow" href="#modal_video" data-video="<?php echo $item[$fvideo]; ?>"><svg class="icms-svg-icon" fill="currentColor"><use href="/templates/nm/images/icons/solid.svg#play"></use></svg></a>
<?php } ?>	

    <a href="<?php echo href_to($ctype['name'], $item['slug']).'.html'; ?>" class="card-image-img" style="background:url(<?php echo $image_src; ?>)"></a>

</div>
  


<?php } ?>


       


        <div class="icms-content-fields mt-4 mt-md-0 mb-0 col pl-md-3 d-flex flex-column justify-content-between align-content-between">
		      
        
<?php if (!empty($item['info_bar']) || $fcategory){ ?>
                <div class="info_bar d-flex p-0 bg-transparent text-muted border-0 mt-0">

<?php if ($fcategory){ ?>

    <div class="mr-4 bar_item text-truncate bi_category"><?php echo $item['fields'][$fcategory]['html']; ?></div>

<?php } ?>
  

                    <?php 
                    foreach($item['info_bar'] as $idx=>$bar){  ?>
                        
                        <?php if ($idx == 'category'){ continue; } ?>
                        <div class="mr-3 bar_item text-truncate <?php echo !empty($bar['css']) ? $bar['css'] : ''; ?>" title="<?php html(!empty($bar['title']) ? $bar['title'] : ''); ?>">
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




                     
                        <h2 class="value font-weight-bold m-0">
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
                        </h2>
                    <?php } else { ?>
                        <div class="value">
                            <?php echo $field['html']; ?>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>  
            

            <div class="card-button-more"><a href="<?php echo href_to($ctype['name'], $item['slug'].'.html'); ?>" class="btn btn-primary">Подробнее</a></div>


        </div>

        
        


       
</div>
   


    <?php } ?>
</div>



<style>

#wd_latest_big_<?php echo $widget->bind_id; ?>.list_style_latest_big .card>.card-image-big,
#wd_latest_big_<?php echo $widget->bind_id; ?>.list_style_latest_big .card>.card-image-big .card-image-img {
    height: <?php echo $img_h; ?>px;
}

@media (max-width: 991px) {
    #wd_latest_big_<?php echo $widget->bind_id; ?>.list_style_latest_big .card>.card-image-big,
    #wd_latest_big_<?php echo $widget->bind_id; ?>.list_style_latest_big .card>.card-image-big .card-image-img {
        height: <?php echo $img_h_mob; ?>px;
    }
}
</style>