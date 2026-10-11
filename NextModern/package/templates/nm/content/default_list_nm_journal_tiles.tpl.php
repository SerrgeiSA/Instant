<?php
/**
 * Template Name: NM JOURNAL TILES
 * Template Type: content
 */
 
 
$device_type = cmsRequest::getDeviceType();
$device = $device_type == 'desktop' ? 'desktop' : 'mobile';
$theme_op = @$ctype['options']['nm_'.$device]['list'];


if( $ctype['options']['list_show_filter'] ) {
    $this->renderAsset('ui/filter-panel', [
        'css_prefix'   => $ctype['name'],
        'page_url'     => $page_url,
        'fields'       => $fields,
        'props_fields' => $props_fields,
        'props'        => $props,
        'filters'      => $filters,
        'ext_hidden_params' => $ext_hidden_params,
        'is_expanded'  => $ctype['options']['list_expand_filter']
    ]);
}
?>
<?php if (!$items){ ?>
    <p class="alert alert-info mt-4 alert-list-empty">
        <?php if(!empty($ctype['labels']['many'])){ ?>
            <?php echo sprintf(LANG_TARGET_LIST_EMPTY, $ctype['labels']['many']); ?>
        <?php } else { ?>
            <?php echo LANG_LIST_EMPTY; ?>
        <?php } ?>
    </p>
<?php return; } ?>



   
<?php 

  // кол-во строк в описании
  $teaser_line = 3;
  
  // кол-во строк в описании для мобильных
  $teaser_line_mob = 3;
    
  $field_teaser = $ctype['name'] == 'posts' ? 'content' : 'teaser';
  
?>


<div class="icms-widget__content_list content_list nm_journal_tiles row row-cols-1 row-cols-md-2 row-cols-lg-3" id="nm_journal_tiles">
    <?php foreach($items as $item) { ?>

<div class="col m-0 p-3">

<div class="content_list_item <?php echo $ctype['name']; ?>_list_item card bg-none border-0 h-100<?php echo !empty($teaser_line) ? " $field_teaser-line-".$teaser_line : ''; ?><?php echo !empty($teaser_line_mob) ? " $field_teaser-line-mob-".$teaser_line_mob : ''; ?>">
           



<?php $fcategory = false; ?>
<?php $image_src = false; ?>
<?php foreach($item['fields'] as $field){ 
    if($field['type']=='category') {
    $fcategory =  $field['name']; 
    continue; }
    if($field['type']=='image') {
    if(!empty($item[$field['name']])) {    
    $image_src =  html_image_src($item[$field['name']], $field['options']['size_teaser'], true); 
    }else{
    $image_src =  html_image_src($field['options']['default_image'], $field['options']['size_teaser'], true); 
    }
    continue; }
} ?>


<?php if($image_src){ ?>
<div class="card-image">
    
<?php if ($fcategory){ ?>
<div class="infobar">	
    <span class="bar_category"><?php echo $item['fields'][$fcategory]['html']; ?></span>
</div>
<?php } ?>

    <a href="<?php echo href_to($ctype['name'], $item['slug']).'.html'; ?>" class="card-image-img" style="background:url(<?php echo $image_src; ?>)"></a>
</div>    
<?php } ?>


       
        
        
        <?php if (!empty($item['info_bar'])){ ?>
                <div class="info_bar d-flex p-0 bg-transparent border-0 mt-4">
                    <?php 
                    foreach($item['info_bar'] as $idx=>$bar){  ?>
                        
                        <?php if ($idx == 'category'){ continue; } ?>
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

        <div class="icms-content-fields">
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
                        <h2 class="value <?php echo !empty($theme_op['cards_content_title_class']) ? $theme_op['cards_content_title_class'] : 'h5'; ?>">
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
        </div>






       
    </div>
    </div>


    <?php } ?>
</div>

<?php echo html_pagebar($page, $perpage, $total, $page_url, $filter_query); ?>



<style>

<?php if (
!empty($theme_op['cards_bg']) || !empty($theme_op['cards_padding'])
	){ ?>

#nm_journal_tiles .<?php echo $ctype['name']; ?>_list_item { 

<?php 
if (!empty($theme_op['cards_bg'])){ ?>
background:<?php echo $theme_op['cards_bg']; ?> !important;
<?php } ?>

<?php 
if (!empty($theme_op['cards_padding'])){ ?>
padding:<?php echo preg_replace('/\s+/', 'rem ', $theme_op['cards_padding']." "); ?> !important;
<?php } ?>

 }

<?php } ?>

<?php if (!empty($theme_op['cards_content_padding'])){ ?>
#nm_journal_tiles .<?php echo $ctype['name']; ?>_list_item .icms-content-fields { 
padding:<?php echo preg_replace('/\s+/', 'rem ', $theme_op['cards_content_padding']." "); ?> !important;
}
<?php } ?>

<?php if (!empty($theme_op['cards_infobar_padding'])){ ?>
#nm_journal_tiles .<?php echo $ctype['name']; ?>_list_item .info_bar { 
padding:<?php echo preg_replace('/\s+/', 'rem ', $theme_op['cards_infobar_padding']." "); ?> !important;
}
<?php } ?>
<?php if (!empty($theme_op['cards_bottombar_padding'])){ ?>
#nm_journal_tiles .<?php echo $ctype['name']; ?>_list_item .bottom_bar { 
padding:<?php echo preg_replace('/\s+/', 'rem ', $theme_op['cards_bottombar_padding']." "); ?> !important;
}
<?php } ?>


<?php if (!empty($theme_op['cards_wrap_margin']) || !empty($theme_op['cards_wrap_bg'])){ ?>
#nm_journal_tiles{ 

<?php if (!empty($theme_op['cards_wrap_margin'])){ ?>
margin:<?php echo preg_replace('/\s+/', 'rem ', $theme_op['cards_wrap_margin']." "); ?> !important; 
<?php } ?>
<?php if (!empty($theme_op['cards_wrap_bg'])){ ?>
background:<?php echo $theme_op['cards_wrap_bg']; ?> !important;
<?php } ?>
}

<?php } ?>


<?php if (!empty($theme_op['cards_margin'])){ ?>
#nm_journal_tiles .col { 
padding:<?php echo $theme_op['cards_margin']; ?>rem !important;
 }
<?php } ?>

<?php if (!empty($theme_op['cards_image_height'])){ ?>
#nm_journal_tiles .col .card-image-img { 
height:<?php echo $theme_op['cards_image_height']; ?>px;
}
<?php } ?>


</style>

<?php
$this->addTplJSNameFromContext('vendors/slick/slick.min');
$this->addTplCSSNameFromContext('slick');
ob_start();
?>
<script>
    icms.menu.initSwipe('.info_bar', {variableWidth: true});
</script>
<?php $this->addBottom(ob_get_clean()); ?>