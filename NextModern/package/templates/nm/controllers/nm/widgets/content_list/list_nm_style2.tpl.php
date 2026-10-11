<?php
/**
 * Template Name: LANG_NM_THEME_LIST_STYLE2
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
  
  
  // поле видео
 $fvideo = 'video';  
?>
<div class="icms-widget__content_list content_list list_style_2">
    <?php foreach($items as $item) { ?>

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


<div class="content_list_item <?php echo $ctype['name']; ?>_list_item card card-on-dark card-unstyled<?php echo !empty($widget->options['teaser_line']) ? ' teaser-line-'.$widget->options['teaser_line'] : ''; ?><?php echo !empty($widget->options['teaser_line_mob']) ? ' teaser-line-mob-'.$widget->options['teaser_line_mob'] : ''; ?>">
           


<?php if($image_src){ ?>
<div class="card-image">

<?php if ($fcategory){ ?>
<div class="infobar">	
    <span class="bar_category"><?php echo $item['fields'][$fcategory]['html']; ?></span>
	</div> 
<?php } ?>

   <?php if (!empty($item[$fvideo])){ ?>	
        <a class="play-btn play-btn-gray w-40" href="#modal_video" data-video="<?php echo $item[$fvideo]; ?>"><svg class="icms-svg-icon" fill="currentColor"><use href="/templates/nm/images/icons/solid.svg#play"></use></svg></a>
<?php } ?>	

    <a href="<?php echo href_to($ctype['name'], $item['slug']).'.html'; ?>" class="card-image-img" style="background:url(<?php echo $image_src; ?>)"></a>
</div>    
<?php } ?>


    <div class="title_wrap">
    <div class="">

<?php if (!empty($item['info_bar'])){ ?>
                <div class="info_bar d-flex p-0 bg-transparent border-0 mb-2">
                    <?php 
                    foreach($item['info_bar'] as $idx=>$bar){  ?>
                        
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

<?php if (!empty($item['fields']['title'])){ ?>
    <h6>
                        <?php if ($item['parent_id']){ ?>
                            <a class="parent_title" href="<?php echo rel_to_href($item['parent_url']); ?>"><?php html($item['parent_title']); ?></a>
                            &rarr;
                        <?php } ?>

                        <?php if (!empty($item['is_private_item'])) { ?>
                            <?php html($item['title']); ?>
                            <span class="is_private text-secondary" title="<?php html($item['private_item_hint']); ?>">
                                <?php html_svg_icon('solid', 'lock'); ?>
                            </span>
                        <?php } else { ?>
                            <a href="<?php echo href_to($ctype['name'], $item['slug'].'.html'); ?>">
                                <?php html($item['title']); ?>
                            </a>
                            <?php if ($item['is_private']) { ?>
                                <span class="is_private text-secondary" title="<?php echo LANG_PRIVACY_HINT; ?>">
                                    <?php html_svg_icon('solid', 'lock'); ?>
                                </span>
                            <?php } ?>
                        <?php } ?>
    </h6>
<?php } ?>

    </div>
    </div>


</div>    
<?php } ?>


       




</div>